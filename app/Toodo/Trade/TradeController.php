<?php

namespace App\Toodo\Trade;

use App\Toodo\BaseBody;
use App\Toodo\Biz\BizService;
use App\Toodo\Biz\TdoUserAddress;

use App\Toodo\Gdgd\GdgdPayment;
use App\Toodo\Gxgd\GxgdPayment;
use App\Toodo\Hnyx\HnyxPayment;
use App\Toodo\TdoPayLog;
use App\Toodo\Unicom\UnicomPayment;

use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\ToodoController;


class TradeController extends ToodoController
{
    protected function getRetailOrder($retailId, $bizIn)
    {
        if ($retailId == config('retail.test')) {
            $gxgd = app(GxgdPayment::class);
            return $gxgd->createOrder($bizIn);
        }
        if ($retailId == config('retail.gxgd')) {
            $gxgd = app(GxgdPayment::class);
            return $gxgd->createOrder($bizIn);
        }
        if ($retailId == config('retail.gdgd')) {
            $gdgd = app(GdgdPayment::class);
            return $gdgd->createOrder($bizIn);
        }
        if ($retailId == config('retail.hnyx')) {
            $hnyx = app(HnyxPayment::class);
            return $hnyx->createOrder($bizIn);
        }
        if ($retailId == config('retail.unicom')) {
            $unicom = app(UnicomPayment::class);
            return $unicom->createOrder($bizIn);
        }
        return ['subCode' => 1, 'subMsg' => '找不到业务渠道编号',];
    }

    protected function payRetailOrder($retailId, $bizOrder)
    {
        if ($retailId == config('retail.test')) {
            $gxgd = app(GxgdPayment::class);
            return $gxgd->payOnline($bizOrder);
        }
        if ($retailId == config('retail.gxgd')) {
            $gxgd = app(GxgdPayment::class);
            return $gxgd->payOnline($bizOrder);
        }
        if ($retailId == config('retail.gdgd')) {
            $gdgd = app(GdgdPayment::class);
            return $gdgd->payOnline($bizOrder);
        }
        if ($retailId == config('retail.hnyx')) {
            $orderUrl = $bizOrder->orderUrl;
            return redirect()->away($orderUrl);
        }
        if ($retailId == config('retail.unicom')) {
            $hnyx = app(HnyxPayment::class);
            return $hnyx->payOnline($bizOrder);
        }
        return [
            'code' => 11010,
            'msg' => '交易请求支付出错',
            'subCode' => 404,
            'subMsg' => '找不到业务渠道编号',
        ];
    }

    protected function doMethod($request)
    {
        $ret = null;
        $method = $request['method'];
        if ($method == '/toodo/trade/order1') {
            $ret = $this->order1($request);
        } else if ($method == '/toodo/trade/query1') {
            $ret = $this->query1($request);
        } else if ($method == '/toodo/trade/order') {
            $ret = $this->order($request);
        } else if ($method == '/toodo/trade/pay') {
            $ret = $this->pay($request);
        } else if ($method == '/toodo/trade/confirm') {
            $ret = $this->confirm($request);
        } else if ($method == '/toodo/trade/bill') {
            $ret = $this->bill($request);
        } else if ($method == '/toodo/trade/address') {
            $ret = $this->address($request);
        } else if ($method == '/toodo/trade/addressIO') {
            $ret = $this->addressIO($request);
        }
        if ($ret) {
            \Log::debug("-e $method in:", $request->all());
            \Log::debug("-e $method out:" . json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $ret;
        }
        return $this->error(10004, '找不到指定method的方法', '', '');
    }

    protected function confirm($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        //! 校验输入参数=================================================
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->tradeNo)) {
                $subCode = 1;
                $subMsg = 'not set ConfirmIn param tradeNo';
            }
            if ($subCode != 0) {
                return $this->error(11007, '交易确认订单参数缺失', $subCode, $subMsg);
            }
        }
        $tradeNo = $bizIn->tradeNo;
        $order = TdoOrderData::find($tradeNo);
        if (empty($order)) {
            return $this->error(11007, '交易确认订单参数缺失', 404, '订单不存在');
        }

        if (isset($bizIn->biz)) {
            $pay = new TdoPayLog();
            $pay->fill([
                'tradeNo' => $tradeNo,
                'userId' => $order->userId,
                'retailId' => $order->retailId,
                'biz' => $bizIn->biz,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $pay->save();
        }

        if (isset($bizIn->serialNo)) {
            $order->serialNo = $bizIn->serialNo;
        }
        if ($order->retailId == config('retail.unicom')) {
            /** @var Trader $trader */
            $trader = app(Trader::class);
            $trader->grabOrder($tradeNo);

        } else {
            if ($order->tradeStatus < 1) {
                $order->tradeStatus = 1;
                $order->save();
            }
        }
        return $this->biz(['tradeStatus' => $order->tradeStatus]);
    }

    protected function order1($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        //! 校验输入参数=================================================
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->productId)) {
                $subCode = 1;
                $subMsg = 'not set Order1In param productId';
            }
            if ($subCode == 0 && empty($bizIn->userId)) {
                $subCode = 2;
                $subMsg = 'not set Order1In param userId';
            }
            if ($subCode == 0 && empty($bizIn->callbackUrl)) {
                $subCode = 3;
                $subMsg = 'not set Order1In param callbackUrl';
            }
            if ($subCode != 0) {
                return $this->error(11007, '交易生成订单参数缺失', $subCode, $subMsg);
            }
        }
        $productId = $bizIn->productId;
        $goods = TdoGoodsInfo::find($productId);
        if (empty($goods)) {
            return $this->error(11007, '交易生成订单参数缺失', 404, '找不到指定商品');
        }

        $biz = [
            'orderNo' => $this->serialNo(16),
            'userId' => $bizIn->userId,
            'storeId' => $goods->storeId,
            'storeName' => $goods->storeName,
            'totalAmount' => $goods->price,
            'subject' => $goods->goodsName,
            'body' => $goods->goodsDesc,
            'goodsDetail' => [
                [
                    'goodsId' => $goods->goodsId,
                    'goodsName' => $goods->goodsName,
                    'price' => $goods->price,
                    'quantity' => 1
                ],
            ],
            'extendParams' => [
                'callbackUrl' => $bizIn->callbackUrl,
                'data' => isset($bizIn->data) ? $bizIn->data : '',
            ],
        ];

        return $this->order([
            'token' => BaseBody::getParam($request, 'token'),
            'bizContent' => json_encode($biz),
        ]);
    }

    protected function query1($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        //! 校验输入参数=================================================
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->tradeNo)) {
                $subCode = 1;
                $subMsg = 'not set Query1In param tradeNo';
            }
            if ($subCode != 0) {
                return $this->error(11007, '交易查询订单参数缺失', $subCode, $subMsg);
            }
        }
        $tradeNo = $bizIn->tradeNo;
        $order = TdoOrderData::find($tradeNo);

        //        $retailId = $order->retailId;
        //        if ($retailId == config('retail.hnyx') || $retailId == config('retail.unicom')) {
        //            $netEnable = env('HNYX_NET_ENABLE', false);
        //            if (!$netEnable) {
        //                /** @var HnyxSim $sim */
        //                $sim = app(HnyxSim::class);
        //
        //                /** @var QueryPayResultResponse $ret */
        //                $ret = (object)$sim->queryPayResult(['businessSN' => $order->serialNo]);
        //                \Log::info('-e ret:', (array)$ret);
        //
        //                if ($ret->code == '0000') {
        //                    if ($ret->isPaid == '1') {
        //                        $order->tradeStatus = 2;
        //                        if(!$order->payTime){
        //                            /** @var Trader $trade */
        //                            $trade = app(Trader::class);
        //                            $trade->hnyxOrder($order);
        //                        }
        //                    } else {
        //                        $order->tradeStatus = 1;
        //                    }
        //                    $order->payTime = date('Y-m-d H:i:s');
        //                    $order->save();
        //                }
        //            }
        //        }

        return $this->biz(['tradeStatus' => $order->tradeStatus]);
    }

    protected function order($request)
    {
        $bizContent = $request['bizContent'];
        /** @var OrderIn $bizIn */
        $bizIn = json_decode($bizContent);

        //! 校验输入参数=================================================
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->orderNo)) {
                $subCode = 1;
                $subMsg = 'not set OrderIn param orderNo';
            }
            if ($subCode == 0 && empty($bizIn->userId)) {
                $subCode = 2;
                $subMsg = 'not set OrderIn param userId';
            }
            if ($subCode == 0 && empty($bizIn->storeId)) {
                $subCode = 3;
                $subMsg = 'not set OrderIn param storeId';
            }
            if ($subCode == 0 && empty($bizIn->storeName)) {
                $subCode = 4;
                $subMsg = 'not set OrderIn param storeName';
            }
            if ($subCode == 0 && empty($bizIn->totalAmount)) {
                $subCode = 5;
                $subMsg = 'not set OrderIn param totalAmount';
            }
            if ($subCode == 0 && empty($bizIn->subject)) {
                $subCode = 6;
                $subMsg = 'not set OrderIn param subject';
            }
            //!TODO 2017年8月30日 屏蔽掉 广西广电商品没描述
            if ($subCode == 0 && empty($bizIn->body)) {
                //$subCode = 7;
                //$subMsg = 'not set OrderIn param body';
                $bizIn->body = '无';
            }
            if ($subCode == 0 && empty($bizIn->goodsDetail)) {
                $subCode = 8;
                $subMsg = 'not set OrderIn param goodsDetail';
            }
            if ($subCode == 0 && empty($bizIn->extendParams)) {
                $subCode = 9;
                $subMsg = 'not set OrderIn param extendParams';
            }

            if ($subCode != 0) {
                return $this->error(11007, '交易生成订单参数缺失', $subCode, $subMsg);
            }
        }

        if (empty($this->token)) {
            return $this->error(10005, '验证授权失败', 1, '授权码appAuthToken或token不能为空');
        }

        //checkUser();
        //return $this->user;
        //! 验证用户=================================================
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        if ($user->id != $bizIn->userId) {
            return $this->error(11007, '交易生成订单参数缺失', 16, '用户编号userId错误');
        }

        if ($bizIn->storeId != '1000') {
            return $this->error(11007, '交易生成订单参数缺失', 9, '找不到指定编号storeId的商家');
        }

        $order = TdoOrderData::where([
            'orderNo' => $bizIn->orderNo,
            'storeId' => $bizIn->storeId,
        ])->first();

        if (!empty($order)) {
            return $this->error(11007, '交易生成订单参数缺失', 10, '输入订单号orderNo重复');
        }

        //! 验证输入商品信息===============================================
        $products = $bizIn->goodsDetail;
        if (!is_array($products) || count($products) == 0) {
            return $this->error(11007, '交易生成订单参数缺失', 11, '输入商品信息格式出错');
        }

        {
            $subCode = 0;
            $subMsg = '';
            $amount = 0;
            foreach ($products as $product) {
                if (empty($product->goodsId)) {
                    $subCode = 12;
                    $subMsg = '输入商品编号goodsId为空';
                    break;
                }
                if (empty($product->quantity) || !is_integer($product->quantity)) {
                    $subCode = 14;
                    $subMsg = '输入商品数量quantity为空';
                    break;
                }

                $goods = TdoGoodsInfo::where([
                    'storeId' => $bizIn->storeId,
                    'goodsId' => $product->goodsId,
                ])->first();
                if (empty($goods)) {
                    $subCode = 13;
                    $subMsg = '找不到指定goodsId的商品';
                    break;
                }

                $amount += $goods->price * $product->quantity;
            }

            if ($subCode == 0 && $amount != $bizIn->totalAmount) {
                $subCode = 15;
                $subMsg = '输入商品总价格totalAmount不匹配';
            }

            if ($subCode != 0) {
                return $this->error(11007, '交易生成订单参数缺失', $subCode, $subMsg);
            }
        }

        $bizIn->tradeNo = $this->serialNo();
        $serialNo = null;
        $retailId = $user->retailId;
        $extendParams = empty($bizIn->extendParams) ? [] : (array)$bizIn->extendParams;
        {
            $result = $this->getRetailOrder($retailId, $bizIn);
            $subCode = BaseBody::getParam($result, 'subCode', 0);
            $subMsg = BaseBody::getParam($result, 'subMsg', '');
            if ($subCode != 0) {
                \Log::debug('-e getRetailOrder:', $result);
                return $this->error(11009, '交易请求业务订单出错', $subCode, $subMsg);
            }
            $biz = $result['biz'];
            $extendParams['biz'] = $biz;

            $serialNo = $result['serialNo'];
        }

        $userInfo = empty($bizIn->extUserInfo) ? [] : $bizIn->extUserInfo;

        $order = new TdoOrderData();
        $order->fill([
            'tradeNo' => $bizIn->tradeNo,
            'retailId' => $retailId,
            'orderNo' => $bizIn->orderNo,
            'userId' => $user->id,
            'storeId' => $bizIn->storeId,
            'storeName' => $bizIn->storeName,
            'totalAmount' => $bizIn->totalAmount,
            'subject' => $bizIn->subject,
            'body' => $bizIn->body,
            'goodsDetail' => json_encode($bizIn->goodsDetail),
            'extendParams' => json_encode($extendParams),
            'extUserInfo' => json_encode($userInfo),
            'payTimeout' => date('Y-m-d H:i:s', strtotime('+1 day')),
            'tradeStatus' => 0,
            'serialNo' => $serialNo,
        ]);
        $order->save();

        $bizOut = [
            'tradeNo' => $order->tradeNo,
            'retailId' => $order->retailId,
            'orderNo' => $order->orderNo,
            'userId' => $order->userId,
            'storeId' => $order->storeId,
            'totalAmount' => $order->totalAmount,
            'subject' => $order->subject,
            'body' => $order->body,
            'tradeStatus' => 0,
            'extendParams' => $order->extendParams,
            'extUserInfo' => $order->extUserInfo,
        ];
        return $this->biz($bizOut);
    }

    protected function pay($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->tradeNo)) {
                $subCode = 1;
                $subMsg = 'not set PayIn param tradeNo';
            }

            if ($subCode != 0) {
                return $this->error(11008, '交易支付请求', $subCode, $subMsg);
            }
        }

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }
        /* @var $order TdoOrderData */
        $order = TdoOrderData::find($bizIn->tradeNo);
        if (empty($order)) {
            return $this->error(11010, '交易请求支付出错', 1, '找不到指定编号订单');
        }

        if ($order->userId != $user->id) {
            return $this->error(11010, '交易请求支付出错', 2, '不是授权用户订单');
        }
        /* @var $extends ExtendParams */
        $extends = json_decode($order->extendParams);
        return $this->payRetailOrder($order->retailId, $extends->biz);
    }

    protected function bill($request)
    {
        if ($request) {
        }
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }
        $bills = TdoOrderData::where([
            'userId' => $user->id,
            'tradeStatus' => 2
        ])
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->biz($bills);
    }

    protected function address($request)
    {
        $bizContent = $request['bizContent'];
        /* @var $tdoAddress TdoUserAddress */
        $tdoAddress = json_decode($bizContent);

        if (empty($tdoAddress->userId)) {
            return $this->error(10005, '验证授权失败', 1, 'userId');
        }
        if (empty($tdoAddress->retailId)) {
            return $this->error(10005, '验证授权失败', 2, 'retailId');
        }
        if (empty($tdoAddress->name)) {
            $tdoAddress->name = '无';
        }
        if (empty($tdoAddress->phone)) {
            $tdoAddress->phone = '无';
        }
        if (empty($tdoAddress->address)) {
            $tdoAddress->address = '无';
        }
        $address = TdoUserAddress::where([
            'userId' => $tdoAddress->userId,
            'retailId' => $tdoAddress->retailId,
        ])->first();
        if (empty($address)) {
            $address = new TdoUserAddress();
        }
        $address->fill((array)$tdoAddress);
        $address->save();
        return $this->biz('success');
    }

    protected function addressIO($request)
    {
        if ($request) {
        }
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }
        /** @var BizService $bizSrv */
        $bizSrv = app(BizService::class);
        $bizOut = [
            'submitUrl' => $bizSrv->addressSubmitUrl($user->id, $user->retailId),
            'queryUrl' => $bizSrv->addressQueryUrl($user->id, $user->retailId),
        ];
        return $this->biz($bizOut);
    }
}
