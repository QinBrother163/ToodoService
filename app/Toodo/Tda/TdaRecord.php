<?php

namespace App\Toodo\Tda;

use Illuminate\Database\Eloquent\Model;

class TdaRecord extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'songId',
        'userId',
        'score',
        'combo',
        'perfect',
        'eval',
        'calorie',
    ];
}
