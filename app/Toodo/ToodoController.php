<?php

namespace App\Toodo;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class ToodoController extends Controller
{
    protected $appId;
    protected $appSecret;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var string
     */
    protected $token;
    protected $oldToken;

    /**
     * @var UserService
     */
    protected $userSrv;


    public function __construct()
    {
        $this->appId = env('TDSRV_APP_ID', 1000);
        $this->appSecret = env('TDSRV_APP_SECRET');

        $this->userSrv = app(UserService::class);
    }

    protected function serialNo($numLen = 20)
    {
        return Fast::serialNo($numLen);
    }

    protected function biz($bizOut)
    {
        $response = [
            'code' => 0,
            'msg' => '调用成功',
            'subCode' => '',
            'subMsg' => '',
            'timestamp' => date('Y-m-d H:i:s'),
            'sign' => '',
            'bizContent' => json_encode($bizOut),
        ];
        if ($this->token != $this->oldToken) {
            $response['token'] = $this->token;
            \Log::info('-e new token ', $response);
        }
        $response['sign'] = ResponseBody::signCode($response, $this->appSecret);
        return $response;
    }

    protected function error($code, $msg, $subCode, $subMsg)
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'subCode' => $subCode,
            'subMsg' => $subMsg,
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        if ($this->token != $this->oldToken) {
            $response['token'] = $this->token;
            \Log::info('-e new token ', $response);
        }
        $response['sign'] = ResponseBody::signCode($response, $this->appSecret);
        return $response;
    }

    public function toodo(Request $request)
    {
        //return $request->getContent();
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';

            if ($subCode == 0 && !isset($request['appId'])) {
                $subCode = 1;
                $subMsg = 'not set input param appId';
            }
            if ($subCode == 0 && !isset($request['method'])) {
                $subCode = 2;
                $subMsg = 'not set input param method';
            }
            if ($subCode == 0 && !isset($request['timestamp'])) {
                $subCode = 3;
                $subMsg = 'not set input param timestamp';
            }
            if ($subCode == 0 && !isset($request['signCode'])) {
                $subCode = 4;
                $subMsg = 'not set input param signCode';
            }
            if ($subCode == 0 && !isset($request['bizContent'])) {
                $subCode = 5;
                $subMsg = 'not set input param bizContent';
            }

            if ($subCode != 0) {
                return $this->error(10001, '输入参数缺失', $subCode, $subMsg);
            }
        }

        $appId = $request['appId'];
        if ($appId != $this->appId) {
            return $this->error(10002, '找不到指定appId应用', '', '');
        }

        $md5 = RequestBody::signCode($request, $this->appSecret);
        $sign = $request['signCode'];

        if (strcasecmp($sign, $md5) != 0) {
            return $this->error(10003, '输入参数签名错误', '', '');
        }

        if (!empty($request['token'])) {
            $this->token = $request['token'];
        } else if (!empty($request['appAuthToken'])) {
            $this->token = $request['appAuthToken'];
        } else {
            $this->token = '';
            $this->user = null;
        }
        $this->oldToken = $this->token;
        if (!empty($this->token)) {
            //$this->user = $this->userSrv->onlyUser($this->token);
            $ret = $this->userSrv->getUser($this->token);
            if ($ret['subCode'] == 0) {
                $this->token = $ret['token'];
                $this->user = $ret['user'];
            }
        }
        //\Log::info('-e toodo ', $request->all());
        return $this->doMethod($request);
    }

    /**
     * @param $request Request
     * @return array
     */
    protected function doMethod($request)
    {
        $method = $request['method'];

        if ($method == '/toodo/user') {
            return $this->user($request);
        }
        if ($method == '/toodo/bizUser') {
            return $this->bizUser($request);
        }
        if ($method == '/toodo/goodbye') {
            return $this->goodbye($request);
        }

        return $this->error(10004, '找不到指定method的方法', '', '');
    }

    protected function user($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->retailId)) {
                $subCode = 1;
                $subMsg = 'not set UserIn param retailId';
            }
            if ($subCode == 0 && empty($bizIn->cardTV)) {
                $subCode = 2;
                $subMsg = 'not set UserIn param cardTV';
            }
            //            if ($subCode == 0 && empty($bizIn->regionCode)) {
            //                $subCode = 3;
            //                $subMsg = 'not set UserIn param regionCode';
            //            }
            if ($subCode != 0) {
                return $this->error(11001, '账号输入参数缺失', $subCode, $subMsg);
            }
        }
        $cardTV = $bizIn->cardTV;
        $retailId = $bizIn->retailId;
        $regionCode = empty($bizIn->regionCode) ? $retailId : $bizIn->regionCode;

        $token = $this->token;
        $result = $this->userSrv->getOrLogin($token, $retailId, $regionCode, $cardTV);

        /** @var User $user */
        $user = $result['user'];
        $token = $result['token'];

        //log user login
        $bizOut = [
            'userId' => $user->id,
            'retailId' => $user->retailId,
            'regionCode' => $user->regionCode,
            'cardTV' => $user->cardTV,
            'bizUser' => $user->bizUser,
        ];
        $this->token = $token;
        return $this->biz($bizOut);
    }

    protected function bizUser($request)
    {
        $token = $this->token;
        if (empty($token)) {
            return $this->error(10005, '验证授权失败', 1, '授权码appAuthToken或token不能为空');
        }

        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        $bizContent = $request['bizContent'];
        try {
            /** @var \App\Toodo\Gxgd\bizUser $bizUser */
            $bizUser = json_decode($bizContent);
            if ($bizUser && $bizUser->userId) {
                //                $user->name = $user->retailId . '_' . $bizUser->stbId;
                //                $user->email = $user->name . '@toodo.com.cn';
                //                $user->personId = $bizUser->userId;
                //                $user->stboxId = $bizUser->stbId;
                $user->regionCode = $bizUser->areaCode;
                $user->bizUser = $bizContent;
                $user->save();
            }
            \Log::debug('-e bizUser.search:' . $bizUser->search);
        } catch (\Exception $exception) {
            \Log::debug('-----------------------------------------------');
            \Log::debug('-e biz:' . $bizContent);
            \Log::debug('-e bizUser error:' . $exception->getMessage());
        }

        return $this->biz($user);
    }

    protected function goodbye($request)
    {
        if (empty($this->token)) {
            return $this->error(10005, '验证授权失败', 1, '授权码appAuthToken或token不能为空');
        }

        //! 验证用户=================================================
        $user = $this->user;
        if (empty($user)) {
            return $this->error(10005, '验证授权失败', 4, '获取用户失败');
        }

        //log user logout

        return $this->biz('');
    }

    public function onGoGo(Request $request)
    {
        $appId = $request->input('appId');
        $method = $request->input('method');
        $sign = $request->input('sign');
        $token = $request->input('token');
        $ts = $request->input('ts');

        if ($appId != $this->appId) {
            return [
                'code' => 403,
                'msg' => '找不到应用编号',
            ];
        }
        if (empty($method)) {
            return [
                'code' => 404,
                'msg' => '方法名为空',
            ];
        }
        if (empty($sign)) {
            return [
                'code' => 405,
                'msg' => '签名为空',
            ];
        }

        $input = $request->except(['appId', 'sign']);
        if (!ksort($input)) {
            return [
                'code' => 406,
                'msg' => '参数排序出错',
            ];
        }

        $msg = '';
        foreach ($input as $v) {
            $msg .= $v;
        }

        $appSecret = $this->appSecret;
        $msg = $appId . $msg . $appSecret;
        $md5 = md5($msg);
        if ($md5 != $sign) {
            return [
                'code' => 407,
                'msg' => '签名出错',
            ];
        }

        if (!empty($request['token'])) {
            $this->token = $request['token'];
        } else if (!empty($request['appAuthToken'])) {
            $this->token = $request['appAuthToken'];
        } else {
            $this->token = '';
            $this->user = null;
        }
        if (!empty($this->token)) {
            $this->user = $this->userSrv->onlyUser($this->token);
        }

        switch (intval($method)) {
            case 7001:

                break;
            case 8001:
            case 8002:
            case 7002:
            case 8003:
            case 8004:
            case 8005:
            case 7101:
            case 9101:
            case 8101:
            case 8102:
            case 8103:
                break;
        }

        return [
            'code' => 404,
            'msg' => '找不到指定方法',
            'method' => $method,
        ];
    }

    protected function m7001(Request $request)
    {
        $cardTV = $request->cardTV;
        $retailId = $request->retailId;
        $regionCode = $request->input('regionCode', 0);

        $token = $this->token;
        $result = $this->userSrv->getOrLogin($token, $retailId, $regionCode, $cardTV);

        /** @var User $user */
        $user = $result['user'];
        $token = $result['token'];

        //log user login
        $bizOut = [
            'userId' => $user->id,
            'retailId' => $user->retailId,
            'regionCode' => $user->regionCode,
            'cardTV' => $user->cardTV,
            'bizUser' => $user->bizUser,
        ];

        $bizOut = array_except($bizOut, ['sign']);
        ksort($bizOut);
        $this->token = $token;
        return $this->biz($bizOut);
    }
}