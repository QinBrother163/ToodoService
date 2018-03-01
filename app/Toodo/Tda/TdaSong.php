<?php

namespace App\Toodo\Tda;

use Illuminate\Database\Eloquent\Model;

class TdaSong extends Model
{
    protected $primaryKey = 'songId';
    public $timestamps = false;
    public $incrementing = false;
}
