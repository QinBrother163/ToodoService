<?php

namespace App\Toodo\Hnyx;

use App\Console\Commands\HnyxAssetApi;
use Illuminate\Database\Eloquent\Model;

class TdoHnyxAsset extends Model
{
    protected $fillable = [
        'songId',
        'assetId',
        'otherSongs',
        'online',
        'verify',
        'videoId',
        'url',
    ];
    protected $primaryKey = 'songId';

    public $incrementing = false;


    public function getMvUrl($tgt)
    {
        /** @var HnyxAssetApi $api */
        $api = app(HnyxAssetApi::class);
        $api->queryAsset($this, $tgt);
        return $this->url;
    }
}
