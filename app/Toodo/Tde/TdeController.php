<?php

namespace App\Toodo\Tde;

use App\Toodo\ToodoController;
use App\Toodo\UserService;
use App\User;
use Request;
use QrCode;
use DB;


class TdeController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];
        if ($method == '/toodo/tde/page') {
            return $this->page($request);
        }
        if ($method == '/toodo/tde/user') {
            return $this->user($request);
        }
        if ($method == '/toodo/tde/lock') {
            return $this->lock($request);
        }if($method == '/toodo/tde/winnerInfo'){
           return $this->winnerInfo($request);
        }if($method == '/toodo/tde/userWinner'){
            return $this->userWinner($request);
        }if($method == '/toodo/tde/turntableState') {
            return $this->TurntableState($request);
        }if($method == '/toodo/tde/turntablePro') {
            return $this->turntablePro($request);
        }if($method=='/toodo/tde/turntablePrizeNum'){
            return $this->turntablePrizeNum($request);
        }if($method=='/toodo/tde/addCoin'){
            return $this->addCoin($request);
        }if($method=='/toodo/tde/addWinner'){
            return $this->addWinner($request);
        }if($method=='/toodo/tde/getPrize'){
        return $this->getPrize($request);
        }if($method=='/toodo/tde/addState'){
            return $this->queryDddNumber();
        }if($method=='/toodo/tde/updataFreeState'){
            return $this->queryUser();
        }

        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

    protected  function addWinner($request){
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $prizeID=$bizIn->prizeID;
        $state=$bizIn->state;
        $user = $this->user;
        $prizeName = null;

        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        if($state==1 ||$state==2){
            $this->DelPrizeNum ($prizeID);
        }

            switch ($prizeID) {
                case 1:
                    $prizeName = "数码平板电脑";
                    break;
                case 2:
                    $prizeName = "高清摄像头";
                    break;
                case 3:
                    $prizeName = "游戏币50F";
                    break;
                case 4:
                    $prizeName = "体感热舞跳舞毯";
                    break;
                case 5:
                    $prizeName = "数码摄像机";
                    break;
                default:
                    $prizeName = "经典游戏掌机";
                    break;
            }
            $log = new TurntableWinning();
            $date=date('Y-m-d H:i:s');
            $log->fill([
                'userID' => $user->id,
                'userName' => $user->name,
                'prizeID' => $prizeID,
                'prizeName' => $prizeName,
                'winningDate' => $date,
                'state' => $state,
            ]);
            $log->save();

            $getId = TurntableWinning::where("winningDate",$date)->get();
            $getIdS = null;
            foreach ($getId as $val) {
                $getIdS = $val->id;
            }
            return $this->biz($getIdS);

    }

    function delPrizeNum ($prizeID){
        TurntablePrize::where('prizeID', $prizeID)->decrement('prizeNum');
    }

    function addPrizeNum ($prizeID){
        TurntablePrize::where('prizeID', $prizeID)->increment('prizeNum');
    }

    function queryDelUser()
    {
        $user=$this->user;
        TurntableState::where('userID', $user->id)->where('freeStatus', 1)->update(['freeStatus' => 0,'freeDate' => date('Y-m-d H:i:s')]);
    }

    function queryUser()
    {
        $user=$this->user;
        TurntableState::where('userID', $user->id)->where('freeStatus', 0)->update(['freeStatus' => 1,'freeDate' => date('Y-m-d H:i:s')]);
    }

    function queryDddNumber()
    {
        $user=$this->user;

        TurntableState::where('userID',$user->id)->increment('addNumber');
        TurntableState::where('userID', $user->id)->update(['addNumberDate' => date('Y-m-d H:i:s')]);
    }

    function queryDelNumber()
    {
            $user=$this->user;

        TurntableState::where('userID',$user->id)->decrement('addNumber');
        TurntableState::where('userID', $user->id)->update(['addNumberDate' => date('Y-m-d H:i:s')]);
    }

    function getPrize ($request){

        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $winningID=$bizIn->id;
        TurntableWinning::where('id', $winningID)->update(['state' => 2]);
        \Log::info("1111");
    }

    protected function addCoin($request){
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $addCoins=$bizIn->addNun;
        $user = $this->user;
        if ($addCoins > 0) {
            $tdeUser = $this->search($user);
            $coins = $tdeUser->coins;

            $tdeUser->coins += $addCoins;
            $tdeUser->hisCoins += $addCoins;
            $tdeUser->save();

            $coinsLog = new TdeCoinsLog();
            $coinsLog->fill([
                'userId' => $tdeUser->userId,
                'coins' => $coins,
                'add' => $addCoins,
                'time' => date('Y-m-d H:i:s'),
                'gameId' => 1000,
                'goodsId' => 'TD035',
                'goodsName' =>'充值'.$addCoins.'F币',
            ]);
            $coinsLog->save();
        }
    }

    public function search($user)
    {
        /* @var $tdeUser TdeUser */
        $tdeUser = TdeUser::find($user->id);
        if (empty($tdeUser)) {
            $tdeUser = new TdeUser();
            $now = date('Y-m-d H:i:s');
            $tdeUser->fill([
                'userId' => $user->id,
                'nick' => 113181682 + $user->id,
                'coins' => 0,
                'hisCoins' => 0,
                'biz' => '',
                'ownTD003' => $now,
                'ownTD011' => $now,
                'ownTD017' => $now,
                'ownTD005' => $now,
                'childLock' => '',
                'danceMat' => 0,
            ]);
            $tdeUser->save();
        }
        return $tdeUser;
    }

    protected function turntablePrizeNum($request){
        $prizeID = TurntablePrize::where("prizeNum",0)->get();
        return $this->biz($prizeID);
    }

    protected function turntablePro($request){
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $type=$bizIn->type;
        $pro = TurntableProbability::where("userType",$type)->get();
        return $this->biz($pro);
    }


    protected function TurntableState($request)
    {
        $user = $this->user;
        $num1 = 1;//免费
        $num2 = 2;//额外
        $num3 = 3;//包月
        function queryAddUser($user)
        {
            $freeStatus = '1';
            $addNumber = '0';

            $log = new TurntableState();
            $log->fill([
                'userID' => $user->id,
                'freeStatus' => $freeStatus,
                'freeDate' => date('Y-m-d H:i:s'),
                'addNumber' => $addNumber,
                'addNumberDate' => date('Y-m-d H:i:s'),
            ]);
            $log->save();
        }


        if ($user) {

            $queryUser = TurntableState::where("userID", $user->id)->get();

            if ($queryUser->first()) { //判断用户是否存在

                $freeDate = null;
                foreach ($queryUser as $title) {
                    $freeDate = $freeDate1 = explode(' ', $title->freeDate);
                }

                if ($freeDate[0] == date('Y-m-d')) {

                    $freeStatus = TurntableState::where('userID', $user->id)->where("freeStatus", "1")->get();

                    if ($freeStatus->first()) {//you

                        $this->queryDelUser();
                        return $this->biz($num1);

                    } else {
                        $freeStatus = TurntableState::where('userID', $user->id)->where("addNumber", '>', '0')->get();
                        if ($freeStatus->first()) {
                            $this->queryDelNumber();
                            return $this->biz($num2);//额外
                        } else {
                            return $this->biz($num3);
                        }
                    }
                } else {
                    TurntableState::where('userID', $user->id)->where('freeStatus', 0)->update(['freeStatus' => 1,'freeDate' => date('Y-m-d H:i:s')]);
                    TurntableState::where('userID', $user->id)->update(['addNumber' => 0,'addNumberDate' => date('Y-m-d H:i:s')]);
                    $this->queryDelUser();
                    return $this->biz($num1);
                }

            } else {
                queryAddUser($user);
                $this->queryDelUser();
                return $this->biz($num1);
            }
        }
    }

    protected function winnerInfo($request){
         $flag=false;
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $count = DB::table("tde_turntable_winning")->count();
        $num=$bizIn->num;
        $start=$num*30;
        $end=$start+30;
        if($end>=$count){
            $end=$count;
            $flag=true;
        }
        $winnerInfo = DB::table("tde_turntable_winning")->offset($start)->limit($end)->orderBy('created_at', 'desc')->get();
        return $this->biz([
            'info' => $winnerInfo,
            'flag'=>$flag
        ]);
    }


    protected  function userWinner($request){
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        $type=$bizIn->type;
        $user = $this->user;
        $update=null;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }
        if($type==4){
            $userPrize = TurntableWinning::where([
                'userId' => $user->id,
            ])
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $userPrize = TurntableWinning::where([
                'userId' => $user->id,
                'state' => $type
            ])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        if($type==1){
            for ($i=0;$i<count($userPrize);$i++){
                $winningDate1 = explode(' ', $userPrize[$i]->winningDate);
                $end = date('Y-m-d', strtotime('+7 day', strtotime($winningDate1[0])));
                if ($end < date('Y-m-d')){
                    $update=TurntableWinning::where('id', $userPrize[$i]->id)->update(['state' => 3]);
                    $this->addPrizeNum($userPrize[$i]->prizeID);
                }
            }
            if($update){
                $userPrize = TurntableWinning::where([
                    'userId' => $user->id,
                    'state' => $type
                ])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }else{
                $userPrize=$userPrize;
            }
        }
        return $this->biz($userPrize);
    }


    protected function page($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->page)) {
                $subCode = 1;
                $subMsg = 'not set PageIn param page';
            }
            if ($subCode != 0) {
                return [
                    'code' => 11012, 'msg' => '请求页面信息出错',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }
        $page = $bizIn->page;
        $items = TdePageInfo::where(['page' => $page])->get();
        return $this->biz($items);
    }

    protected function user($request)
    {
        $user = $this->user;
        if (empty($user)) {
            return [
                'code' => 10005,
                'msg' => '验证授权失败',
                'subCode' => 4,
                'subMsg' => '获取用户失败',
            ];
        }
        /* @var $tdeBiz TdeBizService */
        $tdeBiz = app(TdeBizService::class);
        $tdeUser = $tdeBiz->search($user);
//        \Log::info('-e user ', (array)$user);
//        \Log::info('-e tde/user ', (array)$tdeUser);
        $now = date('Y-m-d H:i:s');
        $tdeUser->ownTD003 = (strtotime($now) < strtotime($tdeUser->ownTD003));
        $tdeUser->ownTD011 = (strtotime($now) < strtotime($tdeUser->ownTD011));
        $tdeUser->ownTD017 = (strtotime($now) < strtotime($tdeUser->ownTD017));
        $tdeUser->ownTD005 = (strtotime($now) < strtotime($tdeUser->ownTD005));
        return $this->biz($tdeUser);
    }

    protected function lock($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->childLock)) {
                $subCode = 2;
                $subMsg = 'not set LockIn param childLock';
            }
            if ($subCode == 0 && !isset($bizIn->newLock)) {
                $subCode = 3;
                $subMsg = 'not set LockIn param newLock';
            }
            if ($subCode != 0) {
                return [
                    'code' => 11013, 'msg' => '设置童锁出错',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }

        $user = $this->user;
        if (empty($user)) {
            return [
                'code' => 10005,
                'msg' => '验证授权失败',
                'subCode' => 4,
                'subMsg' => '获取用户失败',
            ];
        }
        /* @var $tdeBiz TdeBizService */
        $tdeBiz = app(TdeBizService::class);
        $tdeUser = $tdeBiz->search($user);

        $childLock = empty($bizIn->childLock) ? '' : $bizIn->childLock;
        if ($childLock != $tdeUser->childLock) {
            return [
                'code' => 11013, 'msg' => '设置童锁出错',
                'subCode' => 1, 'subMsg' => '童锁验证出错',
            ];
        }

        $newLock = $bizIn->newLock;
        $tdeUser->childLock = $newLock;
        $tdeUser->save();
        return $this->biz([
            'childLock' => $newLock
        ]);
    }

    public function coin(UserService $userSrv)
    {
        $input = (array)Request::all();
        if (empty($input['userId'])) {
            return [
                "returnFlag" => 101,
                "note" => '未输入userId',
            ];
        }
        $userId = $input['userId'];

        if (empty($input['rmb'])) {
            return [
                "returnFlag" => 102,
                "note" => '未输入rmb',
            ];
        }
        $rmb = $input['rmb'];

        if (empty($input['cpCode'])) {
            return [
                "returnFlag" => 103,
                "note" => '未输入cpCode',
            ];
        }
        $cpCode = $input['cpCode'];

        if (empty($input['key'])) {
            return [
                "returnFlag" => 104,
                "note" => '未输入key',
            ];
        }
        $signKey = $input['key'];
        $gameid = isset($input['gameid']) ? $input['gameid'] : '';
        $goodsId = isset($input['goodsId']) ? $input['goodsId'] : '';
        $goodsName = isset($input['goodsName']) ? $input['goodsName'] : '';

        $ts = substr($signKey, 32);
        $md5 = substr($signKey, 0, 32);
        $sign = md5($userId . $ts . $this->appSecret);
        if ($md5 != $sign) {
            return [
                "returnFlag" => 201,
                "note" => '验证签名出错' . json_encode($input),
            ];
        }

        $user = User::find($userId);
        if (empty($user)) {
            return [
                "returnFlag" => 201,
                "note" => '获取用户出错',
            ];
        }

        $subCoins = $rmb * 100;
        if ($subCoins != 100 && $subCoins != 200 & $subCoins != 300 & $subCoins != 400 & $subCoins != 500) {
            return [
                "returnFlag" => 203,
                "note" => '道具金额应为[1,5]元',
            ];
        }

        /** @var $tdeUser TdeUser */
        $tdeUser = TdeUser::find($userId);
        if (empty($tdeUser)) {
            return [
                "returnFlag" => 202,
                "note" => '找不到用户账号',
            ];
        }

        $coins = $tdeUser->coins;
        if ($coins < $subCoins) {
            return [
                "returnFlag" => 204,
                "note" => '账号余额不足',
            ];
        }

        $tdeUser->coins -= $subCoins;
        $tdeUser->save();

        $coinLog = new TdeCoinsLog();
        $coinLog->fill([
            'userId' => $userId,
            'coins' => $coins,
            'add' => -$subCoins,
            'time' => date('Y-m-d H:i:s'),
            'gameId' => intval($gameid),
            'goodsId' => $goodsId,
            'goodsName' => $goodsName,
        ]);
        $coinLog->save();

        return [
            'returnFlag' => 0,
            'note' => '购买成功',
            'rmb' => $rmb,
            'userId' => $tdeUser->userId,
            'sid' => $coinLog->id,
            'coins' => $tdeUser->coins,
        ];
    }

    public function qrCode()
    {
        $url = Request::input('url');
        if (empty($url)) return;
        $url = urldecode($url);
        $size = Request::input('size', 256);
        $margin = Request::input('margin', 1);

        $img = QrCode
            ::format('png')
            ->size($size)
            ->margin($margin)
//            ->merge('/public/img/logo/96335.png', .3)
            ->encoding('UTF-8')
            ->generate($url);
        $resp = \Response::make($img);
        $resp->header('Content-Type', 'image/png');
        return $resp;
    }
}
