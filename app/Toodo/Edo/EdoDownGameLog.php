<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoDownGameLog extends Model
{
    protected $fillable = [
        'userId',
        'gameId',
        'versionCode',
        'fileInfos',
        'flag',
        'time',
    ];

    public $timestamps = false;
}
