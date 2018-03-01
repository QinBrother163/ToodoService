<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TdeUser extends Model
{
    protected $primaryKey = 'userId';
    public $incrementing = false;
    protected $fillable = [
        'userId',
        'nick',
        'coins',
        'hisCoins',
        'biz',
        'ownTD003', 'ownTD011', 'ownTD005', 'ownTD017',
        'childLock',
        'danceMat',
    ];
    protected $hidden = ['biz'];

    public $timestamps = false;
}
