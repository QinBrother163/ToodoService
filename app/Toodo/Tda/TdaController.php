<?php

namespace App\Toodo\Tda;

use App\Jobs\UpdateTdaRecord;
use App\Toodo\Gxgd\bizUser;
use App\Toodo\Gxgd\TdoGxgdAsset;
use App\Toodo\Hnyx\TdoHnyxAsset;
use App\Toodo\ToodoController;
use App\Toodo\UserService;
use Log;


class TdaController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];
        if ($method == '/toodo/tda/user') {
            return $this->user($request);
        }
        if ($method == '/toodo/tda/user2') {
            return $this->user2($request);
        }
        if ($method == '/toodo/tda/song') {
            return $this->song($request);
        }
        if ($method == '/toodo/tda/match') {
            return $this->match($request);
        }
        if ($method == '/toodo/tda/mvUrl') {
            return $this->mvUrl($request);
        }
        if ($method == '/toodo/tda/record') {
            return $this->record($request);
        }
        return $this->error(10004, '找不到指定method的方法', '', '');
    }

    protected function song($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->category)) {
                $subCode = 1;
                $subMsg = 'not set SongIn param category';
            }
            if ($subCode != 0) {
                return $this->error(11012, '请求歌曲信息出错', $subCode, $subMsg);
            }
        }
        $category = $bizIn->category;
        $songs = TdaSong::where([
            'category' => $category,
            'verify' => true,
        ])->get();

        return $this->biz($songs);
    }

    protected function match($request)
    {
        if ($request) {
        }
        $biz = [];

        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d H:i:s', strtotime('+1 sec'));
        $match = TdaMatch
            ::where('beginTime', '<', $now1)
            ->where('endTime', '>', $now)
            ->first();

        //创建比赛
        if (empty($match)) {
            $song = TdaSong::where([
                'category' => 0,
                'verify' => true,
            ])->orderByRaw("RAND()")->first();

            if (empty($song)) {
                return $this->biz($biz);
            }

            $week = 1 - date('w');
            if ($week > 0) {
                $week = -6;
            }
            $beginTime = date('Y-m-d', strtotime("+$week day"));
            $endTime = date('Y-m-d H:i:s', strtotime("+7 day -1 sec", strtotime($beginTime)));

            $match = new TdaMatch();
            $match->fill([
                'songId' => $song->songId,
                'records' => '[]',
                'beginTime' => $beginTime,
                'endTime' => $endTime,
                'last' => 0,
            ]);

            $lastNow = date('Y-m-d H:i:s', strtotime('-7 day'));
            $lastNow1 = date('Y-m-d H:i:s', strtotime('-7 day +1 sec'));
            $last = TdaMatch
                ::where('beginTime', '<', $lastNow1)
                ->where('endTime', '>', $lastNow)
                ->first();
            if ($last) {
                $match->last = $last->id;
            }

            $match->save();
        }

        if ($match) {
            $match->song = TdaSong::find($match->songId);
            array_push($biz, $match);
            if ($match->last > 0) {
                $last = TdaMatch::find($match->last);
                if ($last) {
                    $last->song = TdaSong::find($last->songId);
                    array_push($biz, $last);
                }
            }
        }
        return $this->biz($biz);
    }


    protected function mvUrl($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        if (config('app.debug')) {
            Log::info('-e mvUrl in:', (array)$bizIn);
        }
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->songId)) {
                $subCode = 1;
                $subMsg = 'not set MvUrlIn param songId';
            }
            if ($subCode != 0) {
                return $this->error(11013, '请求视频播放串出错', $subCode, $subMsg);
            }
        }

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }


        $songId = $bizIn->songId;
        $mvUrl = '';

        $retailId = $user->retailId;
        if ($retailId == config('retail.gxgd')) {
            /** @var UserService $userSrv */
            $userSrv = app(UserService::class);
            /** @var bizUser $gxUser */
            $gxUser = $userSrv->getBizUser($user);
            $asset = TdoGxgdAsset::find($songId);
            if ($asset) $mvUrl = $asset->getMvUrl($gxUser->userId, $gxUser->stbId);
        } else if ($retailId == config('retail.hnyx')) {
            $hnyxNet = env('HNYX_NET_ENABLE', true);
            if ($hnyxNet) {
                $asset = TdoHnyxAsset::find($songId);
                $tgt = empty($bizIn->tgt) ? '' : $bizIn->tgt;
                if ($asset) $mvUrl = $asset->getMvUrl($tgt);
            } else {
                $ts = strtotime('+1 sec');
                $mvUrl = "http://feiben.toodo.com.cn/mp4/$songId.mp4?ts=$ts";
            }
        } else {
            $ts = strtotime('+1 sec');
            //$mvUrl = "http://172.16.147.95/mp4/$songId.mp4?ts=$ts";
            $mvUrl = "http://feiben.toodo.com.cn/mp4/$songId.mp4?ts=$ts";
        }

        $bizOut = [
            'mvUrl' => $mvUrl,
        ];
        if (config('app.debug')) {
            Log::info('-e mvUrl out:', (array)$bizOut);
        }
        return $this->biz($bizOut);
    }

    protected function user($request)
    {
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $tdaUser = TdaUser::find($user->id);
        $isUpdate = false;
        if (empty($tdaUser)) {
            $tdaUser = new TdaUser();
            $tdaUser->fill([
                'userId' => $user->id,
                'records' => '[]',
                'calorie' => 0,
                'lastCalorie' => 0,
                'hisCalorie' => 0,
            ]);
            $tdaUser->matchs = '[]';
            $isUpdate = true;
        }

        $now = date("Y-m-d");
        $last = date("Y-m-d", strtotime($tdaUser->updated_at));
        $isLast = ($last != $now);
        if ($isLast) {
            $tdaUser->lastCalorie = $tdaUser->calorie;
            $tdaUser->calorie = 0;
            $isUpdate = true;
        }
        if ($isUpdate) {
            $tdaUser->save();
        }
        return $this->biz($tdaUser);
    }

    protected function user2($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->retailId)) {
                $subCode = 1;
                $subMsg = 'not set UserIn param retailId';
            }
            if ($subCode == 0 && !isset($bizIn->cardTV)) {
                $subCode = 2;
                $subMsg = 'not set UserIn param cardTV';
            }

            if ($subCode != 0) {
                return $this->error(11001, '账号输入参数缺失', $subCode, $subMsg);
            }
        }

        $retailId = $bizIn->retailId;
        $cardTV = $bizIn->cardTV;
        $regionCode = empty($bizIn->regionCode) ? $retailId : $bizIn->regionCode;

        //        /** @var EdoBlacklist $black */
        //        $black = EdoBlacklist::where(['retailId' => $retailId])->first();
        //        if ($black && $black->black) {
        //            \Log::info('-e blacklist contain ', ['retailId' => $retailId, 'cardTV' => $cardTV]);
        //            return $this->error(10005, '验证授权失败', 5, '发行渠道黑名单');
        //        }

        $token = $this->token;
        $result = $this->userSrv->getOrLogin($token, $retailId, $regionCode, $cardTV);

        $user = $result['user'];
        $token = $result['token'];
        $this->token = $token;


        //tdaUser............................................
        //===================================================
        $tdaUser = TdaUser::find($user->id);
        $isUpdate = false;
        if (empty($tdaUser)) {
            $tdaUser = new TdaUser();
            $tdaUser->fill([
                'userId' => $user->id,
                'records' => '[]',
                'calorie' => 0,
                'lastCalorie' => 0,
                'hisCalorie' => 0,
            ]);
            $tdaUser->matchs = '[]';
            $isUpdate = true;
        }

        $now = date("Y-m-d");
        $last = date("Y-m-d", strtotime($tdaUser->updated_at));
        $isLast = ($last != $now);
        if ($isLast) {
            $tdaUser->lastCalorie = $tdaUser->calorie;
            $tdaUser->calorie = 0;
            $isUpdate = true;
        }
        if ($isUpdate) {
            $tdaUser->save();
        }
        return $this->biz($tdaUser);
    }

    protected function record($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->songId)) {
                $subCode = 1;
                $subMsg = 'not set RecordIn param songId';
            }
            if ($subCode != 0) {
                $this->error(11012, '上传歌曲记录出错', $subCode, $subMsg);
            }
        }

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $songId = $bizIn->songId;
        $userId = $user->id;
        $score = empty($bizIn->score) ? 0 : $bizIn->score;
        $combo = empty($bizIn->combo) ? 0 : $bizIn->combo;
        $perfect = empty($bizIn->perfect) ? 0 : $bizIn->perfect;
        $eval = empty($bizIn->eval) ? 0 : $bizIn->eval;
        $calorie = empty($bizIn->calorie) ? 0 : $bizIn->calorie;

        /* @var $record TdaRecord */
        $record = new TdaRecord();
        $record->fill([
            'songId' => $songId,
            'userId' => $userId,
            'score' => $score,
            'combo' => $combo,
            'perfect' => $perfect,
            'eval' => $eval,
            'calorie' => $calorie,
        ]);
        $record->time = date('Y-m-d H:i:s');//not fillable
        $record->save();

        $job = new UpdateTdaRecord($record);
        dispatch($job);

        return $this->biz([
            'recordId' => $record->id,
        ]);
    }
}
