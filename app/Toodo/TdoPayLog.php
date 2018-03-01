<?php

namespace App\Toodo;

use Illuminate\Database\Eloquent\Model;

class TdoPayLog extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'tradeNo';
    protected $fillable = [
        'tradeNo',
        'userId',
        'retailId',
        'biz',
        'created_at',
    ];
}
