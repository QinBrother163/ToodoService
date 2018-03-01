<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoStbLog extends Model
{
    protected $fillable = [
        'userId',
        'loginTime',
        'uid',
        'model',
        'type',
        'ram',
        'os',
        'gName',
        'gVendor',
        'gVersion',
        'gRam',
        'gMt',
        'gRt',
    ];
    public $timestamps = false;
}
