<?php

namespace App\Console;

use App\Jobs\PushBizOrderRetry;
use App\Jobs\PushUserAction;
use App\Toodo\Serve\TdoServiceData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\GxgdSongsADI::class,
        \App\Console\Commands\GxgdProdApi::class,
        \App\Console\Commands\GxgdAssetApi::class,
        \App\Console\Commands\GxgdQrCode::class,

        \App\Console\Commands\HnyxAssetApi::class,

        \App\Console\Commands\CreateYearMonthTable::class,
        \App\Console\Commands\MoveDayTable::class,
        \App\Console\Commands\MoveLessDateTable::class,
        \App\Console\Commands\TdoUpdateService::class,
        \App\Console\Commands\EdoUpdateScut::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->command('tdo:mdt --force')->dailyAt('13:00');
        // $schedule->command('emails:send --force')->monthlyOn(4, '15:00');

        $schedule->call(function () {
            $hnyx_net_enable = env('HNYX_NET_ENABLE');
            if ($hnyx_net_enable) {
                //Artisan::queue('hnyx:asset', ['func' => 'ingest']);
            }
        })->everyMinute();

        $schedule->call(function () {
            //dispatch(new PushBizOrderRetry()); //定时重传上传失败的订单
            //dispatch(new PushUserAction()); //定时上传用户行为
        })->hourly();

        $schedule->call(function () {
            $gxgd_net_enable = env('GXGD_NET_ENABLE');
            if ($gxgd_net_enable) {
                Artisan::queue('gxgd:qr', ['func' => 'token']);
            }
        })->hourlyAt(6);

        $schedule->call(function () {
//            $date = date('Y-m-d', strtotime('-30 day'));
//            Artisan::queue('tdo:mdt', ['table' => 'tdo_order_datas', 'date' => $date, 'field' => 'created_at']);
        })->dailyAt('01:00');
        $schedule->call(function () {
//            $date = date('Y-m-d', strtotime('-1 day'));
//            Artisan::queue('tdo:mdt', ['table' => 'tde_coins_logs', 'date' => $date, 'field' => 'time']);
        })->dailyAt('01:20');
        $schedule->call(function () {
//            $date = date('Y-m-d', strtotime('-1 day'));
//            Artisan::queue('tdo:mdt', ['table' => 'tda_records', 'date' => $date, 'field' => 'time']);
        })->dailyAt('01:40');


        $schedule->call(function () {
            /** @var TdoServiceData[] $svs */
            $svs = TdoServiceData::where('own', 1)->get();
            foreach ($svs as $sv) {
                Artisan::queue('tdo:usv', ['serialNo' => $sv->serialNo]);
            }
        })->monthlyOn(1, '03:33');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        /** @noinspection PhpIncludeInspection */
        require base_path('routes/console.php');
    }
}
