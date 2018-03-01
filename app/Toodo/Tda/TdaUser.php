<?php

namespace App\Toodo\Tda;

use Illuminate\Database\Eloquent\Model;

class TdaUser extends Model
{
    protected $primaryKey = 'userId';
    public $incrementing = false;

    protected $fillable = [
        'userId',
        'records',
        'calorie',
        'lastCalorie',
        'hisCalorie',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
