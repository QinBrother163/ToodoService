<?php

namespace App\Toodo\Trade;

use App\Jobs\PushBizOrder;
use App\Toodo\Gxgd\GxgdQr;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Serve\Server;
use App\Toodo\Serve\TdoServiceData;
use App\Toodo\Edo\EdoBizService;
use App\Toodo\Tde\TdeBizService;
use App\User;


class Trader
{
    public function onCallback($request)
    {
        //! 修改订单状态
        $serialNo = $request['serialNo'];
        $code = $request['code'];

        /* @var TdoOrderData $order */
        $order = TdoOrderData::where([
            'serialNo' => $serialNo,
        ])->first();

        /* @var $extends ExtendParams */
        $extends = json_decode($order->extendParams);

        $url = $extends->callbackUrl;
        $data = $extends->data;

        if ($code == 0) {
            if ($order->tradeStatus != 2) {
                $order->tradeStatus = 2;
                $order->payTime = date('Y-m-d H:i:s');
                $order->save();

                $user = User::find($order->userId);
                $storeId = $order->storeId;
                /* @var $goodsDetail GoodsInfo[] */
                $goodsDetail = json_decode($order->goodsDetail);

                foreach ($goodsDetail as $goods) {
                    $product = TdoGoodsInfo::where([
                        'storeId' => $storeId,
                        'goodsId' => $goods->goodsId,
                    ])->first();
                    if ($product) {
                        $this->bookProduct($user, $product, $goods->quantity);

                        /* @var $tdeBiz TdeBizService */ //页面大厅而已
                        $tdeBiz = app(TdeBizService::class);
                        $tdeBiz->onBuyGoods($user, $product, $goods->quantity);
                    }
                }

                $job = new PushBizOrder($order);
                dispatch($job);
            }
        }

        $inArgs = [
            'userId' => $order->userId,
            'tradeNo' => $order->tradeNo,
            'goodsName' => $order->subject,
        ];
        $content = 'http://feiben.toodo.com.cn/tdbiz/gxgd/address?' . http_build_query($inArgs);
        /** @var GxgdQr $qr */
        $qr = app(GxgdQr::class);
        $qrUrl = $qr->create($content);

        $args = [
            'qrImg' => $qrUrl,
            'data' => $data,
            'code' => $code,
            'sign' => 'xxx',
            'ts' => time(),
        ];
        return redirect()->away($url . '?' . http_build_query($args));
    }

    public function onNotice($request)
    {
        if ($request) {
        }
        return true;
    }

    /**
     * @param $user User
     * @param $product TdoGoodsInfo
     * @param $quantity int
     */
    protected function bookProduct($user, $product, $quantity)
    {
        $category = $product->category;
        $complex = $product->complex;

        if ($category == 0 && $complex == 0) {
            $mth = $quantity;
            /* @var $srv TdoServiceData */
            $srv = TdoServiceData::firstOrNew([
                'userId' => $user->id,
                'retailId' => $user->retailId,
                'productId' => $product->productId,
            ]);
            $srv->book($user, $product, $mth);

        } else if ($complex) {
            /* @var $subGoodz GoodsInfo[] */
            $subGoodz = json_decode($product->comment);
            foreach ($subGoodz as $goods) {
                $subProd = TdoGoodsInfo::where([
                    'storeId' => $product->storeId,
                    'goodsId' => $goods->goodsId,
                ])->first();
                if ($subProd) {
                    $this->bookProduct($user, $subProd, $goods->quantity);
                }
            }
        }
    }

    /**
     * @param $user User
     * @param $tradeNo string
     * @param $logType int
     * @param $product TdoGoodsInfo
     * @param $time
     */
    public function logBill($user, $tradeNo, $logType, $product, $time)
    {
        $log = new TdoBillLog();
        $log->fill([
            'userId' => $user->id,
            'retailId' => $user->retailId,
            'tradeNo' => $tradeNo,
            'productId' => $product->productId,
            'subject' => $product->goodsName,
            'logType' => $logType,
            'amount' => $product->price,
            'created_at' => $time,
        ]);
        $log->save();
    }

    public function grabOrder($tradeNo, $log = true)
    {
        $order = TdoOrderData::find($tradeNo);
        if (empty($order)) return;
        if ($order->tradeStatus == 2) return;

        $order->tradeStatus = 2;
        $order->payTime = $order->created_at;
        $order->save();

        $storeId = $order->storeId;
        $retailId = $order->retailId;
        $user = User::find($order->userId);
        /* @var $goodsDetail GoodsInfo[] */
        $goodsDetail = json_decode($order->goodsDetail);

        /** @var Server $server */
        $server = app(Server::class);

        $cnt = count($goodsDetail);
        for ($i = 0; $i < $cnt; $i++) {
            $goods = $goodsDetail[$i];
            /** @var TdoGoodsInfo $product */
            $product = TdoGoodsInfo::where([
                'storeId' => $storeId,
                'goodsId' => $goods->goodsId,
            ])->first();
            if (empty($product)) continue;

            $server->open($user, $product, $tradeNo, 0, $log, $order->payTime);

            if ($retailId == config('retail.unicom')) {
                /* @var $edoBiz EdoBizService */
                $edoBiz = app(EdoBizService::class);
                $edoBiz->onBuyGoods($user, $product, $goods->quantity);
            }
        }
    }

    public function dropOrder($tradeNo)
    {
        $order = TdoOrderData::find($tradeNo);
        if (empty($order)) {
            \Log::info("-e dropOrder empty tradeNo $tradeNo");
            return;
        }

        $user = User::find($order->userId);
        $storeId = $order->storeId;

        /* @var $goodsDetail GoodsInfo[] */
        $goodsDetail = json_decode($order->goodsDetail);

        foreach ($goodsDetail as $goods) {
            /** @var TdoGoodsInfo $product */
            $product = TdoGoodsInfo::where([
                'storeId' => $storeId,
                'goodsId' => $goods->goodsId,
            ])->first();
            if (empty($product)) {
                \Log::info("-e empty prod $goods->goodsId");
                continue;
            }
            //echo "$tradeNo goodsId $goods->goodsId";

            /** @var Server $server */
            $server = app(Server::class);
            $server->close($user, $product);
            //echo "\n";
        }
    }
}