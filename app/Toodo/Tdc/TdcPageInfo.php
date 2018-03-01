<?php

namespace App\Toodo\Tdc;

use Illuminate\Database\Eloquent\Model;

class TdcPageInfo extends Model
{
    protected $fillable = [
        'area',
        'page',
        'docker',
    ];
    protected $hidden = [
        'area',
        'page',
    ];
    public $timestamps = false;
}
