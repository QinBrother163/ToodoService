<?php

namespace App\Toodo\Gxgd;


use App\Http\Controllers\Controller;
use App\Toodo\Fast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class AssetController extends Controller
{
    //protected $srvUrl = 'http://cs.interface.hifuntv.com/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php';
    protected $srvUrl = 'http://10.0.11.51/nn_cms/nn_cms_manager_v2/admin.php';
    protected $cpId;

    public function __construct()
    {
        $this->cpId = env('GXGD_ADI_USER', 'test');
    }

    public function destroy($asset)
    {
        /**
         * @in
         * func              是 String delete_asset
         * assets_video_type 否 String 0为点播 1为直播 默认为0
         * id                是 String 主媒资ID
         * cp_id             是 String CPID
         * assets_id_type    0 int 1:媒资id（CMS平台原始Id ） CP/SP方对接请使用该值
         *                         0:cms平台注入id
         */
        /**
         * @out <result  ret="7"  reason="无此媒资"></result>
         * ret 0 成功
         *     1 必要参数不全
         *     2 无此影片
         *     9服务器内部错误
         * reason 失败原因描述
         */
        list($code, $result) = Fast::curlPostJson($this->srvUrl, [
            'func' => 'delete_asset',
            'id' => $asset->id,
            'assets_id_type' => 1,
            'assets_video_type' => 0,
            'cp_id' => $this->cpId,
        ]);

        $xml = simplexml_load_string($result);
        foreach ($xml->attributes() AS $a => $b) {

        }
        /**
         * @in
         * func              是 String delete_video_clip
         * assets_video_type 否 String 主媒资类型 0为点播 1为直播 默认为0
         * id                是 String 主媒资分片ID
         * cp_id             是 String CPID
         * isintact          是 String 1 代表整片；2 短片；3预告片
         * assets_id_type    0 int 1:媒资id（CMS平台原始Id ） CP/SP方对接请使用该值
         *                         0:cms平台注入id
         */
        /**
         * @out <result  ret="7"  reason="无此媒资"></result>
         * ret 0 成功
         *     1 必要参数不全
         *     2 无此影片
         *     9服务器内部错误
         * reason 失败原因描述
         */
        /**
         * @in
         * func              是 String delete_video_file
         * assets_video_type 否 String 0为点播 1为直播 默认为0
         * id                是 String 分片片源ID
         * cp_id             是 String CPID
         * isintact          是 String 1 代表整片；2 短片；3预告片
         * assets_id_type    0 int 1:媒资id（CMS平台原始Id ） CP/SP方对接请使用该值
         *                         0:cms平台注入id
         */
        /**
         * @out <result  ret="7"  reason="无此媒资"></result>
         * ret 0 成功
         *     1 必要参数不全
         *     2 无此影片
         *     9服务器内部错误
         * reason 失败原因描述
         */
        if ($code == 200) {

        }
        return null;
    }

    public function online(Request $request)
    {
        /**
         * @in
         * func unline_assets 方法名称
         * assets_id   媒资id
         * assets_unline   状态：
         *                   0：上线
         *                   1：下线
         * cp_id   cp id
         * assets_id_type 0 1:媒资id（CMS平台原始Id ） CP/SP方对接请使用该值
         *                  0:cms平台注入id
         */
        /**
         * @out <result  ret="7"  reason="无此媒资"></result>
         * ret 0:成功
         *     其他值：失败
         * reason 失败原因
         */
        list($code, $result) = Fast::curlPostJson($this->srvUrl, [
            'func' => 'unline_assets',
            'assets_id' => 0,
            'assets_unline' => 0,
            'cp_id' => $this->cpId,
            'assets_id_type' => 0,
        ]);
        if ($code == 200) {
            $xml = simplexml_load_string($result);
            $ret = (string)$xml->attributes()->ret;
            $reason = (string)$xml->attributes()->reason;
        }
    }

    public function query(Request $request)
    {
        /**
         * @in
         * func        否 string select_asset  
         * import_id   否 string   注入id  多个值用逗号分隔
         * select_type 否 string   查询类型 多个值用逗号分隔 "check,online"
         *                         check: 审核 已审核/未审核
         *                         online:上线查询 已上线/未上线
         *                         lock:  锁定 已锁定/未锁定
         *                         state: 媒资状态 缺分集/缺片源/无分集/正常
         *                         import_vod:主媒资注入状态查询
         *                         import_index:分集注入状态查询
         *                         import_media:片源注入查询
         * cp_id       是 string   cp id
         */
        /**
         *  {  "ret": 0,  "reason": "success",  "data": {    "150898": { // 注入id
         * "check": "1",// 1 通过 ; 0 未通过
         * "online": 1, //1 上线 0 未上线
         * "lock": "1", //1 未锁定 0 锁定
         * "state": 0   //0正常；1缺分集；2缺片源
         * "import_vod": "主媒资注入查询 0成功，1失败"
         * "import_index":"分集注入查询 0成功，1失败"
         * "import_media":"片源注入查询 0成功，1失败"     },    "157585": {      "check": "1",      "online": 1,      "lock": "1",      "state": 0    },    "164059": {      "check": "0",      "online": 0,      "lock": "",      "state": 1    }  } }
         * @out
         * check  审核： 1通过审核；0 未通过审核
         * online 上下线状态：1上线 ；0 未上线
         * lock  媒资锁定状态：1 未锁定； 0 锁定
         * state 媒资分集片源状态：0正常；1缺分集；2缺片源
         * import_vod   主媒资注入查询 0成功，1失败
         * import_index 主媒资注入查询 0成功，1失败
         * import_media 主媒资注入查询 0成功，1失败
         */
        return Fast::curlGet($this->srvUrl, [
            'func' => 'select_asset',
            'import_id' => 'fbyx2017062301001101000100000000',
            'select_type' => 'check,online,state,import_vod',
            'cp_id' => '00031'
        ]);
    }

    public function sync(Request $request)
    {
        /**
         * @in
         * verify_result 否 String [ { "msg_id": "578eefd32d83bc48f0704e8b91e34d62", "type": "vod", "opt_type": "1", "id": "5c93c893fd3893a935c848d1a40f2634", "cp_id": "mgtv", "status": "1", "summary": "", "nns_id": "58e749891f626a43231dc1407d474832", "is_sync": "1", "original_id": "58e749891f626a43231dc1407d474832" }, { "msg_id": "578eefd32d83bc48f0704e8b91e34d62", "type": "vod", "opt_type": "1", "id": "5c93c893fd3893a935c848d1a40f2634", "cp_id": "mgtv", "status": "1", "summary": "", "nns_id": "58e749891f626a43231dc1407d474832", "is_sync": "1", "original_id": "58e749891f626a43231dc1407d474832" } ]
         * 同步的数据，JSON格式字符串
         *  
         * 请求字段说明：
         *  
         * 参数key 说明
         * msg_id 消息id
         * type 媒资类型：
         *      vod:主媒资
         *      index:分集
         *      media:片源
         * opt_type 0表示审核
         *          1表示上下线
         *          2表示注入（修改+新增）结果
         *          3表示注入（删除）结果
         * id  媒资注入ID
         * cp_id cp id
         * status 结果
         *        opt_type值 说明
         *        0 0：通过审核
         *          1：取消审核（待审核）
         *          3：未通过审核
         *        1 0：上线
         *          1：下线
         *        2 0：注入（修改+新增）成功
         *          1：注入（修改+新增）失败
         *        3 0：注入（ ）成功 删除
         *          1：注入（ ）失败 删除
         * create_time 操作时间 2017-01-01 12:00:0
         * summary  简介
         * is_sync  是否真正同步下线，0表示同步下线操作，1表示不同步下线操作
         * original_id 原始id
         */
        /**
         * @out
         * sync_result 否 [ { "msg_id": "578eefd32d83bc48f0704e8b91e34d62", "status": "0", "sync_time": "2017-05-10 00:00:00", "summary": "success" }, { "msg_id": "578eefd32d83bc48f0704e8b91e34d62", "status": "1", "sync_time": "2017-05-10 00:00:00", "summary": "" } ]
         * 返回JSON格式字符串
         *
         * 字段        说明
         * msg_id     消息id
         *            cms推送给sp的消息id, 上表中（msg_id字段）
         * status     0：处理成功
         *            1：处理失败
         * sync_time 同步处理时间，格式2017-05-10 00:00:00
         * summary   说明，失败说明
         */
        $verify_result = $request->input('verify_result');
        /** @var TdoGxgdAssetOp[] $ops */
        $ops = json_decode($verify_result);
        $results = [];

        foreach ($ops as $assetOp) {
            $op = new TdoGxgdAssetOp();
            $op->fill((array)$assetOp);
            $op->save();

            Artisan::queue('gxgd:asset', ['func' => 'sync', 'args' => $op->opId]);

            $result = [
                "msg_id" => $op->msg_id,
                "status" => $op->code,
                "sync_time" => $op->sync_time,
                'summary' => $op->msg
            ];

            array_push($results, $result);
        }
        return ['sync_result' => $results];
    }
}
