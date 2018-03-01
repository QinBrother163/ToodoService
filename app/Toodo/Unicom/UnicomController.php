<?php

namespace App\Toodo\Unicom;

use App\Http\Controllers\Controller;
use App\Toodo\TdoNotifyLog;
use App\Toodo\Trade\Trader;
use Illuminate\Http\Request;


class UnicomController extends Controller
{
    //! 在线订购回调
    public function onCallback(Request $request)
    {
        \Log::debug('-e +');
        \Log::debug('-e unicom onCallback ', $request->all());
        \Log::debug('-e -------------------------------------------------------');

        $bizIn = $request->all();

        if ($request->isMethod('get')) {
            //开通服务
            //{"Act":"100","AppId":"sdtgjsf","ThirdAppId":null,"Uin":"cutv201503182010055","ConsumeStreamId":"e385e4ab-76a8-4798-89e8-7a5d201c75c7","TradeNo":"20171129112521495256","Subject":null,"Amount":"0.0","ChargeAmount":"0.0","ChargeAmountIncVAT":"0.0","ChargeAmountExclVAT":"0.0","Country":null,"Currency":null,"Note":"20171129112521495256","TradeStatus":"completed","CreateTime":null,"Share":"0.0","IsTest":"false","Sign":"19683e805e6f977a5323c5af945312b1"}
            if (isset($bizIn['TradeNo'])) {
                $tradeNo = $bizIn['TradeNo'];
                /** @var Trader $trader */
                $trader = app(Trader::class);
                $trader->grabOrder($tradeNo);
            }

            $bizOut = ['ErrorCode' => '1', 'ErrorDesc' => '处理成功',];

            $log = new TdoNotifyLog();
            $log->fill([
                'retailId' => config('retail.unicom'),
                'method' => 'get',
                'bizIn' => json_encode($bizIn),
                'bizOut' => json_encode($bizOut),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $log->save();
            return $bizOut;
        }
        if ($request->isMethod('post')) {
            //退订服务
            //{"contentId":null,"extendInfo":null,"notificationURL":"http:\/\/120.25.107.206\/tdsrv.unicom\/api\/toodo\/unicom\/onCallback","operateType":"0","productId":"sdtgjsfby025@201","serviceId":null,"transactionId":"201709151638440000020304","userId":"testtest0001"}
            if (isset($bizIn['transactionId'])) {
                $tradeNo = $bizIn['transactionId'];
                /** @var Trader $trader */
                $trader = app(Trader::class);
                $trader->dropOrder($tradeNo);
            }

            $bizOut = ['code' => 0, 'resultDescription' => '成功',];

            $log = new TdoNotifyLog();
            $log->fill([
                'retailId' => config('retail.unicom'),
                'method' => 'post',
                'bizIn' => json_encode($bizIn),
                'bizOut' => json_encode($bizOut),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $log->save();
            return $bizOut;
        }
        return '失败';
    }
}
