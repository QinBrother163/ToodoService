<?php

namespace App\Toodo\Gxgd;

use Illuminate\Database\Eloquent\Model;


class TdoGxgdAssetOp extends Model
{
    public $timestamps = false;
    protected $table = 'tdo_gxgd_asset_ops';
    protected $primaryKey = 'opId';
    protected $fillable = [
        'id',
        'msg_id',
        'type',
        'opt_type',
        'cp_id',
        'status',
        'create_time',
        'summary',
        'nns_id',
        'is_sync',
        'original_id',
        'sync_time',
        'code',
        'msg'
    ];
}
