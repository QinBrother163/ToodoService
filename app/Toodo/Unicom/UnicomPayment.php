<?php

namespace App\Toodo\Unicom;

use App\Toodo\Fast;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Trade\BasePayment;
use App\Toodo\Trade\TdoOrderData;


class UnicomPayment extends BasePayment
{
    public function signCode($ts)
    {
    }

    public function createOrder($inputBody)
    {
        // TODO: Implement createOrder() method.
        $storeId = $inputBody->storeId;
        $goodz = $inputBody->goodsDetail;


        $goods = $goodz[0];
        /* @var TdoGoodsInfo $product */
        $product = TdoGoodsInfo::where([
            'storeId' => $storeId,
            'goodsId' => $goods->goodsId,
        ])->first();
        if (empty($product)) {
            return [
                'subCode' => 403,
                'subMsg' => '找不到指定产品',
            ];
        }

        $biz = TdoUnicomProd::where([
            'productId' => $product->productId
        ])->first();
        if (empty($biz)) {
            return [
                'subCode' => 404,
                'subMsg' => '找不到联通指定产品',
            ];
        }

        $biz->backUrl = url('/api/toodo/unicom/onCallback');

        return [
            'subCode' => 0,
            'subMsg' => '',
            'biz' => $biz,
            'serialNo' => '',
        ];
    }

    public function getOrderUrl($tradeNo)
    {
        $appId = '';//$this->appId;
        $appSecret = '';//$this->appSecret;

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
    }

    protected function payOrder($tradeNo)
    {
        return view('hnyx.order', []);
    }

    /**
     * @param $order TdoOrderData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function payConsume($order)
    {
        return view('hnyx.consume', []);

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
        $bizOut = [];
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
        $bizOut = [];
        return view('hnyx.result', (array)$bizOut);
    }
}