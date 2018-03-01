<?php

namespace App\Toodo\Trade;

use Illuminate\Database\Eloquent\Model;

class TdoOrderData extends Model
{
    protected $fillable = [
        'tradeNo',
        'retailId',
        'orderNo',
        'userId',
        'storeId',
        'storeName',
        'totalAmount',
        'subject',
        'body',
        'goodsDetail',
        'extendParams',
        'extUserInfo',
        'payTimeout',
        'payAmount',
        'receiptAmount',
        'serialNo',
        'tradeStatus',
        'payTime',
        'sendPayTime',
    ];

    protected $primaryKey = 'tradeNo';

    protected $hidden = [
        'retailId',
        'orderNo',
        'userId',
        'storeId',
        'storeName',
        'extendParams',
        'extUserInfo',
        'payTimeout',
        'serialNo',
        'payTime',
        'sendPayTime',
        'updated_at'
    ];

    public $incrementing = false;
}
