<?php

namespace App\Toodo\Edo;

use App\Toodo\Market\TdoGoodsInfo;
use App\User;


class EdoBizService
{
    /**
     * @param $user User
     * @param bool $convert 转换拥有道具json格式
     * @return EdoUser
     */
    public function search($user, $convert = true)
    {
        /** @var EdoUser $edoUser */
        $edoUser = EdoUser::find($user->id);
        if (empty($edoUser)) {
            $edoUser = new EdoUser();
            $edoUser->fill([
                'userId' => $user->id,
                'nickName' => '小双用户',
                'passportId' => $user->cardTV,
                'retailId' => $user->retailId,
                'items' => '',
                'bizContent' => '',
                'ownProps' => '',
            ]);
            $edoUser->save();
        }
        if ($edoUser->ownProps && $convert) {
            $edoUser->ownProps = json_decode($edoUser->ownProps);
        }
        return $edoUser;
    }

    /**
     * @param $user User
     * @param $goods TdoGoodsInfo
     * @param $quantity int
     */
    public function onBuyGoods($user, $goods, $quantity)
    {
        if ($goods->storeId != 1000) {
            return;
        }
        $edoUser = $this->search($user);
        $ownProps = $edoUser->ownProps;
        $ownProps = $ownProps ? (array)$ownProps : [];
        switch ($goods->goodsId) {
            case 'TD020'://联通
            case 'TD021':
            case 'TD022':
            case 'TD023':
            case 'TD024':
            case 'TD040'://河南有线
            case 'TD041':
            case 'TD050':
            case 'TD051':
            case 'TD052':
            case 'TD053':
            case 'TD060':
            case 'TD061':
            case 'TD062':
                $ownProps[$goods->goodsId] = date('Y-m-d H:i:s');
                break;
        }
        ///////////////////////////////////////////////////////////////////
        if ($goods->goodsId == 'TD021' || $goods->goodsId == 'TD024') {
            $cnt = isset($ownProps['TD004']) ? $ownProps['TD004'] : 0;
            $cnt++;
            $ownProps['TD004'] = $cnt;

            $cnt = isset($ownProps['TD006']) ? $ownProps['TD006'] : 0;
            $cnt++;
            $ownProps['TD006'] = $cnt;
        }
        if ($goods->goodsId == 'TD022' || $goods->goodsId == 'TD023') {
            $cnt = isset($ownProps['TD004']) ? $ownProps['TD004'] : 0;
            $cnt++;
            $ownProps['TD004'] = $cnt;
        }
        ///////////////////////////////////////////////////////////////////
        if ($goods->goodsId == 'TD052') {
            $cnt = isset($ownProps['TD004']) ? $ownProps['TD004'] : 0;
            $cnt++;
            $ownProps['TD004'] = $cnt;
        }
        if ($goods->goodsId == 'TD053') {
            $cnt = isset($ownProps['TD004']) ? $ownProps['TD004'] : 0;
            $cnt++;
            $ownProps['TD004'] = $cnt;

            $cnt = isset($ownProps['TD006']) ? $ownProps['TD006'] : 0;
            $cnt++;
            $ownProps['TD006'] = $cnt;
        }
        if ($goods->goodsId == 'TD062') {
            $cnt = isset($ownProps['TD005']) ? $ownProps['TD005'] : 0;
            $cnt++;
            $ownProps['TD005'] = $cnt;
        }
        $edoUser->ownProps = json_encode((object)$ownProps);
        $edoUser->save();
    }
}