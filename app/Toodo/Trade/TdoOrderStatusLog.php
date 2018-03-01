<?php

namespace App\Toodo\Trade;

use Illuminate\Database\Eloquent\Model;

class TdoOrderStatusLog extends Model
{
    protected $fillable = [
        'userId',
        'tradeNo',
        'tradeStatus',
        'updated_at',
    ];
    public $timestamps = false;
}
