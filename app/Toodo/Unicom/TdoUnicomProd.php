<?php

namespace App\Toodo\Unicom;

use Illuminate\Database\Eloquent\Model;

class TdoUnicomProd extends Model
{
    public $timestamps = false;
    protected $hidden = [
        'id',
        'env',
        'verify',
    ];
}
