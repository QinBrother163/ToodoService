<?php

namespace App\Toodo\Edo;

use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Serve\Server;
use App\Toodo\Serve\TdoServiceData;
use App\Toodo\ToodoController;
use App\Toodo\Unicom\TdoUnicomProd;


class EdoController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];
        if ($method == '/toodo/edo/user2') {
            return $this->user2($request);
        }
        if ($method == '/toodo/edo/user.action') {
            return $this->userAction($request);
        }
        if ($method == '/toodo/edo/page') {
            return $this->page($request);
        }
        if ($method == '/toodo/edo/shop') {
            return $this->shop($request);
        }
        if ($method == '/toodo/edo/game') {
            return $this->game($request);
        }
        if ($method == '/toodo/edo/game.ext') {
            return $this->gameExt($request);
        }
        if ($method == '/toodo/edo/queryProd') {
            return $this->queryProd($request);
        }
        if ($method == '/toodo/edo/queryArea') {
            return $this->queryArea($request);
        }
        if ($method == '/toodo/edo/stbLog') {
            return $this->stbLog($request);
        }
        //\Log::debug("-e input:", $request->all());
        //\Log::debug("-e EdoController $method: ", (array)$ret);
        return $this->error(10004, '找不到指定method的方法', '', '');
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

        /** @var EdoBlacklist $black */
        $black = EdoBlacklist::where(['retailId' => $retailId])->first();
        if ($black && $black->black) {
            \Log::info('-e blacklist contain ', ['retailId' => $retailId, 'cardTV' => $cardTV]);
            return $this->error(10005, '验证授权失败', 5, '发行渠道黑名单');
        }

        $token = $this->token;
        $result = $this->userSrv->getOrLogin($token, $retailId, $regionCode, $cardTV);

        $user = $result['user'];
        $token = $result['token'];
        $this->token = $token;

        /** @var EdoBizService $edoBiz */
        $edoBiz = app(EdoBizService::class);
        /** @var EdoUser $edoUser */
        $edoUser = $edoBiz->search($user);
        return $this->biz($edoUser);
    }

    protected function userAction($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->page)) {
                $subCode = 1;
                $subMsg = 'not set UserActionIn param page';
            }
            if ($subCode == 0 && !isset($bizIn->action)) {
                $subCode = 2;
                $subMsg = 'not set UserActionIn param action';
            }
            if ($subCode == 0 && !isset($bizIn->flag)) {
                $subCode = 3;
                $subMsg = 'not set UserActionIn param flag';
            }
            if ($subCode == 0 && !isset($bizIn->biz)) {
                $subCode = 4;
                $subMsg = 'not set UserActionIn param biz';
            }
            if ($subCode != 0) {
                return $this->error(11001, '用户行为参数缺失', $subCode, $subMsg);
            }
        }

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $page = $bizIn->page;
        $action = $bizIn->action;
        $flag = $bizIn->flag;
        $biz = $bizIn->biz;

        $actionLog = new EdoUserActionLog();
        $actionLog->fill([
            'userId' => $user->id,
            'page' => $page,
            'action' => $action,
            'flag' => $flag,
            'biz' => $biz,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $actionLog->save();

        return $this->biz('');
    }

    protected function page($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->page)) {
                $subCode = 1;
                $subMsg = 'not set PageIn param page';
            }

            if ($subCode != 0) {
                return $this->error(11002, '页面信息输入参数缺失', $subCode, $subMsg);
            }
        }
        $page = $bizIn->page;
        $itemInfos = EdoItemInfo::where('page', $page)->get();
        $bizOut = [
            'itemInfos' => $itemInfos,
        ];

        return $this->biz($bizOut);
    }

    protected function shop($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        $page = isset($bizIn->page) ? $bizIn->page : 0;
        if ($page) {
            $infos = EdoShopInfo::wherePage($page)->get();
            return $this->biz($infos);
        } else {
            $infos = EdoShopInfo::all();
            return $this->biz($infos);
        }
    }

    protected function game($request)
    {
        if ($request) {
        }
        $gameInfos = EdoGameInfo::all();
        $bizOut = [
            'gameInfos' => $gameInfos,
        ];

        return $this->biz($bizOut);
    }

    protected function gameExt($request)
    {
        if ($request) {
        }
        $gameInfos = EdoGameExt::all();
        $bizOut = [
            'gameInfos' => $gameInfos,
        ];

        return $this->biz($bizOut);
    }

    protected function queryProd($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->productId)) {
                $subCode = 1;
                $subMsg = 'not set queryProd param productId';
            }
            if ($subCode != 0) {
                return $this->error(11006, '查询道具输入参数缺失', $subCode, $subMsg);
            }
        }
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $productId = $bizIn->productId;
        $prod = null;
        if ($user->retailId == config('retail.unicom')) {
            $prod = TdoUnicomProd::where(['productId' => $productId])->first();
        }
        return $this->biz($prod);
    }

    protected function syncArea($user, $productId, $own)
    {
        $product = TdoGoodsInfo::find($productId);
        if (empty($product)) {
            \Log::error('-e not found product ' . $productId);
            return;
        }

        /** @var TdoServiceData $srv */
        $srv = TdoServiceData::where([
            'userId' => $user->id,
            'productId' => $productId,
        ])->first();

        /** @var Server $server */
        $server = app(Server::class);

        if ($srv && !$own) {
            /**
             * 关闭服务
             * 本月有效期提前结束
             * 更改消费金额
             */
            $server->close($user, $product, true);
        }
        if (!$srv && $own) {
            /**
             * 开通服务
             * 首月不记录消费 没有订单号啊??
             */
            $server->open($user, $product, '', 0, false);
        }
    }

    protected function queryArea($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->area)) {
                $subCode = 1;
                $subMsg = 'not set queryArea param area';
            }
            if ($subCode != 0) {
                return $this->error(11006, '查询服务输入参数缺失', $subCode, $subMsg);
            }
        }
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $area = $bizIn->area;
        $bizOut = [
            'area' => $area,     //专区 1 2 3
            'cnt' => 0,      //外设 -1.不需要外设 0-$.已有外设数量
            'own' => false,  //包月 true.包月中 false.未包月
        ];

        $info = EdoAreaInfo::find($area);
        if (empty($info)) {
            return $this->biz($bizOut);
        }

        if ($user->retailId == config('retail.unicom')) {
            if (!isset($bizIn->own)) {
                return $this->error(11006, '查询服务输入参数缺失', 2, 'not set queryArea param own');
            }
            if (!isset($bizIn->editor)) {
                return $this->error(11006, '查询服务输入参数缺失', 3, 'not set queryArea param editor');
            }
            if (!$bizIn->editor) {
                $this->syncArea($user, $info->ownId, $bizIn->own);
            }
        }

        if ($info->trial) {
            $bizOut['cnt'] = -1;
            $bizOut['own'] = true;
            return $this->biz($bizOut);
        }

        /** @var EdoBizService $eb */
        $eb = app(EdoBizService::class);
        $edoUser = $eb->search($user);
        $ownProps = $edoUser->ownProps;
        $ownProps = $ownProps ? (array)$ownProps : [];

        if ($info->cntId > 0) {
            $cnt = 0;
            $goodsId = sprintf("TD%03d", $info->cntId);
            if (isset($ownProps[$goodsId])) {
                $cnt = $ownProps[$goodsId];
            }
            $bizOut['cnt'] = $cnt;
        }
        if ($info->ownId > 0) {
            /** @var TdoServiceData $sv */
            $sv = TdoServiceData::where([
                'userId' => $user->id,
                'productId' => $info->ownId,
            ])->first();

            $now = date('Y-m-d H:i:s');
            $own = false;
            if ($sv) $own = $sv->isOwn($now);

            if (!$own) {
                $own = $info->isFree($now);
            }
            //! TODO 针对联通客户端鉴权
            if ($user->retailId == config('retail.unicom')) {
                $own = $own || $bizIn->own;
            }
            $bizOut['own'] = $own;
        }
        return $this->biz($bizOut);
    }

    public function stbLog($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $log = new EdoStbLog();
        $log->fill((array)$bizIn);
        $log->fill([
            'userId' => $user->id,
            'loginTime' => date('Y-m-d H:i:s'),
        ]);
        $log->save();

        $gameType = 1;
        /** @var EdoStbConfig $conf */
        $conf = EdoStbConfig::where(['model' => $log->model])->first();
        if ($conf) {
            $gameType = $conf->gameType;
        } else {
            $conf = new EdoStbConfig();
            $conf->fill([
                'model' => $log->model,
                'gameType' => $gameType,
            ]);
            $conf->save();
        }
        return $this->biz($gameType);
    }
}
