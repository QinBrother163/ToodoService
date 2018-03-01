<?php

namespace App\Toodo\Tdc;

use Illuminate\Database\Eloquent\Model;

class TdcItemInfo extends Model
{
    protected $fillable = [
        'type',
        'typeId',
        'imgs',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
