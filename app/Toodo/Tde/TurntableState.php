<?php

namespace App\Toodo\Tde;

use Illuminate\Database\Eloquent\Model;

class TurntableState extends Model
{
    protected $fillable = [
        'userID',
        'freeStatus',
        'freeDate',
        'addNumber',
        'addNumberDate',
    ];


    protected $table = 'tde_turntable_state';
    public $primaryKey = 'userID';
    public $timestamps = false;
}
