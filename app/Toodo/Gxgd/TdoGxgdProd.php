<?php

namespace App\Toodo\Gxgd;

use Illuminate\Database\Eloquent\Model;


class TdoGxgdProd extends Model
{
    protected $fillable = [
        'productId',
        'goodsName',
        'feeType',
        'price',
        'idcId',
        'bossId',
        'tariffId',
        'env',
        'verify',
        'pId', 'pName', 'pDesc', 'pType', 'pUnit', 'pValue',
    ];

    public $timestamps = false;


    public function queryProdInfo($stbId)
    {
        $biz = [
            'method' => 'queryProdInfo',
            'stbId' => $stbId,
            'productId' => $this->idcId,
        ];
        /** @var GxgdPayment $payment */
        $payment = app(GxgdPayment::class);
        $ret = $payment->send($biz);
        $this->beauty($ret);
    }

    public function queryPromotionInfo($stbId)
    {
        $biz = [
            'method' => 'queryPromotionInfo',
            'stbId' => $stbId,
            'productId' => $this->idcId,
        ];
        /** @var GxgdPayment $payment */
        $payment = app(GxgdPayment::class);
        $ret = $payment->send($biz);
        $this->beauty($ret);
    }

    public function queryPromotionDetailsInfo($userId)
    {
        $biz = [
            'method' => 'queryPromotionDetailsInfo',
            'userId' => $userId,
            'productId' => $this->idcId,
            'promotionId' => $this->pId,
        ];
        /** @var GxgdPayment $payment */
        $payment = app(GxgdPayment::class);
        $ret = $payment->send($biz);
        $this->beauty($ret);
    }

    public function beauty($json)
    {
        echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    }
}
