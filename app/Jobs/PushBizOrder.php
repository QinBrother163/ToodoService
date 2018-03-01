<?php

namespace App\Jobs;

use App\Toodo\Biz\BizService;
use App\Toodo\Trade\TdoOrderData;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;


// 马上执行
class PushBizOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var TdoOrderData
     */
    protected $order;

    public function __construct(TdoOrderData $order)
    {
        $this->order = $order;
    }

    public function handle(BizService $bizSrv)
    {
        $order = $this->order;
        $order->setHidden([]);
        $ret = $bizSrv->order($order);
        if ($ret === false) {
            $this->release();
            return;
        }
        {
            Log::info('-e PushBizOrder ret:' . $ret);
        }
        if ($ret == 11020) {
            // 订单号重复
            Log::info('-e 重复订单号 tradeNo:' . $order->tradeNo);
        }
        if ($ret !== 'success') {
            $this->release();
            return;
        }
    }
}
