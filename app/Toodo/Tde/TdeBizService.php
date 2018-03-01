<?php

namespace App\Toodo\Tde;

use App\Toodo\Market\TdoGoodsInfo;
use App\User;


class TdeBizService
{
    /**
     * @param $user User
     * @return TdeUser
     */
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

    /**
     * @param $user User
     * @param $goods TdoGoodsInfo
     */
    public function onBuyGoods($user, $goods, $quantity)
    {
        if ($goods->storeId != 1000) {
            return;
        }
        if ($goods->goodsId == 'TD003') {
            $tdeUser = $this->search($user);
            $tdeUser->ownTD003 = date('Y-m-d H:i:s', strtotime("+1 month"));
            $tdeUser->save();
        } else if ($goods->goodsId == 'TD011') {
            $tdeUser = $this->search($user);
            $tdeUser->ownTD011 = date('Y-m-d H:i:s', strtotime("+6 month"));
            $tdeUser->danceMat++;
            $tdeUser->save();
        } else if ($goods->goodsId == 'TD017') {
            $tdeUser = $this->search($user);
            $tdeUser->ownTD017 = date('Y-m-d H:i:s', strtotime("+3 month"));
            $tdeUser->danceMat++;
            $tdeUser->save();
        } else if ($goods->goodsId == 'TD005') {
            $tdeUser = $this->search($user);
            $tdeUser->ownTD005 = date('Y-m-d H:i:s');
            $tdeUser->danceMat++;
            $tdeUser->save();
        }

        //TD031	充值1000T币
        //TD032	充值2000T币
        //TD033	充值5000T币
        //TD034	充值10000T币
        $addCoins = 0;
        if ($goods->goodsId == 'TD031') {
            $addCoins = 1000;
        } else if ($goods->goodsId == 'TD032') {
            $addCoins = 2000;
        } else if ($goods->goodsId == 'TD033') {
            $addCoins = 5000;
        } else if ($goods->goodsId == 'TD034') {
            $addCoins = 10000;
        }
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
                'goodsId' => $goods->goodsId,
                'goodsName' => $goods->goodsName,
            ]);
            $coinsLog->save();
        }
    }
}