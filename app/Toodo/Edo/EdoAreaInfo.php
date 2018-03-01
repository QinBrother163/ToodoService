<?php

namespace App\Toodo\Edo;

use Illuminate\Database\Eloquent\Model;


class EdoAreaInfo extends Model
{
    protected $primaryKey = 'area';
    protected $fillable = [
        'area',
        'name',
        'trial',
        'freeBegin',
        'freeEnd',
        'cntId',
        'ownId',
    ];
    public $timestamps = false;

    public function isFree($now)
    {
        return $this->freeBegin <= $now && $now < $this->freeEnd;
    }
}
