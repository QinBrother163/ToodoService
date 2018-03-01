<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TurntablePrize extends Model
{
    protected $fillable = [
        'prizeID',
        'prizeName',
        'date',
        'prizeNum'
    ];


    protected $table = 'tde_turntable_prize';
    public $primaryKey = 'prizeID';
    public $timestamps = false;
}
