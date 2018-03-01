<?php

namespace App\Console\Commands;

use App\Toodo\Gxgd\GxgdPayment;
use App\Toodo\Gxgd\ProdDto;
use App\Toodo\Gxgd\queryProdInfoOut;
use App\Toodo\Gxgd\TariffDto;
use App\Toodo\Gxgd\TdoGxgdProd;
use App\Toodo\Market\TdoGoodsInfo;
use Illuminate\Console\Command;


class GxgdProdApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gxgd:prod {func=sync} {args=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '广西查询商品信息';

    protected $netEnable;
    protected $netEnv; //! 0.正式环境 1.测试环境

    protected $stbId;
    protected $userId;


    public function __construct()
    {
        parent::__construct();
        $this->netEnable = env('GXGD_NET_ENABLE', true);
        $this->netEnv = env('GXGD_NET_ENV', 0);

        if ($this->netEnv == 0) {
            $this->stbId = '1140150003308';
            $this->userId = '108749857';
        } else {
            $this->stbId = '1140150003308';
            $this->userId = '108767787';
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 查询指定产品
        $func = $this->argument('func');
        switch ($func) {
            case 'query':
                $this->query();
                break;
        }
        return true;
    }

    public function query()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "query------------ \$args empty.";
            return;
        }

        if ($args == 'all') {
            //            $assets = TdoGxgdAsset::all();
            //            foreach ($assets as $asset) {
            //                $this->queryAsset($asset);
            //            }
        } else {
            $prodId = intval($args);
            $prod = TdoGxgdProd::find($prodId);
            $this->queryProd($prod);
        }
    }

    public function queryProd(TdoGxgdProd $prod)
    {
        if ($prod->feeType <= 1) {//免费、一次性
            return;
        }

        $goods = TdoGoodsInfo::find($prod->productId);

        $ret = false;
        if (empty($goods)) {
            if ($this->netEnv != $prod->env) {
                return;
            }
            // 查询商品
            // 查询促销
            // 查询促销详情
            if ($prod->feeType == 90) {
                $ret = $prod->queryPromotionInfo($this->stbId);
                $ret = $prod->queryPromotionDetailsInfo($this->userId);
            } else {
                $ret = $prod->queryProdInfo($this->stbId);
            }

        } else {
            if ($goods->complex) {
                // 查询促销
                // 查询促销详情
                $ret = $prod->queryPromotionInfo($this->stbId);
                $ret = $prod->queryPromotionDetailsInfo($this->userId);
            } else {
                //! 查询商品
                $ret = $prod->queryProdInfo($this->stbId);
            }
        }
        if ($ret) {
            $prod->save();
        }
    }

    public function dump()
    {
        /** @var GxgdPayment $gxgd */
        $gxgd = app(GxgdPayment::class);

        $prodIds = '';
        $prods = TdoGxgdProd::where([
            'verify' => 1,
            'env' => 0,
        ])->where('feeType', '>', 1)->get();
        echo json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $cnt = 0;
        foreach ($prods as $prod) {
            if ($cnt > 0) {
                $prodIds .= '|';
            }
            $prodIds .= $prod->idcId;
            $cnt++;
        }

        $bizIn = [
            'method' => 'queryProdInfo',
            'stbId' => '34290157870',
            'productId' => $prodIds,
        ];

        $json = $gxgd->send($bizIn);
        if ($json === false) {
            return ['subCode' => '404', 'subMsg' => '业务请求异常'];
        }
        if ($json->isSuccess != 'T') {
            return ['subCode' => '403', 'subMsg' => '业务请求失败'];
        }
        /* @var $response queryProdInfoOut */
        $response = $json->response;
        if ($response->retCode != 'SUCCESS') {
            return ['subCode' => '402', 'subMsg' => '业务返回失败.' . $response->resultMessage];
        }
        /** @var ProdDto[] $prodInfos */
        $prodInfos = $response->prodInfos;
        echo json_encode($prodInfos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        if (count($prodInfos) != count($prods)) {
            return ['subCode' => '401', 'subMsg' => '返回道具数量不同'];
        }

        $cnt = 0;
        foreach ($prods as $prod) {
            $info = $prodInfos[$cnt];
            $prod->goodsName = $info->prodName;
            $prod->bossId = $info->prodId;
            /** @var TariffDto $tariff */
            $tariff = $info->tariffs[0];
            $prod->tariffId = $tariff->tariffId;
            $prod->price = (int)($tariff->priceValue * 100);
            $prod->save();
            $cnt++;
        }
        return ['subCode' => '0', 'subMsg' => '处理成功'];
    }
}
