<?php

namespace App\Console\Commands;

use App\Toodo\Fast;
use App\Toodo\Gxgd\TdoGxgdAsset;
use App\Toodo\Gxgd\TdoGxgdAssetOp;
use App\Toodo\Tda\TdaSong;
use Illuminate\Console\Command;


class GxgdAssetApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gxgd:asset {func=sync} {args=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '广西媒资操作';
    //test       00031
    //fbkj       30020
    protected $provider = 'test';
    protected $providerId = '00031';

    public function __construct()
    {
        parent::__construct();
        $this->provider = env('GXGD_ADI_USER', 'test');
        $this->providerId = env('GXGD_ADI_ID', '00031');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $func = $this->argument('func');
        switch ($func) {
            case 'seed':
                $this->seed();
                break;
            case 'query':
                $this->query();
                break;
            case 'sync':
                $this->sync();
                break;
        }
        return true;
    }

    public function seed()
    {

    }

    public function query()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "query------------ \$args empty.";
            return;
        }

        if ($args == 'all') {
            $assets = TdoGxgdAsset::all();
            foreach ($assets as $asset) {
                $this->queryAsset($asset);
            }
        } else {
            $songId = intval($args);
            $asset = TdoGxgdAsset::find($songId);
            $this->queryAsset($asset);
        }
    }

    public function queryAsset(TdoGxgdAsset $asset)
    {
        $biz = [
            'nns_func' => 'check_auth_and_get_media_by_media',
            'nns_user_id' => '',
            'nns_version' => '1.0.0.GXGD.0.0TEST',
            'nns_video_id' => '',
            'nns_cp_video_id' => $asset->assetId,
            'nns_video_type' => 0,
            'nns_cp_id' => $this->provider,
            'nns_tag' => 26,
            'nns_cdn_flag' => 'rtsp_vod',
        ];

        $url = env('GXGD_ASSET_QUERY_URL', 'http://10.0.11.51/gxcatv20/AuthIndexStandard');
        list($code, $result) = Fast::curlGet($url, $biz);
        if ($code != 200) return;

        $xml = simplexml_load_string($result);
        if ($xml->attributes()->state != 0) return;

        $asset->videoId = $xml->video->attributes()->id;
        $asset->indexId = $xml->video->index->attributes()->id;
        $asset->mediaId = $xml->video->index->media->attributes()->id;
        $asset->url = $xml->video->index->media->attributes()->url;
        $asset->verify++;
        $asset->online++;
        $asset->save();

        //审核歌曲通过
        $this->verifySong($asset->songId);
        $others = $asset->otherSongs ? json_decode($asset->otherSongs) : [];
        foreach ($others as $other) {
            $this->verifySong($other);
        }
    }

    public function sync()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "sync------------ \$args empty.";
            return;
        }
        $opId = intval($args);
        $op = TdoGxgdAssetOp::find($opId);
        if (empty($op)) {
            echo "sync------------ \$op empty \$opId=$opId";
            return;
        }

        $assetId = $op->id;
        $asset = TdoGxgdAsset::where('assetId', $assetId)->first();
        if (empty($asset)) {
            echo "sync------------ \$asset empty \$assetId=$assetId";
            return;
        }

        switch ($op->opt_type) {
            case '0'://审核
                switch ($op->status) {
                    case '0';//通过审核
                        break;
                    case '1';//取消，待审核
                    case '3';//未通过审核
                        break;
                }
                break;
            case '1'://上下线
                switch ($op->status) {
                    case '0';//上线
                        $this->queryAsset($asset);
                        break;
                    case '1';//下线
                        break;
                }
                break;
            case '2'://注入（修改+新增）
                switch ($op->status) {
                    case '0';//新增修改成功
                        break;
                    case '1';//新增修改失败
                        //注入失败,取消二次确认
                        break;
                }
                break;
            case '3'://注入（删除）
                switch ($op->status) {
                    case '0';//删除成功
                        break;
                    case '1';//删除失败
                        break;
                }
                break;
        }
    }

    public function verifySong($songId)
    {
        $song = TdaSong::find($songId);
        if ($song) {
            $song->state++;
            $song->verify = true;
            $song->save();
        }
    }
}
