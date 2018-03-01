<?php

namespace App\Toodo;

use App\Toodo\Gxgd\bizUser;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Exception;
use JWTAuth;
use Log;


class UserService
{
    /**
     * @param $token string 授权码
     * @param $retailId string 渠道编号
     * @param $regionCode string 区域码
     * @param $cardTV string 机顶盒卡号
     * @return array
     */
    public function getOrLogin($token, $retailId, $regionCode, $cardTV)
    {
        $user = null;
        $subCode = 0;
        $subMsg = '';

        if (!empty($token)) {
            try {
                $user = JWTAuth::toUser($token);
            } catch (TokenExpiredException $e) {
                try {
                    $token = JWTAuth::refresh($token);
                    $user = JWTAuth::toUser($token);
                    $subMsg = 'refresh ok';
                } catch (Exception $e) {
                    $user = null;
                    $token = null;
                }
            } catch (Exception $e) {
                $user = null;
                $token = null;
            }
        }

        if (!empty($user)) {
            if (
                $user->cardTV != $cardTV ||
                $user->retailId != $retailId
            ) {
                $token = null;
                $user = null;
            }
        }

        if (empty($user)) {
            //! 注意属性变量类型 是int 还是string
            $user = User::firstOrNew([
                'retailId' => $retailId,
                'cardTV' => $cardTV,
            ]);
            if (empty($user->id)) {
                //! 创建账号
                $name = $retailId . '_' . $cardTV;
                $email = $name . '@toodo.com.cn';
                Log::info("-e create user name:$name");
                $password = md5('toodo1814');
                $user->fill([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt($password),
                    //'personId' => $personId,
                    //'stboxId' => $stboxId,
                    'regionCode' => $regionCode,
                ]);
                $user->save();
            }
            $token = JWTAuth::fromUser($user);
            $subMsg = 'token fromUser ok';
        }
        return [
            'user' => $user,
            'token' => $token,
            'subCode' => $subCode,
            'subMsg' => $subMsg,
        ];
    }

    public function getUser($token)
    {
        if (empty($token)) {
            return [
                'subCode' => 1,
                'subMsg' => '授权码appAuthToken或token不能为空',
            ];
        }

        $user = null;
        $subCode = null;
        $subMsg = null;

        try {
            $user = JWTAuth::toUser($token);
            $subCode = 0;
            $subMsg = '成功';

        } catch (TokenExpiredException $e) {
            try {
                $token = JWTAuth::refresh($token);
                $user = JWTAuth::toUser($token);
                $subCode = 0;
                $subMsg = '成功';
            } catch (Exception $e) {
                $user = null;
                $token = null;
                $subCode = 1;
                $subMsg = '刷新失败 code:' . $e->getCode() . ' msg:' . $e->getMessage();
            }

        } catch (TokenInvalidException $e) {
            $token = null;
            $user = null;
            $subCode = 2;
            $subMsg = '授权码失效 code:' . $e->getCode() . ' msg:' . $e->getMessage();

        } catch (JWTException $e) {
            $token = null;
            $user = null;
            $subCode = 3;
            $subMsg = '其他错误 code:' . $e->getCode() . ' msg:' . $e->getMessage();
        }
        $ret = [
            'user' => $user,
            'token' => $token,
            'subCode' => $subCode,
            'subMsg' => $subMsg,
        ];
        if ($subCode != 0) {
            Log::info('-e getUser ', $ret);
        }
        return $ret;
    }

    public function onlyUser($token)
    {
        $user = null;
        try {
            $user = JWTAuth::toUser($token);
        } catch (JWTException $e) {
            $user = null;
        }
        return $user;
    }

    public function getBizUser(User $user)
    {
        if (!empty($user->bizUser)) {
            return json_decode($user->bizUser);
        }

        $gxNetEnable = env('GXGD_NET_ENABLE');
        if ($user->retailId == '96335' || $gxNetEnable) {
            /** @var bizUser $gxUser */
            $gxUser = null;
            $gxNetEnv = env('GXGD_NET_ENV');
            if ($gxNetEnv == 0) {
                $gxUser = (object)[
                    // 用户id 机顶盒id 一一对应
                    'userId' => '108749936', 'stbId' => '34290157870',
                    //'userId' => '108749857', 'stbId' => '1140150003308',
                    'areaCode' => '0',
                ];
            } else {
                $gxUser = (object)[
                    'userId' => '108767787', 'stbId' => '1140150003308',
                    //'userId' => '105124360', 'stbId' => '34290024617',
                    //'userId' => '108767767', 'stbId' => '34290157870',
                    'areaCode' => '0',
                ];
            }
            return $gxUser;
        }

        return false;
    }
}