<?php

namespace App\Toodo\Hnyx;

use Artisan;
use App\Http\Controllers\Controller;
use App\Toodo\Biz\BizService;
use App\Toodo\Trade\IPayment;
use Illuminate\Http\Request;


class HnyxController extends Controller
{
    protected $payment;
    protected $netEnable;

    function __construct(IPayment $payment)
    {
        $this->payment = $payment;
        $this->netEnable = env('HNYX_NET_ENABLE', false);
    }

    //! 在线支付
    public function pay(Request $request)
    {
        $this->validate($request, [
            'orderId' => 'required',
            'ts' => 'required',
            'sign' => 'required',
        ]);
        \Log::debug('-e ---------------------------------0');
        \Log::debug('-e hnyx pay ', $request->all());
        \Log::debug('-e ---------------------------------111111111111');
        return $this->payment->payOnline($request);
    }

    //! 在线订购回调
    public function onCallback(Request $request)
    {
        //http://feiben.toodo.com.cn/?cseq=2017080900001&productId=941&assetId=null&returnCode=00000010
        \Log::debug('-e ---------------------------------0');
        \Log::debug('-e hnyx onCallback ', $request->all());
        \Log::debug('-e ---------------------------------222222222222');
        return $this->payment->onCallback($request);
    }

    public function onNotice(Request $request)
    {
        \Log::debug('-e ---------------------------------0');
        \Log::debug('-e hnyx onNotice ', $request->all());
        \Log::debug('-e ---------------------------------333333333333');
        return $this->payment->onNotice($request);
    }

    public function onIndex(Request $request)
    {
        //        if (empty($request['orderNo'])) {
        //            return redirect()->away($url . '?' . http_build_query($args));
        //        }
        //        if (empty($request['orderNo'])) {
        //
        //        }
        //        $orderNo = $request['orderNo'];
        //        $storeId = $request['storeId'];
        //        $order = TdoOrderData::where([
        //            'orderNo' => $orderNo,
        //            'storeId' => $storeId,
        //        ])->first();
        //
        //        $extends = json_decode($order->extendParams);
        //
        //        $url = $extends->callbackUrl;
        //        $data = $extends->data;
        return redirect()->away('http://www.baidu.com');
    }

    public function payByQrCode(Request $request)
    {
        $bizIn = $request->all();
        if ($this->netEnable) {
            /** @var HnyxClient $client */
            $client = app(HnyxClient::class);
            return $client->payByQrCode($bizIn);
        } else {
            /** @var HnyxSim $sim */
            $sim = app(HnyxSim::class);
            return $sim->payByQrCode($bizIn);
        }
    }

    public function queryPayResult(Request $request)
    {
        $bizIn = $request->all();
        if ($this->netEnable) {
            /** @var HnyxClient $client */
            $client = app(HnyxClient::class);
            return $client->queryPayResult($bizIn);
        } else {
            /** @var HnyxSim $sim */
            $sim = app(HnyxSim::class);
            return $sim->queryPayResult($bizIn);
        }
    }

    public function address(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required',
            'retailId' => 'required',
            //'ts' => 'required',
            //'sign' => 'required',
        ]);

        $callbackUrl = $request->input('callbackUrl', null);

        $userId = $request->input('userId');
        $retailId = $request->input('retailId');

        /** @var BizService $bizSrv */
        $bizSrv = app(BizService::class);

        $queryUrl = $bizSrv->addressQueryUrl($userId, $retailId);

        $submitUrl = $bizSrv->addressSubmitUrl($userId, $retailId);
        $args = http_build_query([
            'url' => $submitUrl,
        ]);
        $qrUrl = url('/api/qrCode') . "?$args";

        return view('hnyx.address', [
            'callbackUrl' => $callbackUrl,
            'qrUrl' => $qrUrl,
            'qrValue' => $submitUrl,
            'queryUrl' => rawurlencode($queryUrl),
        ]);
    }

    public function onConsume($tradeNo, Request $request)
    {
        \Log::debug('-e ---------------------------------0');
        \Log::debug('-e tradeNo ' . $tradeNo);
        \Log::debug('-e hnyx onConsume ', $request->all());
        \Log::debug('-e ---------------------------------4444444444444');
        /** @var HnyxPayment $payment */
        $payment = app(HnyxPayment::class);
        return $payment->onConsume($request, $tradeNo);
    }

    public function onIngest($songId, $opId, Request $request)
    {
        \Log::debug('-e ---------------------------------0');
        \Log::debug('-e opId ' . $opId);
        \Log::debug('-e hnyx onIngest ', $request->all());
        \Log::debug('-e ---------------------------------555555555555');

        $opId = intval($opId);
        $op = TdoHnyxAssetOp::find($opId);
        if ($op) {
            //$op->assetId = $request->input('assetId');
            $op->status = $request->input('status');
            if ($op->status == 1) {
                Artisan::queue('hnyx:asset', ['func' => 'verify', 'args' => $songId]);
            }
            $op->save();
        }
        return 'success';
    }

    public function simConsume($tradeNo)
    {
        /** @var HnyxPayment $payment */
        $payment = app(HnyxPayment::class);
        return $payment->simConsume($tradeNo);
    }
}
