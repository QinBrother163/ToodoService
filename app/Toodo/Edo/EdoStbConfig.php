<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoStbConfig extends Model
{
    protected $fillable = [
        'model',
        'gameType',
    ];
    public $timestamps = false;
}
