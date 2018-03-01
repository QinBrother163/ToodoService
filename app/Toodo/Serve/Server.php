<?php

namespace App\Toodo\Serve;

use App\Toodo\Fast;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Trade\TdoBillLog;
use App\Toodo\Trade\Trader;
use App\User;

class Server
{
    protected $trader;

    function __construct(Trader $trader)
    {
        $this->trader = $trader;
    }

    /**
     * @param $user User
     * @param $product TdoGoodsInfo
     * @param $tradeNo string
     * @param int $mth 0.至月底 n.月数(1、3、6、12)
     * @param bool $log 是否记录账单
     * @param null $payTime
     */
    public function open($user, $product, $tradeNo, $mth = 0, $log = true, $payTime = null)
    {
        if (empty($payTime)) $payTime = date('Y-m-d H:i:s');

        if ($product->canOrder()) {
            $userId = $user->id;
            $productId = $product->productId;

            /** @var TdoServiceData $srv */
            $sv = TdoServiceData::where([
                'userId' => $userId,
                'productId' => $productId,
            ])->first();

            if (empty($sv)) {
                $beginTime = $payTime;
                $endTime = $beginTime;

                $sv = new TdoServiceData();
                $sv->fill([
                    'serialNo' => Fast::serialNo(),
                    'userId' => $userId,
                    'retailId' => $user->retailId,
                    'productId' => $productId,
                    'goodsName' => $product->goodsName,
                    'beginTime' => $beginTime,
                    'endTime' => $endTime,
                ]);
                $sv->created_at = $payTime;
            }

            if ($mth == 0) {
                $sv->tradeNo = $tradeNo;
                $sv->own = true;

                //记录包月消费
                $cntDay = intval(date('d')) - 1;
                $mthDay = intval(date('t'));
                $product->price = $product->price * ($mthDay - $cntDay) / $mthDay;//计算日期后价格
                if ($log) $this->trader->logBill($user, $tradeNo, 1, $product, $payTime);
            }

            $this->update($sv, $mth, $payTime);//更新有效期
            $sv->save();

        } else {
            if ($mth == 0) {
                //记录单点消费
                if ($log) $this->trader->logBill($user, $tradeNo, 3, $product, $payTime);
            }
        }

        if ($product->complex) {
            $subGoodz = json_decode($product->comment);

            $cnt = count($subGoodz);
            for ($i = 0; $i < $cnt; $i++) {
                $goods = $subGoodz[$i];
                /** @var TdoGoodsInfo $subProd */
                $subProd = TdoGoodsInfo::where([
                    'storeId' => $product->storeId,
                    'goodsId' => $goods->goodsId,
                ])->first();
                if (empty($subProd)) {
                    \Log::info('-e empty prod ' . $goods->goodsId);
                    continue;
                }
                if ($subProd->canOrder()) {
                    $this->open($user, $subProd, $tradeNo, $goods->quantity, $log, $payTime);
                }
            }
        }
    }

    /**
     * @param $user
     * @param TdoGoodsInfo $product
     * @param bool $stop 马上终止有效期
     */
    public function close($user, $product, $stop = false)
    {
        if ($product->canOrder()) {
            $userId = $user->id;
            $productId = $product->productId;

            /** @var TdoServiceData $sv */
            $sv = TdoServiceData::where([
                'userId' => $userId,
                'productId' => $productId,
            ])->first();

            if (empty($sv)) {
                return;
            }

            $now = date('Y-m-d H:i:s');
            if ($stop) {
                $sv->ownTime = $now;

                //更改消费记录金额
                /** @var TdoBillLog $log */
                $log = TdoBillLog::where([
                    'userId' => $userId,
                    'productId' => $productId,
                ])->where('created_at', '>', date('Y-m-01'))->first();
                if ($log) {
                    $cntDay = intval(date('d'));
                    $mthDay = intval(date('t'));
                    $log->amount = $product->price * $cntDay / $mthDay;
                    $log->save();
                }
            }
            $sv->own = false;
            //$sv->tradeNo = null;

            if ($sv->isOwn($now)) {
                $sv->save();
            } else {
                \Log::info("-e delete srv $userId $productId $sv->tradeNo");
                $sv->delete();//删掉了，所以service_datas数据少了
            }
        }
    }

    /**
     * @param $sv TdoServiceData
     * @param int $mth 0.至月底 n.月数(1、3、6、12)
     * @param null $now
     */
    public function update($sv, $mth, $now = null)
    {
        if (empty($now)) $now = date('Y-m-d H:i:s');
        if ($mth == 0) {
            $sv->ownTime = date('Y-m-t 23:59:59', strtotime($now));
        } else {
            if ($now < $sv->endTime) $now = $sv->endTime;
            $sv->endTime = date('Y-m-d H:i:s', strtotime("$now +$mth month"));
        }
    }
}