<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TdePageInfo extends Model
{
    protected $hidden = [
        'id', 'page'
    ];
    public $timestamps = false;
}
