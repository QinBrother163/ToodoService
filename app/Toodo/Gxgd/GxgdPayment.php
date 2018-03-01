<?php

namespace App\Toodo\Gxgd;

use App\Toodo\Fast;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Trade\BasePayment;
use App\Toodo\Trade\GoodsInfo;
use App\Toodo\Trade\OrderIn;
use App\Toodo\UserService;
use App\User;


class GxgdPayment extends BasePayment
{
    protected $netEnable;
    protected $netEnv; //! 0.正式环境 1.测试环境

    protected $appKey;
    protected $appSecret;

    //protected $sprId = 'SP0000001';
    protected $sprId = '100011011';

    protected $serviceUrl0 = 'http://10.0.11.38/web-lezboss/service'; //! 正式环境
    protected $authUrl0 = 'http://10.1.15.38:9881/nn_cms/nn_cms_view/gxcatv20/n301_a.php';

    protected $serviceUrl1 = 'http://10.0.11.40/web-lezboss-test/service'; //! 测试环境
    protected $authUrl1 = 'http://10.0.15.33/nn_cms/nn_cms_view/gxcatv20/n301_a.php';

    public function __construct()
    {
        parent::__construct();
        $this->netEnable = env('GXGD_NET_ENABLE', true);
        $this->netEnv = env('GXGD_NET_ENV', 0);
        $this->appKey = env('GXGD_APP_ID', '1000000018');
        $this->appSecret = env('GXGD_APP_SECRET', '43da9ccafc9cc8f07f3db95801345183');
    }

    public function signCode($inputBody)
    {
        $arr = (array)$inputBody;
        ksort($arr);
        $args = http_build_query($arr);
        $md5 = md5(urldecode($args) . $this->appSecret);
        return $md5;
    }

    /**
     * @param $biz queryProdInfoIn|prodOrderIn|consumeOrderIn|array|object
     * @return bool|object
     */
    public function send($biz)
    {
        $bizObj = (object)$biz;
        $bizObj->partner = $this->appKey;
        $bizObj->sign = $this->signCode($bizObj);
        \Log::debug('-e send in:', (array)$bizObj);

        if ($this->netEnable) {
            $srvUrl = $this->netEnv == 0 ? $this->serviceUrl0 : $this->serviceUrl1;
            list($status, $result) = Fast::curlGet($srvUrl, $bizObj);
            \Log::debug('-e send out: status:' . $status . ' result:' . $result);
            if ($status == 200) {
                $json = false;
                try {
                    $xml = simplexml_load_string($result);
                    $json = json_decode(json_encode($xml));
                } catch (\Exception $exception) {
                }
                return $json;
            }
        } else {
            /* @var $sim GxgdSim */
            $sim = app(GxgdSim::class);
            return $sim->toodo($bizObj);
        }
        return false;
    }

    public function createOrder($inputBody)
    {
        /* @var User $user */
        $user = User::find($inputBody->userId);
        /** @var UserService $userSrv */
        $userSrv = app(UserService::class);

        /** @var bizUser $gxUser */
        $gxUser = $userSrv->getBizUser($user);
        if (empty($gxUser) && !$this->netEnable) {
            $gxUser = (object)[
                'userId' => '108767787', 'stbId' => '1140150003308',
                //'userId' => '105124360', 'stbId' => '34290024617',
                //'userId' => '108767767', 'stbId' => '34290157870',
                'areaCode' => '0',
            ];
        }
        if (empty($gxUser)) {
            return [
                'subCode' => '405',
                'subMsg' => '找不到业务用户',
                'userId' => $user->id,
                'cardTV' => $user->cardTV,
                'bizUser' => $user->bizUser,
            ];
        }

        //! TODO 指定机顶盒测试
        //        if ($gxUser->stbId == '34290321880') {
        //            $gxUser->stbId = '34290157870';
        //            $gxUser->userId = '108749936';
        //        }
        //        if ($gxUser->userId != '108749936' && $gxUser->userId != '108749857') {
        //            return ['subCode' => '404', 'subMsg' => '暂未开放,敬请期待'];
        //        }

        $storeId = $inputBody->storeId;
        $goodz = $inputBody->goodsDetail;

        $goods = $goodz[0];
        /* @var TdoGoodsInfo $product */
        $product = TdoGoodsInfo::where([
            'storeId' => $storeId,
            'goodsId' => $goods->goodsId,
        ])->first();

        if (count($goodz) > 1) { //产品包大礼包购买
            return $this->consumeOrder($inputBody, $gxUser, $goods, $product);
        }

        if ($product->category == 1) { //单点消费
            return $this->consumeOrder($inputBody, $gxUser, $goods, $product);
        }
        if ($product->complex == 1) {
            return $this->promotionOrder($inputBody, $gxUser, $goods, $product);
        }
        //包月订购
        return $this->prodOrder($inputBody, $gxUser, $goods, $product);
    }

    /**
     * @param $bizOrder bizOrder|array
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payOnline($bizOrder)
    {
        $orderUrl = $bizOrder->orderUrl;
        $args = Fast::getUrlArgs($orderUrl);
        if (empty($args['sign'])) {
            $sign = $this->signCode($args);
            $orderUrl .= "&sign=$sign";
        }

        return redirect()->away($orderUrl);
    }

    public function onConfirm($inputBody)
    {
        return 'nothing';
    }

    /**
     * @param $inputBody OrderCallback
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onCallback($inputBody)
    {
        $code = $inputBody->retCode == 'SUCCESS' ? 0 : 1;
        $serialNo = $inputBody->orderId; //! 正常失败也会返回订单号
        $resp = [
            'code' => $code,
            'serialNo' => $serialNo,
        ];
        return $this->trader->onCallback($resp);
    }

    /**
     * @param $inputBody OrderCallback
     * @return string
     */
    public function onNotice($inputBody)
    {
        $code = 1;
        $serialNo = '';
        if ($inputBody->retCode == 'SUCCESS') {
            $serialNo = $inputBody->orderId;
            $code = 0;
        }

        $resp = [
            'code' => $code,
            'serialNo' => $serialNo,
        ];

        $resp = $this->trader->onNotice($resp);
        if ($resp) return 'success';
        return 'failure';
    }


    /**
     * @param $inputBody OrderIn
     * @param $bizUser bizUser
     * @param $goods GoodsInfo
     * @param $product TdoGoodsInfo
     * @return array
     */
    protected function prodOrder($inputBody, $bizUser, $goods, $product)
    {
        $prodCnt = TdoGxgdProd::where(['productId' => $product->productId])->count();
        /* @var TdoGxgdProd $prod */
        $prod = null;
        if ($prodCnt > 0) {
            $prod = TdoGxgdProd::where([
                'env' => $this->netEnv,
                'verify' => 1,
                'productId' => $product->productId,
            ])->first();
        }
        if (empty($prod)) {
            $prod = TdoGxgdProd::where([
                'env' => $this->netEnv,
                'verify' => 1,
                'feeType' => 30,
            ])->first();
        }

        $payAmount = $this->netEnv == 0 ? $prod->price : 0.01;

        $bizIn = [
            'method' => 'prodOrder',
            'productId' => $prod->bossId,
            'productName' => $prod->goodsName,
            'productDesc' => $inputBody->body,
            'tariffId' => $prod->tariffId,
            'qty' => $goods->quantity,
            'userId' => $bizUser->userId,
            'stbId' => $bizUser->stbId,
            'areaCode' => $bizUser->areaCode,
            'callbackUrl' => url('/api/toodo/gxgd/onCallback'),
            'noticeUrl' => url('/api/toodo/gxgd/onNotice'),
            'appIndexUrl' => url("/api/toodo/gxgd/onIndex?orderNo=$inputBody->orderNo&storeId=$inputBody->storeId"),
            'unitPrice' => $payAmount,
            'isHD' => '720P',
        ];

        $json = $this->send($bizIn);
        if ($json === false) {
            return ['subCode' => '404', 'subMsg' => '业务请求异常'];
        }
        if ($json->isSuccess != 'T') {
            return ['subCode' => '403', 'subMsg' => '业务请求失败'];
        }
        /* @var $response OrderOut */
        $response = $json->response;
        if ($response->resultCode != 'SUCCESS') {
            return ['subCode' => '402', 'subMsg' => '业务返回失败'];
        }

        $bizOut = [
            'method' => $bizIn['method'],
            'orderId' => $response->orderId,
            'orderUrl' => $response->orderUrl,
        ];
        return [
            'subCode' => 0, 'subMsg' => '',
            'biz' => $bizOut,
            'serialNo' => $response->orderId,
        ];
    }

    /**
     * @param $inputBody OrderIn
     * @param $bizUser bizUser
     * @param $goods GoodsInfo
     * @param $product TdoGoodsInfo
     * @return array
     */
    protected function consumeOrder($inputBody, $bizUser, $goods, $product)
    {
        /* @var TdoGxgdProd $prod */
        $prod = $this->getProd($product->productId, 1);

        $amount = round($inputBody->totalAmount / 100, 2);
        $payAmount = $this->netEnv == 0 ? $amount : 0.01;

        $bizIn = [
            'method' => 'consumeOrder',
            'stbId' => $bizUser->stbId,
            'userId' => $bizUser->userId,
            'areaCode' => $bizUser->areaCode,
            'productId' => $prod->bossId,
            'amount' => $payAmount,
            'productName' => $inputBody->subject,
            'sprId' => $this->sprId,
            'isHD' => '720P',
            'callbackUrl' => url('/api/toodo/gxgd/onCallback'),
            'noticeUrl' => url('/api/toodo/gxgd/onNotice'),
            'appIndexUrl' => url("/api/toodo/gxgd/onIndex?orderNo=$inputBody->orderNo&storeId=$inputBody->storeId"),
        ];

        $json = $this->send($bizIn);
        if ($json === false) {
            return ['subCode' => '404', 'subMsg' => '业务请求异常'];
        }
        if ($json->isSuccess != 'T') {
            return ['subCode' => '403', 'subMsg' => '业务请求失败'];
        }
        /* @var $response OrderOut */
        $response = $json->response;
        if ($response->resultCode != 'SUCCESS') {
            return ['subCode' => '402', 'subMsg' => '业务返回失败'];
        }

        $bizOut = [
            'method' => $bizIn['method'],
            'orderId' => $response->orderId,
            'orderUrl' => $response->orderUrl,
        ];
        return [
            'subCode' => 0, 'subMsg' => '',
            'biz' => $bizOut,
            'serialNo' => $response->orderId,
        ];
    }

    /**
     * @param $inputBody OrderIn
     * @param $bizUser bizUser
     * @param $goods GoodsInfo
     * @param $product TdoGoodsInfo
     * @return array
     */
    protected function promotionOrder($inputBody, $bizUser, $goods, $product)
    {
        /* @var TdoGxgdProd $prod */
        $prod = $this->getProd($product->productId, 90);
        if (empty($prod)) {
            return ['subCode' => '404', 'subMsg' => '找不到渠道商品促销信息'];
        }

        $payAmount = $this->netEnv == 0 ? $prod->pValue : 0.01;

        $bizIn = [
            'method' => 'promotionOrder',
            'userId' => $bizUser->userId,
            'stbId' => $bizUser->stbId,
            'areaCode' => $bizUser->areaCode,
            'isHD' => '720P',
            'productId' => $prod->bossId,
            'productName' => $prod->goodsName,
            'promotionId' => $prod->pId,//	String	是	促销编号
            'ptitle' => $prod->pName,//	String	是	促销标题
            'amount' => $payAmount,//	String	是	金额
            'tariffId' => $prod->tariffId,
            'callbackUrl' => url('/api/toodo/gxgd/onCallback'),
            'noticeUrl' => url('/api/toodo/gxgd/onNotice'),
            'appIndexUrl' => url("/api/toodo/gxgd/onIndex?orderNo=$inputBody->orderNo&storeId=$inputBody->storeId"),
        ];

        $json = $this->send($bizIn);
        if ($json === false) {
            return ['subCode' => '404', 'subMsg' => '业务请求异常'];
        }
        if ($json->isSuccess != 'T') {
            return ['subCode' => '403', 'subMsg' => '业务请求失败'];
        }
        /* @var $response OrderOut */
        $response = $json->response;
        if ($response->resultCode != 'SUCCESS') {
            return ['subCode' => '402', 'subMsg' => '业务返回失败'];
        }

        $bizOut = [
            'method' => $bizIn['method'],
            'orderId' => $response->orderId,
            'orderUrl' => $response->orderUrl,
        ];
        return [
            'subCode' => 0, 'subMsg' => '',
            'biz' => $bizOut,
            'serialNo' => $response->orderId,
        ];
    }

    /**
     * @param $productId int
     * @param $feeType int
     * @return TdoGxgdProd|null
     */
    public function getProd($productId, $feeType)
    {
        $prodCnt = TdoGxgdProd::where(['productId' => $productId])->count();
        /* @var TdoGxgdProd $prod */
        $prod = null;
        if ($prodCnt > 0) {
            $prod = TdoGxgdProd::where([
                'env' => $this->netEnv,
                'verify' => 1,
                'productId' => $productId,
            ])->first();
        }
        if (empty($prod)) {
            $prod = TdoGxgdProd::where([
                'env' => $this->netEnv,
                'verify' => 1,
                'feeType' => $feeType,
            ])->first();
        }
        return $prod;
    }

    public function auth($bizIn)
    {
        /** @var AuthIn $bizIn */
        $bizIn = (object)$bizIn;
        $user = $bizIn->user;

        if ($user->id == 4) {
            \Log::info('-e auth ' . 111111);
        }
        if (empty($user->bizUser)) {
            return false;
        }

        if ($user->id == 4) {
            \Log::info('-e auth ' . 22222222222);
        }
        /** @var UserService $userService */
        $userService = app(UserService::class);
        /** @var bizUser $bizUser */
        $bizUser = $userService->getBizUser($user);
        if (empty($bizUser->userId)) {
            return false;
        }

        if ($user->id == 4) {
            \Log::info('-e auth ' . 333333333333);
        }
        $prod = $this->getProd($bizIn->productId, 30);
        if (empty($prod)) {
            return false;
        }

        $bizIn = [
            'nns_func' => 'check_play_auth',
            'nns_user_id' => $bizUser->userId,
            'nns_product_id' => $prod->idcId,
            'nns_video_id' => '',
            'nns_cp_id' => $this->appKey,
            'nns_output_type' => 'json',
        ];
        $url = $this->netEnv == 0 ? $this->authUrl0 : $this->authUrl1;
        list($status, $result) = Fast::curlGet($url, $bizIn);

        if ($user->id == 4) {
            \Log::info('-e url ' . $url . ' bizIn:', $bizIn);
            \Log::info('-e auth ', [
                'userId' => $bizUser->userId,
                'status' => $status,
                'result' => $result,
            ]);
        }

        if ($status != 200) {
            return false;
        }
        /** @var AuthOut $json */
        $json = json_decode($result);
        return $json->state == 0;
    }
}