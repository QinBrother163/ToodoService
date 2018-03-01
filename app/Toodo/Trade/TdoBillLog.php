<?php

namespace App\Toodo\Trade;

use Illuminate\Database\Eloquent\Model;

class TdoBillLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'userId',
        'retailId',
        'tradeNo',
        'productId',
        'subject',
        'logType',
        'amount',
        'created_at',
    ];
}
