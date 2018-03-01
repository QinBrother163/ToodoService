<?php

namespace App\Toodo\Trade;

class GoodsInfo
{
    public $goodsId;
    public $goodsName;
    public $price;
    public $quantity;
}

class ExtendParams
{
    /**
     * @var string
     */
    public $callbackUrl;
    /**
     * @var string|array|object
     */
    public $data;
    /**
     * @var object|array
     */
    public $biz;
}

class OrderIn
{
    public $orderNo;
    public $userId;
    public $storeId;
    public $storeName;
    public $totalAmount;
    public $subject;
    public $body;
    /**
     * @var GoodsInfo[]
     */
    public $goodsDetail;
    /**
     * @var ExtendParams
     */
    public $extendParams;
    public $extUserInfo;

    public $tradeNo;
}