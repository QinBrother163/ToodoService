<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoGameExt extends Model
{
    protected $fillable = [
        'gameId',
        'gameName',
        'gameNameCn',
        'gameType',
        'packageName',
        'startActivityName',
        'takeHandType',
        'freePlayTime',
        'playCount',
        'gameHint',
        'infraredPicture',
        'handPicture',
    ];
    protected $primaryKey = 'gameId';

    public $incrementing = false;
    public $timestamps = false;
}
