<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TdeCoinsLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'userId',
        'coins',
        'add',
        'time',
        'gameId',
        'goodsId',
        'goodsName',
    ];
}
