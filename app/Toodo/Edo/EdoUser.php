<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;

class EdoUser extends Model
{
    protected $fillable = [
        'userId',
        'nickName',
        'passportId',
        'retailId',
        'items',
        'bizContent',
        'ownProps',
    ];
    protected $primaryKey = 'userId';

    public $incrementing = false;
}
