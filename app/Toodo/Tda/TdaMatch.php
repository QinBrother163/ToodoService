<?php

namespace App\Toodo\Tda;

use Illuminate\Database\Eloquent\Model;

class TdaMatch extends Model
{
    protected $fillable = [
        'songId',
        'records',
        'beginTime',
        'endTime',
        'last',
    ];
    public $timestamps = false;
}
