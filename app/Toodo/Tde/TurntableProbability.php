<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TurntableProbability extends Model
{
    protected $fillable = [
        'userType',
        'onePro',
        'twoPro',
        'threePro',
        'fourPro',
        'fivePro',
        'sixPro'
    ];


    protected $table = 'tde_turntable_probability';
    public $primaryKey = 'userType';
    public $timestamps = false;
}
