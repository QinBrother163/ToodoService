<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TurntableWinning extends Model
{
    protected $fillable = [
        'id',
        'userID',
        'userName',
        'prizeID',
        'prizeName',
        'winningDate',
        'state'
    ];


    protected $table = 'tde_turntable_winning';
    public $primaryKey = 'id';
    public $timestamps = false;
}
