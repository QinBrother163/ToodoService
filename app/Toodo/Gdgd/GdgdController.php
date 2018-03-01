<?php

namespace App\Toodo\Gdgd;

use App\Http\Controllers\Controller;
use App\Toodo\Trade\IPayment;
use Illuminate\Http\Request;

class GdgdController extends Controller
{
    protected $payment;

    function __construct(IPayment $payment)
    {
        $this->payment = $payment;
    }

    //! 模拟广东在线支付
    public function pay(Request $request)
    {
        $orderId = $request->orderId;
        $resp = [
            'retCode' => 'SUCCESS',
            'retMsg' => '调用成功',
            'orderId' => $orderId,
            'handleTime' => date('Y-m-d H:i:s'),
            'totalFee' => '360.00',
            'partner' => '00',
            'stbId' => 'xxx',
            'productId' => 'xxx',
            'productName' => '测试产品',
            'sign' => 'xxx',
        ];
        return $this->payment->submit(url('/api/toodo/gdgd/onCallback'), $resp);
    }

    //! 在线支付回调
    public function onCallback(Request $request)
    {
        return $this->payment->onCallback($request);
    }

    public function onNotice(Request $request)
    {
        return $this->payment->onNotice($request);
    }

    public function onConfirm(Request $request)
    {
        return $this->payment->onConfirm($request);
    }

    public function test()
    {
        return $this->payment->submit('http://www.baidu.com', [
            'wd' => 'aaaa',
            'ie' => 'utf-8',
        ]);
    }

    public function wsdl(){
        return response()-file('soap/SpService.wsdl');
    }
}
