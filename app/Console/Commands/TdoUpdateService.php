<?php

namespace App\Console\Commands;

use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Serve\Server;
use App\Toodo\Serve\TdoServiceData;
use App\Toodo\Trade\Trader;
use App\User;
use Illuminate\Console\Command;


class TdoUpdateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tdo:usv {serialNo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '月初更新服务有效期';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $serialNo = $this->argument('serialNo');
        $sv = TdoServiceData::find($serialNo);
        if (empty($sv)) return 404;

        \Log::info('-e update service ' . $serialNo);
        $user = User::find($sv->userId);
        $product = TdoGoodsInfo::find($sv->productId);

        /** @var Trader $trader */
        $trader = app(Trader::class);
        $trader->logBill($user, $sv->tradeNo, 2, $product, date('Y-m-d H:i:s'));

        /** @var Server $server */
        $server = app(Server::class);
        $server->update($sv, 0);

        return 0;
    }
}
