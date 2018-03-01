<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoUserActionLog extends Model
{
    protected $fillable = [
        'userId',
        'page',
        'action',
        'flag',
        'biz',
        'updated_at',
    ];
    public $timestamps = false;
}
