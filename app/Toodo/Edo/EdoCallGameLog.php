<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoCallGameLog extends Model
{
    protected $fillable = [
        'userId',
        'gameId',
        'versionCode',
        'time',
    ];

    public $timestamps = false;
}
