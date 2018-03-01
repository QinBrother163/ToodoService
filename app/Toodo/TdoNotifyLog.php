<?php

namespace App\Toodo;

use Illuminate\Database\Eloquent\Model;

class TdoNotifyLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'retailId',
        'method',
        'bizIn',
        'bizOut',
        'created_at',
    ];
}
