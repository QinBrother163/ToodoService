<?php

namespace App\Console\Commands;

use App\Toodo\Gxgd\TdoGxgdAsset;
use App\Toodo\Tda\TdaSong;
use Illuminate\Console\Command;
use SimpleXMLElement;

class GxgdSongsADI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gxgd:adi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate gxgd adi xml';
    protected $packages = [
        'package',
        'title',
        'movie',
        'poster'
    ];
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
        $songs = TdaSong::all();
        $string = '<?xml version="1.0" encoding="UTF-8"?><ADI></ADI>';
        foreach ($songs as $song) {
            $songId = intval(substr($song->mvUrl, 0, 5));
            $assetId = '';
            if ($songId == $song->songId) {
                $xml = simplexml_load_string($string);
                $assetId = $this->createPackage($xml, $song);
                $dom = dom_import_simplexml($xml)->ownerDocument;
                $dom->formatOutput = true;
                $dom->save("ADI/gxgd/$assetId.xml");
            }
            $this->assetSeed($songId, $song, $assetId);
        }
        return true;
    }

    protected function prefix()
    {
        //[4位 前缀]fbyx [8位 时间]date('Ymd') [6位 项目]010011 [6位 资源包] [8位 备注]00000000
        return $this->provider . date('Ymd') . '0100110';
        //return $this->provider . '20170726' . '0100110';
    }

    protected function createPackage(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '00000000';

        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Asset_Class' => $this->packages[0],
            'Product' => 'VOD',
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Verb' => '',
            'Asset_ID' => $assetId,
            'Asset_Name' => $song->title,
            'Creation_Date' => date('Y-m-d'),
            'Description' => '',
            'Provider' => $this->provider,
            'Provider_ID' => $this->providerId,
        ]);
        $this->addAppData($meta, [
            'Metadata_Spec_Version' => 'CableLabsVOD1.1',
            'Classify' => '',
            'Genre' => '儿童,都市',
            'Keyword' => $song->singer,
            'Year' => '2017',
            'Actors' => $song->singer,
            'Director' => '',
            'Summary_Long' => '体感热舞舞曲',
            'Country_Of_Origin' => '大陆',
            'Language' => '',
            'Licensing_Window_Start' => '2017-01-01',
            'Licensing_Window_End' => '2020-08-31',
            'TotalNumber' => '1',
            'VodResourceType' => 'pc',
        ]);

        $asset = $xml->addChild('Asset');
        $this->createTitle($asset, $song);

        $movie = $asset->addChild('Asset');
        $this->createMovie($movie, $song);

//        $poster0 = $asset->addChild('Asset');
//        $this->createPoster($poster0, $song, 0);
//        $poster1 = $asset->addChild('Asset');
//        $this->createPoster($poster1, $song, 1);

        return $assetId;
    }

    protected function createTitle(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '00000000';
        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Asset_Class' => $this->packages[1],
            'Product' => 'VOD',
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Verb' => '',
            'Asset_ID' => $assetId,
            'Asset_Name' => $song->title,
            'Creation_Date' => date('Y-m-d'),
            'Description' => '',
            'Provider' => $this->provider,
            'Provider_ID' => $this->providerId,
        ]);
        $this->addAppData($meta, [
            'Title' => $song->title,
            'Title_Sec' => '',
            'Title_Brief' => '',
            'AssetType' => '',
            'Run_Time' => '',
            'Show_Type' => '音乐',
            'Genre' => '儿童,都市',
            'Keyword' => $song->singer,
            'Season' => '1',
            'TotalNumber' => '1',
            'Chapter' => '1',
            'Summary_Long' => '体感热舞舞曲',
            'Summary_Long_Sec' => '',
            'Language' => '',
            'Subtitle_Language' => '',
            'Director' => '',
            'Director_Sec' => '',
            'Actors' => $song->singer,
            'Actors_Sec' => '',
            'Writers' => '',
            'Writers_Sec' => '',
            'Provider' => $this->provider,
            'Provider_Sec' => '',
            'Play_Date' => '',
            'Premiere_Date' => '',
            'Year' => '2017',
            'Country_Of_Origin' => '',
            'Country_Of_Origin_Sec' => '',
            'Column' => '',
            'Audience' => '',
            'Classify' => '',
            'Licensing_Window_Start' => '2017-01-01',
            'Licensing_Window_End' => '2020-08-31',
            'Rate' => '',
            'Suggested_Price' => '',
            'HighLight' => '',
            'Awards' => '',
            'Screen_Writer' => '',
        ]);
    }

    protected function createMovie(SimpleXMLElement $xml, TdaSong $song)
    {
        $assetId = $this->prefix() . $song->songId . '00000010';
        $assetName = $song->title;

        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Asset_Class' => $this->packages[2],
            'Product' => 'VOD',
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Verb' => '',
            'Asset_ID' => $assetId,
            'Asset_Name' => $assetName,
            'Creation_Date' => date('Y-m-d'),
            'Description' => '',
            'Provider' => $this->provider,
            'Provider_ID' => $this->providerId,
        ]);
        $this->addAppData($meta, [
            'Bit_Rate' => '',
            'Content_FileSize' => '',
            'Run_Time' => '',
            'FileFormat' => 'MPEG-4',
            'CodeFormat' => 'MPEG-4',
            'Format' => '标清',
            'HD_Format' => '',
            'SD_Format' => '',
            'Strean_Size' => '',
            'Asset_Tag' => '',
            'Asset_Profile' => '',
        ]);

        $content = $xml->addChild('Content');
        $content->addAttribute('Value', $song->songId . '.mp4');
    }

    protected function createPoster(SimpleXMLElement $xml, TdaSong $song, $style)
    {
        $assetId = $this->prefix() . $song->songId . '0000002' . $style;
        $assetName = $song->title . ($style == 0 ? ' 横图海报' : ' 竖图海报');

        $meta = $xml->addChild('Metadata');
        $this->addAMSAttributes($meta, [
            'Asset_Class' => $this->packages[3],
            'Product' => 'VOD',
            'Version_Major' => '1',
            'Version_Minor' => '0',
            'Verb' => '',
            'Asset_ID' => $assetId,
            'Asset_Name' => $assetName,
            'Creation_Date' => date('Y-m-d'),
            'Description' => '',
            'Provider' => $this->provider,
            'Provider_ID' => $this->providerId,
        ]);
        $this->addAppData($meta, [
            'Ui_Style' => $style,
            'Title' => $assetName,
            'Summary' => '',
        ]);

        $content = $xml->addChild('Content');
        $content->addAttribute('Value', $song->songId . "_" . $style . ".jpg");
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
        /** @var TdoGxgdAsset $asset */
        $asset = TdoGxgdAsset::find($songId);
        if (empty($asset)) {
            $asset = new TdoGxgdAsset();
            $asset->fill([
                'songId' => $songId,
                'assetId' => $assetId,
                'otherSongs' => '[]',
                'online' => 0,
                'verify' => 0,
                'videoId' => '',
                'indexId' => '',
                'mediaId' => '',
                'originalId' => '',
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

        $song->state = 0;
        $song->verify = false;
        $song->save();
    }
}
