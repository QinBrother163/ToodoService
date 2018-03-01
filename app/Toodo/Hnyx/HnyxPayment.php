<?php

namespace App\Toodo\Hnyx;

use App\Toodo\Biz\BizService;
use App\Toodo\Fast;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Trade\BasePayment;
use App\Toodo\Trade\ExtendParams;
use App\Toodo\Trade\TdoOrderData;
use App\Toodo\Trade\Trader;
use App\User;


class HnyxPayment extends BasePayment
{
    protected $netEnable;

    protected $appId;
    protected $appSecret;

    protected $rechargeUrl;
    protected $spgwUrl;


    public function __construct()
    {
        parent::__construct();

        $this->netEnable = env('HNYX_NET_ENABLE', false);

        $this->appId = env('HNYX_APP_ID', '12000002');
        $this->appSecret = env('HNYX_APP_SECRET', '12000002');

        $this->rechargeUrl = env('HNYX_RECHARGE_URL', 'http://192.168.6.81:8081/gateway/rechargeServlet');
        $this->spgwUrl = env('HNYX_SPGW_URL', 'http://192.168.6.81:8081/spgw');
    }

    public function signCode($ts)
    {
        // TODO: Implement signCode() method.
        //$ts = time();
        $msg = $this->appId . '_' . $this->appSecret . '_' . $ts;
        $md5 = md5($msg);
        return strtoupper($md5);
    }

    public function createOrder($inputBody)
    {
        // TODO: Implement createOrder() method.
        $storeId = $inputBody->storeId;
        $goodz = $inputBody->goodsDetail;

        $consume = false;
        if (count($goodz) > 1) { //产品包大礼包购买
            $consume = true;
        } else {
            $goods = $goodz[0];
            /* @var TdoGoodsInfo $product */
            $product = TdoGoodsInfo::where([
                'storeId' => $storeId,
                'goodsId' => $goods->goodsId,
            ])->first();
            if ($product->category == 1) { //单点消费
                $consume = true;
            }
        }

        $tradeNo = $inputBody->tradeNo;
        /** @var bizOrder $bizOut */
        $bizOut = (object)[
            'orderUrl' => $this->getOrderUrl($tradeNo),
            'consume' => $consume,
        ];

        return [
            'subCode' => 0,
            'subMsg' => '',
            'biz' => $bizOut,
            'serialNo' => '',
        ];
    }

    public function getOrderUrl($tradeNo)
    {
        $appId = $this->appId;
        $appSecret = $this->appSecret;

        $ts = Fast::ms();
        $msg = "$appId$tradeNo$ts$appSecret";      //加密===========================
        $sign = md5($msg);

        $bizIn = [
            'orderId' => $tradeNo,
            'ts' => $ts,
            'sign' => $sign,
        ];
        $args = http_build_query($bizIn);
        $orderUrl = url('/api/toodo/hnyx/pay') . "?$args";
        return $orderUrl;
    }

    /**
     * @param $request \Illuminate\Http\Request
     * @return mixed
     */
    public function payOnline($request)
    {
        $tradeNo = $request->input('orderId');
        $ts = $request->input('ts');
        $sign = $request->input('sign');

        $appId = $this->appId;
        $appSecret = $this->appSecret;

        $msg = "$appId$tradeNo$ts$appSecret";     //解密==============================
        $md5 = md5($msg);
        if ($this->netEnable && strcasecmp($md5, $sign) != 0) {
            $bizOut = [
                'code' => 2,
                'msg' => '订购失败！',
                'subCode' => '',
                'subMsg' => '签名出错',
            ];
            return view('hnyx.result', $bizOut);
        }

        /** @var TdoOrderData $order */
        $order = TdoOrderData::find($tradeNo);
        if (empty($order)) {
            $bizOut = [
                'code' => 2,
                'msg' => '订购失败！',
                'subCode' => '',
                'subMsg' => '找不到订单信息',
            ];
            return view('hnyx.result', $bizOut);
        }

        /** @var $extends ExtendParams */
        $extends = json_decode($order->extendParams);
        /** @var bizOrder $bizOrder */
        $bizOrder = $extends->biz;

        if (!$this->netEnable && !isset($bizOrder->consume)) {
            $bizOrder->consume = true;
        }

        if ($bizOrder->consume) {
            return $this->payConsume($order);
        } else {
            return $this->payOrder($tradeNo);
        }
    }

    protected function payOrder($tradeNo)
    {
        $backUrl = url('/api/toodo/hnyx/onCallback');

        if (!$this->netEnable) {
            return view('hnyx.simOrder', [
                'backUrl' => rawurlencode($backUrl),
                'tradeNo' => $tradeNo,
            ]);
        }

        $appId = $this->appId;
        $ts = Fast::ms();
        $md5 = $this->signCode($ts);

        $bizIn = [
            'attribute' => 'json_order_prod',
            'cseq' => $tradeNo,
            'csi' => $appId,
            'stamp' => $ts,
            'token' => $md5,
            'productId' => '941',
            //'productType' => $bizOrder->consume ? 1 : 0,
            'productType' => '',
            'assetId' => '',
            'backUrl' => $backUrl,
        ];
        $args = http_build_query($bizIn);
        $orderUrl = "$this->spgwUrl?$args";
        return view('hnyx.order', [
            'orderUrl' => rawurlencode($orderUrl),
        ]);
    }

    /**
     * @param $order TdoOrderData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function payConsume($order)
    {
        $backUrl = url("/api/toodo/hnyx/onConsume/$order->tradeNo");

        $user = User::find($order->userId);
        $cardTV = $user->cardTV;

        /** @var PayByQrCodeResponse $bizQR */
        $bizQR = null;
        $biz = [
            'tvnNum' => $cardTV,
            'amount' => $order->totalAmount,
            'channelCode' => 'cloudGame',
            'size' => 6,// 45px * 6
        ];
        if ($this->netEnable) {
            /** @var HnyxClient $client */
            $client = app(HnyxClient::class);
            $bizQR = (object)$client->payByQrCode($biz);
        } else {
            /** @var HnyxSim $sim */
            $sim = app(HnyxSim::class);
            $bizQR = (object)$sim->payByQrCode($biz);
        }

        if (!$bizQR || $bizQR->code != '0000') {
            return redirect()->away($backUrl);
        }

        $orderUrl = null;
        if ($this->netEnable) {
            $ts = Fast::ms();
            $md5 = $this->signCode($ts);
            $bizIn = [
                'businessInfoId' => '10000000',
                'stbId' => $cardTV,
                'goodsId' => 'VODC2014122110510901',
                'name' => '双动科技测试产品',
                'spId' => $this->appId,
                'token' => $md5,
                'stamp' => $ts,
                'backUrl' => $backUrl,
            ];
            $args = http_build_query($bizIn);
            $orderUrl = "$this->rechargeUrl?$args";
        } else {
            //模拟消费接口
            $orderUrl = url("/hnyx/simConsume/$order->tradeNo");
        }

        {
            $serialNo = $bizQR->businessSN;
            $queryUrl = url('/hnyx/queryPayResult') . "?businessSN=$serialNo";

            $order->serialNo = $serialNo;
            $order->save();

            //$order->imageUrl = $bizQR->imageUrl;
            $order->imageUrl = Fast::qrUrl($bizQR->qrCodeValue); //自己生成二维码

            $desc = preg_split('/[\s,]+/', $order->body, -1, PREG_SPLIT_NO_EMPTY);

            $callbackUrl = null;
            /** @var $extends ExtendParams */
            $extends = json_decode($order->extendParams);
            $data = json_decode($extends->data);
            if (isset($data->callback)) {
                $callbackUrl = rawurlencode($extends->callbackUrl);
            }

            return view('hnyx.consume', [
                'backUrl' => rawurlencode($backUrl),
                'orderUrl' => rawurlencode($orderUrl),
                'queryUrl' => rawurlencode($queryUrl),
                'orderBiz' => $order,
                'desc' => $desc,
                'callbackUrl' => $callbackUrl,
            ]);
        }
    }

    public function simConsume($tradeNo)
    {
        $backUrl = url("/api/toodo/hnyx/onConsume/$tradeNo");
        return view('hnyx.simConsume', [
            'backUrl' => rawurlencode($backUrl),
            'tradeNo' => $tradeNo,
        ]);
    }

    public function onConfirm($inputBody)
    {
        // TODO: Implement onConfirm() method.
    }

    /**
     * @param $request \Illuminate\Http\Request
     * @return mixed
     */
    public function onCallback($request)
    {
        // TODO: Implement onCallback() method.
        /** @var OrderProdOut $bizIn */
        $bizIn = (object)$request->all();
        if (!isset($bizIn->returnCode)) {
            $bizIn->returnCode = '-1';
            $bizIn->cseq = 'xx';
        }

        $code = 2;
        $msg = '订购失败！';
        $subCode = $bizIn->returnCode;
        $subMsg = '其它异常';

        switch ($subCode) {
            case '00000000':
                $code = 0;
                $msg = '订购成功。';
                break;
            case '300004':
            case '300009':
                $code = 1;
                $msg = '余额不足！';
                break;
        }
        switch ($subCode) {
            case '-1':
                $subMsg = '取消操作';
                break;
            case '00000000':
                $subMsg = '成功';
                break;
            case '00000001':
                $subMsg = '安全校验失败';
                break;
            case '00000002':
                $subMsg = '内部错误';
                break;
            case '00000010':
                $subMsg = '客户信息不存在,TGT失效';
                break;
            case '00020101':
                $subMsg = '该产品已购买';
                break;
            case '00020102':
                $subMsg = '产品已过有效期';
                break;
            case '00020103':
                $subMsg = '产品不存在';
                break;
            case '00020104':
                $subMsg = '产品状态非法';
                break;
            case '00020106':
                $subMsg = '客户状态非法';
                break;
            case '00020306':
                $subMsg = '用户状态非法';
                break;
            case '00020307':
                $subMsg = '未经授权的内容';
                break;
            case '300001':
                $subMsg = '抱歉，查询预存款余额信息失败，请稍候再试！';
                break;
            case '300002':
                $subMsg = '抱歉，预存款余额信息未建立，请前往营业厅办理！';
                break;
            case '300003':
                $subMsg = '抱歉，此产品包信息未被发布，不能订购！';
                break;
            case '300004':
                $subMsg = '抱歉，预存款余额不足，不能订购此产品！';
                break;
            case '300005':
                $subMsg = '抱歉，订购失败，请稍候再试！';
                break;
            case '300006':
                $subMsg = '抱歉，订购此产品包失败，请重新选择其他产品包！';
                break;
            case '300007':
                $subMsg = '抱歉，您已经订购了此产品包，不能重复订购！';
                break;
            case '300008':
                $subMsg = '抱歉，此产品包只能在营业厅办理，请莅临就近营业厅办理此业务！';
                break;
            case '300009':
                $subMsg = '抱歉，您的预存款余额不足，不能订购此产品！';
                break;

            case '34118301':
                $subMsg = '您已经订购了此产品包，不能重复订购！';
                break;
        }

        $tradeNo = $bizIn->cseq;
        $order = TdoOrderData::find($tradeNo);
        if ($code != 2 && empty($order)) { //订单验证
            $code = 2;
            $msg = '订购失败！';
            $subCode = '404';
            $subMsg = '查询不到订单。';
        }

        $bizOut = (object)[
            'code' => $code,
            'msg' => $msg,
            'subCode' => $subCode,
            'subMsg' => $subMsg,
        ];

        if ($code == 0) { //! 订购成功
            /** @var Trader $trade */
            $trade = app(Trader::class);
            $trade->grabOrder($tradeNo);

            $order->payTime = date('Y年m月d日', strtotime($order->payTime));
            /** @var BizService $bizSrv */
            $bizSrv = app(BizService::class);
            $ts = time();
            $biz = [
                'userId' => $order->userId,
                'retailId' => $order->retailId,
                'ts' => $ts,
                'sign' => $bizSrv->sign3($order->userId, $order->retailId, $ts),
            ];
            $addressUrl = url('/hnyx/address?') . http_build_query($biz);
            $bizOut->addressUrl = rawurlencode($addressUrl);
        }

        if ($code == 1) { //! 余额不足，补全生成二维码信息
            /** @var PayByQrCodeResponse $bizQR */
            $bizQR = null;
            if (empty($bizIn->tvnNumber)) $bizIn->tvnNumber = 'hnyx_test';
            $biz = [
                'tvnNum' => $bizIn->tvnNumber,
                'amount' => $order->totalAmount,
                'channelCode' => '',
                'size' => 256,
            ];
            if ($this->netEnable) {
                /** @var HnyxClient $client */
                $client = app(HnyxClient::class);
                $bizQR = (object)$client->payByQrCode($biz);
            } else {
                /** @var HnyxSim $sim */
                $sim = app(HnyxSim::class);
                $bizQR = (object)$sim->payByQrCode($biz);
            }
            if (!$bizQR) {
                $bizOut->code = 2;
            } else if ($bizQR->code != '0000') {
                $bizOut->code = 2;
            } else {
                $serialNo = $bizQR->businessSN;
                $order->serialNo = $serialNo;
                $order->save();

                $queryUrl = url('/hnyx/queryPayResult') . "?businessSN=$serialNo";
                $orderUrl = $this->getOrderUrl($tradeNo);

                $order->imageUrl = $bizQR->imageUrl;
                $bizOut->queryUrl = rawurlencode($queryUrl);
                $bizOut->orderUrl = rawurlencode($orderUrl);
            }
        }
        $bizOut->orderBiz = $order;

        /** @var $extends ExtendParams */
        $extends = json_decode($order->extendParams);
        if ($extends->data) {
            $bizOut->callbackUrl = rawurlencode($extends->callbackUrl);
        }

        return view('hnyx.result', (array)$bizOut);
    }

    public function onNotice($inputBody)
    {
        // TODO: Implement onNotice() method.
    }

    /**
     * @param $request \Illuminate\Http\Request
     * @param $tradeNo string
     * @return mixed
     */
    public function onConsume($request, $tradeNo)
    {
        /** @var ConsumeProdOut $bizIn */
        $bizIn = (object)$request->all();
        if (!isset($bizIn->errorCode)) {
            $bizIn->errorCode = '-1';
        }
        $code = 2;
        $msg = '订购失败！';
        $subCode = $bizIn->errorCode;
        $subMsg = '其它异常';

        switch ($subCode) {
            case '1':
                $code = 0;
                $msg = '订购成功。';
                break;
        }
        switch ($subCode) {
            case '-1':
                $subMsg = '取消操作';
                break;
            case '1':
                $subMsg = '订购成功';
                break;
            case '203':
                $subMsg = '发送给boss处理出现错误';
                break;
            case '204':
                $subMsg = 'boss订购出现未知错误';
                break;
            case '205':
                $subMsg = '订购信息缓存失败';
                break;
        }
        $order = TdoOrderData::find($tradeNo);
        if ($code != 2 && empty($order)) { //订单验证
            $code = 2;
            $msg = '订购失败！';
            $subCode = '404';
            $subMsg = '查询不到订单。';
        }
        $bizOut = (object)[
            'code' => $code,
            'msg' => $msg,
            'subCode' => $subCode,
            'subMsg' => $subMsg,
        ];

        $callbackUrl = null;
        /** @var $extends ExtendParams */
        $extends = json_decode($order->extendParams);
        $data = json_decode($extends->data);
        if (isset($data->callback)) {
            $callbackUrl = rawurlencode($extends->callbackUrl);
        }

        if ($code == 0) { //! 订购成功
            /** @var Trader $trader */
            $trader = app(Trader::class);
            $trader->grabOrder($tradeNo);

            $order->payTime = date('Y年m月d日', strtotime($order->payTime));
            /** @var BizService $bizSrv */
            $bizSrv = app(BizService::class);
            $ts = time();
            $biz = [
                'userId' => $order->userId,
                'retailId' => $order->retailId,
                'ts' => $ts,
                'sign' => $bizSrv->sign3($order->userId, $order->retailId, $ts),
            ];
            if ($callbackUrl) {
                $biz['callbackUrl'] = $callbackUrl;
            }
            $addressUrl = url('/hnyx/address?') . http_build_query($biz);
            $bizOut->addressUrl = rawurlencode($addressUrl);
        }
        $bizOut->orderBiz = $order;
        $bizOut->callbackUrl = $callbackUrl;

        return view('hnyx.result', (array)$bizOut);
    }
}