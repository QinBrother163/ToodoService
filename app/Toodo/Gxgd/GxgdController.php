<?php

namespace App\Toodo\Gxgd;

use App\Http\Controllers\Controller;
use App\Toodo\Trade\IPayment;
use Illuminate\Http\Request;


class GxgdController extends Controller
{
    protected $payment;

    function __construct(IPayment $payment)
    {
        $this->payment = $payment;
    }

    //! 模拟广西在线支付
    public function pay(Request $request)
    {
        $orderId = $request['orderId'];

        $resp = [
            'retCode' => 'SUCCESS',
            'retMsg' => '调用成功',
            'orderId' => $orderId,
            'handleTime' => date('Y-m-d H:i:s'),
            'totalFee' => '360.00',
            'partner' => '1000000018',
            'stbId' => '1140150003308',
            'productId' => 'xxx',
            'productName' => '测试产品',
            'sign' => 'xxx',
        ];
        return $this->payment->submit(url('/api/toodo/gxgd/onCallback'), $resp);
    }

    //! 在线支付回调
    public function onCallback(Request $request)
    {
        //! 失败 http://192.168.1.194/tdsrv/api/toodo/gxgd/onCallback?retCode=FAIL&retMsg=%E8%B0%83%E7%94%A8%E5%90%8E%E7%AB%AF%E7%B3%BB%E7%BB%9F%E5%8D%95%E6%AC%A1%E4%BB%98%E8%B4%B9%E5%A4%84%E7%90%86%E5%A4%B1%E8%B4%A5%E3%80%82&orderId=960012017052521200051333&handleTime=2017-05-25+21%3A20%3A28&totalFee=500&partner=1000000018&stbId=1140150003308&productId=404550068715&productName=%E5%85%85%E5%80%BC50T%E5%B8%81&sign=c6178374fd6ead4a285b37ba09d53443
        //! 成功 http://192.168.1.194/tdsrv/api/toodo/gxgd/onCallback?retCode=SUCCESS&retMsg=&orderId=960012017052521050091364&handleTime=2017-05-25+21%3A05%3A19&totalFee=10&partner=1000000018&stbId=1140150003308&productId=404550068570&productName=CP%E5%8C%85%E6%9C%88%E6%B5%8B%E8%AF%95%E4%BA%A7%E5%93%81%E5%8C%85&sign=70d408a6dbaa3e2229780708e71f80c0
        \Log::info('-e ---------------------------------0');
        \Log::info('-e gxgd onCallback ', $request->all());
        \Log::info('-e ---------------------------------111111111111');
        return $this->payment->onCallback($request);
    }

    public function onNotice(Request $request)
    {
        \Log::info('-e ---------------------------------0');
        \Log::info('-e gxgd onNotice ', $request->all());
        \Log::info('-e ---------------------------------22222222222');
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
        return redirect()->away('http://10.0.4.108/tdenter');
    }
}
