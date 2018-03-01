<?php

namespace App\Console\Commands;

use App\Toodo\Fast;
use App\Toodo\Hnyx\TdoHnyxAsset;
use App\Toodo\Hnyx\TdoHnyxAssetOp;
use App\Toodo\Tda\TdaSong;
use Illuminate\Console\Command;
use SimpleXMLElement;

class HnyxAssetApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hnyx:asset {func=sync} {args=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'hnyx:Command description';

    protected $provider;
    protected $providerId;

    protected $ingestUrl;
    protected $deleteUrl;
    protected $spgwUrl;

    protected $appId;
    protected $appSecret;
    protected $ftpUrl;

    protected $packages = [
        'package',
        'title',
        'movie',
        'poster'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->provider = env('HNYX_ADI_USER', 'SHUANGDONG');
        $this->providerId = env('HNYX_ADI_ID', '12358071');

        $this->ingestUrl = env('HNYX_ADI_INGEST_URL');
        $this->deleteUrl = env('HNYX_ADI_DELETE_URL');
        $this->spgwUrl = env('HNYX_SPGW_URL', 'http://192.168.6.81:8081/spgw');

        $this->appId = env('HNYX_APP_ID', '12000002');
        $this->appSecret = env('HNYX_APP_SECRET', '12000002');
        $this->ftpUrl = env('HNYX_FTP_URL', 'ftp://bsmpftp:bsmpftp@10.63.64.91/toodo');
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
            case 'adi':
                $this->adi();
                break;
            case 'ingest':
            case 'in':
                $this->ingest();
                break;
            case 'verify':
                $this->verify();
                break;
            case 'delete':
            case 'del':
                $this->delete();
                break;
        }
        return true;
    }

    //!======================================================= ===============
    protected function adi()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "adi------------ \$args empty.";
            return;
        }

        if ($args == 'all') {
            $songs = TdaSong::all();
            foreach ($songs as $song) {
                $this->adiSong($song);
            }
        } else {
            $songId = intval($args);
            $song = TdaSong::find($songId);
            $this->adiSong($song);
        }
    }

    public function adiSong(TdaSong $song)
    {
        $songId = intval(substr($song->mvUrl, 0, 5));
        $assetId = '';
        if ($songId == $song->songId) {
            $string = '<?xml version="1.0" encoding="UTF-8"?><ADI></ADI>';
            $xml = simplexml_load_string($string);
            $assetId = $this->createPackage($xml, $song);
            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom->formatOutput = true;
            $dom->save("ADI/hnyx/$assetId.xml");
        }
        $this->assetSeed($songId, $song, $assetId);
    }

    protected function prefix()
    {
        return 'TD' . date('Ymd') . '0100110';
    }

    protected function createPackage(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '00';

        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Provider' => $this->provider,
            'Product' => 'OTT',
            'Asset_Name' => $song->title,
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Description' => 'asset package',
            'Creation_Date' => date('Y-m-d'),
            'Provider_ID' => $this->providerId,
            'Asset_ID' => $assetId,
            'Asset_Class' => $this->packages[0],
        ]);
        $this->addAppData($meta, [
            'Provider_Content_Tier' => 'FILM.1',
            'Metadata_Spec_Version' => 'AVITMOD1.1',
        ]);

        $asset = $xml->addChild('Asset');
        $this->createTitle($asset, $song);

        $movie = $asset->addChild('Asset');
        $this->createMovie($movie, $song);

        return $assetId;
    }

    protected function createTitle(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '01';
        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Provider' => $this->provider,
            'Product' => 'OTT',
            'Asset_Name' => $song->title,
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Description' => 'title metadata',
            'Creation_Date' => date('Y-m-d H:i:s'),
            'Provider_ID' => $this->providerId,
            'Asset_ID' => $assetId,
            'Asset_Class' => $this->packages[1],
        ]);
        $this->addAppData($meta, [
            'Title_Sort_Name' => $song->title,
            'Title_Brief' => $song->title,
            'Title' => $song->title,
            'Type' => 'title',
            'ISAN' => '',
            'Episode_Name' => '',
            'Episode_ID' => '',
            'Summary_Long' => '',
            'Summary_Medium' => '',
            'Summary_Short' => '',
            'Rating' => '',
            'Run_Time' => '00:04:28',
            'Display_Run_Time' => '00:04',
            'Year' => '2017',
            'Country_of_Origin' => 'CH',
            'from_API' => '0',
            'Actors' => '',
            'Actors_Display' => '',
            'Writer_Display' => '',
            'Director' => '',
            'Producer' => '',
            'Studio' => '',
            'Category' => '',
            'Genre' => '',
            'Show_Type' => 'Game',
            'Season_Premiere' => 'N',
            'Season_Finale' => 'N',
            'Licensing_Window_Start' => '2002-02-01 00:00:00',
            'Licensing_Window_End' => '2022-03-31 23:59:59',
            'Preview_Period' => '',
            'Suggested_Price' => '',
            'Studio_Name' => 'Shuangdong',
            'Studio_Code' => 'SD',
            'Subscriber_View_Limit' => '2002-02-01,2002-02-28,5',
            'Subscriber_View_Limi' => '2022-03-01,2002-03-31,5',
        ]);
    }

    protected function createMovie(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '10';
        $assetName = $song->title;

        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Provider' => $this->provider,
            'Product' => 'OTT',
            'Asset_Name' => $assetName,
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Description' => 'movie',
            'Creation_Date' => date('Y-m-d'),
            'Provider_ID' => $this->providerId,
            'Asset_ID' => $assetId,
            'Asset_Class' => $this->packages[2],
            'Bit_Rate' => '',
        ]);
        $this->addAppData($meta, [
            'Encryption' => 'N',
            'Type' => 'movie',
            'Service' => 'OTT',
            'Audio_Type' => 'Dolby Digital',
            'Screen_Format' => 'HD',
            'Languages' => 'zh',
            'Subtitle_Languages' => 'zh',
            'Dubbed_Languages' => 'zh',
            'Copy_Protection' => 'N',
            'Content_FileSize' => '',
            'Content_CheckSum' => '',
        ]);

        $content = $xml->addChild('Content');
        $content->addAttribute('Value', "/$song->songId.ts");
    }

    /**
     * @param $xml SimpleXMLElement
     * @param $data array
     */
    protected function addAMSAttributes($xml, $data)
    {
        $ams = $xml->addChild('AMS');
        foreach ($data as $key => $val) {
            $ams->addAttribute($key, $val);
        }
    }

    /**
     * @param $xml SimpleXMLElement
     * @param $data array
     */
    protected function addAppData($xml, $data)
    {
        foreach ($data as $key => $val) {
            $node = $xml->addChild('App_Data');
            $node->addAttribute('App', 'MOD');
            $node->addAttribute('Name', $key);
            $node->addAttribute('Value', $val);
        }
    }

    /**
     * @param $songId string
     * @param $song TdaSong
     * @param $assetId string
     */
    protected function assetSeed($songId, $song, $assetId)
    {
        /** @var TdoHnyxAsset $asset */
        $asset = TdoHnyxAsset::find($songId);
        if (empty($asset)) {
            $asset = new TdoHnyxAsset();
            $asset->fill([
                'songId' => $songId,
                'assetId' => $assetId,
                'otherSongs' => '[]',
                'online' => 0,
                'verify' => 0,
                'videoId' => '',
                'url' => '',
            ]);
        }

        if ($songId == $song->songId) {
            $asset->fill([
                'assetId' => $assetId,
                'online' => 1,
                'verify' => 0,
            ]);
        } else {
            $others = $asset->otherSongs ? json_decode($asset->otherSongs) : [];
            $others = collect($others);
            if (!$others->contains($song->songId)) {
                $others->push($song->songId);
                $asset->otherSongs = $others->toJson();
            }
        }
        $asset->save();

        //$song->state = 0;
        //$song->verify = false;
        //$song->save();
    }

    //!======================================================= ===============
    protected function ingest()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "ingest------------ \$args empty.";
            return false;
        }

        $songId = intval($args);
        $op = TdoHnyxAssetOp::where(['op' => 1, 'songId' => $songId, 'status' => -1])->first();
        if ($op) {
            return false;
        }

        /** @var TdoHnyxAsset $asset */
        $asset = TdoHnyxAsset::find($songId);
        if (empty($asset)) {
            return false;
        }

        /** @var TdoHnyxAssetOp $op */
        $op = new TdoHnyxAssetOp();
        $op->fill([
            'op' => 1,
            'songId' => $asset->songId,
            'assetId' => $asset->assetId,
            'code' => '',
            'msg' => '',
            'status' => -1,
        ]);
        $op->save();

        $appId = $this->appId;
        $appSecret = $this->appSecret;
        $ts = Fast::ms();
        $msg = $appId . '_' . $appSecret . '_' . $ts;
        $md5 = md5($msg);

        $string = '<?xml version="1.0" encoding="UTF-8"?><Root></Root>';
        $xml = simplexml_load_string($string);
        $xml->addAttribute('cseq', $ts);

        $adi = $xml->addChild('ADIIngest');
        $adi->addAttribute('csi', $appId);
        $adi->addAttribute('ftp', "$this->ftpUrl/$asset->assetId.xml");
        $adi->addAttribute('stamp', $ts);
        $adi->addAttribute('token', strtoupper($md5));
        $respUrl = env('HNYX_ADI_RESP_URL', 'http://10.63.70.181/tdsrv/api/toodo/hnyx/onIngest');
        $adi->addAttribute('responseUrl', "$respUrl/$asset->songId/$op->id");

        $msg = $xml->asXML();
        list($status, $result) = Fast::curlPostXml($this->ingestUrl, $msg);
        echo "-e ingest in: $msg";
        echo "-e ingest out: $status $result\n";

        if ($status == 200) {
            $xml = simplexml_load_string($result);

            /** @var SimpleXMLElement $resp */
            $resp = $xml->ADIIngestRes;
            $code = $resp->attributes()->responseCode;
            $msg = $resp->attributes()->message;

            if ($code == '200') {
                $ids = explode(':', $msg);
                //$op->assetId = $ids[0];
                //$asset->assetId = $ids[0];
                $asset->videoId = $ids[1];
                $asset->save();
            } else {
                $op->status = 2;
            }

            $op->code = $code;
            $op->msg = $msg;
        } else {
            $op->status = 3;
        }
        $op->save();

        return true;
    }

    protected function delete()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "delete------------ \$args empty.";
            return false;
        }

        $arr = explode(',', $args);
        if (count($arr) == 0) {
            return false;
        }

        $deleteAssets = [];
        foreach ($arr as $arg) {
            $songId = intval($arg);
            /** @var TdoHnyxAsset $asset */
            $asset = TdoHnyxAsset::find($songId);
            if (empty($asset) || $asset->verify == 0) {
                continue;
            }
            array_push($deleteAssets, $asset->videoId);
        }

        $appId = $this->appId;
        $appSecret = $this->appSecret;
        $ts = Fast::ms();
        $msg = $appId . '_' . $appSecret . '_' . $ts;
        $md5 = md5($msg);

        $string = '<?xml version="1.0" encoding="UTF-8"?><Root></Root>';
        $xml = simplexml_load_string($string);
        $xml->addAttribute('cseq', $ts);

        $adi = $xml->addChild('DelAssets');
        $adi->addAttribute('csi', $appId);
        $adi->addAttribute('stamp', $ts);
        $adi->addAttribute('token', strtoupper($md5));
        foreach ($deleteAssets as $assetId) {
            $ass = $adi->addChild('Asset');
            $ass->addAttribute('assetId', $assetId);
        }

        $msg = $xml->asXML();
        list($status, $result) = Fast::curlPostXml($this->deleteUrl, $msg);
        echo "-e delete in: $msg";
        echo "-e delete out: $status $result\n";

        $op = new TdoHnyxAssetOp();
        $op->fill([
            'op' => 0,
            'songId' => 0,
            'assetId' => $args,
            'status' => $status,
        ]);
        if ($status == 200) {
            $xml = simplexml_load_string($result);

            if (isset($xml->DelResError)) {
                /** @var SimpleXMLElement $resp */
                $resp = $xml->DelResError;
                $code = $resp->attributes()->responseCode;
                $msg = $resp->attributes()->message;

                $op->code = $code;
                $op->msg = $msg;
            }
            if (isset($xml->DelRes)) {
                /** @var SimpleXMLElement[] $xmls */
                $xmls = $xml->DelRes->Success->children();
                foreach ($xmls as $child) {
                    $vid = $child->attributes()->assetId;
                    $asset = TdoHnyxAsset::whereVideoId($vid);
                    if ($asset) $this->verifyAsset($asset, false);
                }

                $op->code = 0;
                $op->msg = '';
            }
        }
        $op->save();

        return true;
    }

    //!======================================================= ===============
    protected function verify()
    {
        $args = $this->argument('args');
        if ($args == 'null') {
            echo "query------------ \$args empty.";
            return;
        }

        $songId = intval($args);
        $asset = TdoHnyxAsset::find($songId);
        $this->verifyAsset($asset, true);
    }

    /**
     * @param TdoHnyxAsset $asset
     * @param $verify boolean
     */
    protected function verifyAsset(TdoHnyxAsset $asset, $verify)
    {
        $asset->online = $verify ? 1 : 0;
        $asset->verify = $verify ? 1 : 0;
        $asset->save();

        //审核歌曲通过
        $this->verifySong($asset->songId, $verify);
        $others = $asset->otherSongs ? json_decode($asset->otherSongs) : [];
        foreach ($others as $other) {
            $this->verifySong($other, $verify);
        }
    }

    protected function verifySong($songId, $verify)
    {
        $song = TdaSong::find($songId);
        if ($song) {
            $song->state = $verify ? $song->state + 1 : 0;
            $song->verify = $verify;
            $song->save();
        }
    }

    //!======================================================= ===============
    public function queryAsset(TdoHnyxAsset $asset, $tgt)
    {
        $appId = $this->appId;
        $appSecret = $this->appSecret;
        $ts = Fast::ms();
        $msg = $appId . '_' . $appSecret . '_' . $ts;
        $md5 = md5($msg);

        $biz = [
            'attribute' => 'json_ott_play',
            'cseq' => $ts,
            'csi' => $appId,
            'stamp' => $ts,
            'token' => strtoupper($md5),
            'assetId' => $asset->videoId,
            'productId' => 'PT20131226172125330',
            'tgt' => $tgt,
            'startPoint' => '',
            'format' => '',
            'backUrl' => '',
            'clientIp' => '',
            'returnUrl' => '',
        ];

        $url = $this->spgwUrl;
        list($code, $result) = Fast::curlGetJson($url, $biz);
        \Log::debug("-e queryAsset songId:$asset->songId $code $result");
        if ($code != 200) return false;

        $json = json_decode($result);
        $data = $json->DataArea;
        if (empty($data->url)) return false;

        $asset->url = $data->url;
        //$asset->save();
        return true;
    }
}
