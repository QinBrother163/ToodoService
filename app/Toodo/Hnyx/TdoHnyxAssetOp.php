<?php

namespace App\Toodo\Hnyx;

use Illuminate\Database\Eloquent\Model;

class TdoHnyxAssetOp extends Model
{
    protected $fillable = [
        'op',
        'songId',
        'assetId',
        'code',
        'msg',
        'status',
    ];
}
