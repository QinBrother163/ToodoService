<?php

namespace App\Toodo\Biz;

use Illuminate\Database\Eloquent\Model;


class TdoUserAddress extends Model
{
    protected $fillable = [
        'userId',
        'retailId',
        'name',
        'phone',
        'address',
        'workday',
    ];
    protected $hidden = [
        'created_at',
        //'updated_at',
    ];
}
