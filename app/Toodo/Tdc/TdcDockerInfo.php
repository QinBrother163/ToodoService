<?php

namespace App\Toodo\Tdc;

use Illuminate\Database\Eloquent\Model;

class TdcDockerInfo extends Model
{
    protected $fillable = [
        'subject',
        'body',
        'count',
        'items',
    ];
    protected $hidden = [
        'id',
        'items',
    ];
    public $timestamps = false;
}
