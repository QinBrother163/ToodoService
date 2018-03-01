<?php

namespace App\Toodo\Gxgd;

use App\Toodo\Fast;
use Illuminate\Database\Eloquent\Model;
use Log;


class TdoGxgdAsset extends Model
{
    protected $fillable = [
        'songId',
        'assetId',
        'otherSongs',
        'online',
        'verify',
        'videoId',
        'indexId',
        'mediaId',
        'originalId',
        'url',
    ];
    protected $primaryKey = 'songId';

    public $incrementing = false;


    public function getMvUrl($userId, $stbId)
    {
        $cpName = env('GXGD_ADI_USER', 'test');
        $srvUrl = env('GXGD_ASSET_QUERY_URL');

        $biz = [
            'nns_func' => 'check_auth_and_get_media_by_media',
            'nns_user_id' => $userId,
            'nns_device_id' => $stbId,
            'nns_version' => '1.0.0.GXGD.0.0TEST',
            'nns_video_id' => '',
            'nns_cp_video_id' => $this->assetId,
            'nns_video_type' => 0,
            'nns_cp_id' => $cpName,
            'nns_tag' => 26,
            'nns_cdn_flag' => 'rtsp_vod',
        ];
        if (config('app.debug')) {
            Log::info('-e      getMvUrl in:', (array)$biz);
        }
        list($code, $result) = Fast::curlGet($srvUrl, $biz);
        if (config('app.debug')) {
            Log::info('-e      getMvUrl out:' . $result);
        }
        if ($code != 200) return $this->url;

        $xml = simplexml_load_string($result);

        if (empty($xml)) return $this->url;

        if ($xml->attributes()->state != 0) return $this->url;

        //要转换字符串，不然返回的试 SimpleXMLElement
        $url = (string)$xml->video->index->media->attributes()->url;
        return $url;
    }
}
