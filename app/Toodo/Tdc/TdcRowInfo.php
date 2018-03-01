<?php

namespace App\Toodo\Tdc;

use Illuminate\Database\Eloquent\Model;

class TdcRowInfo extends Model
{
    protected $fillable = [
        'docker',
        'subject',
        'body',
        'width',
        'height',
        'padding',
        'spacing',
        'count',
        'span',
        'slots',
        'imgs',
    ];
    protected $hidden = [
        'id',
        'docker',
        'imgs',
    ];
    public $timestamps = false;
}
