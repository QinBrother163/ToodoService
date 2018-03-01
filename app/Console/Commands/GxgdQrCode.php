<?php

namespace App\Console\Commands;

use App\Toodo\Gxgd\GxgdQr;
use Illuminate\Console\Command;

class GxgdQrCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gxgd:qr {func=token} {content=""}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成二维码';

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
        $func = $this->argument('func');
        $content = $this->argument('content');

        /** @var GxgdQr $qr */
        $qr = app(GxgdQr::class);

        switch ($func){
            case 'token':
                $ret = $qr->token();
                if($ret){
                    echo 'gxgd:qr token success => '.$ret;
                }else{
                    echo 'gxgd:qr token failure';
                }
                break;
            case 'create':
                $ret = $qr->create($content);
                if($ret){
                    echo 'gxgd:qr create success => '.$ret;
                }else{
                    echo 'gxgd:qr create failure';
                }
                break;
        }
        return true;
    }
}
