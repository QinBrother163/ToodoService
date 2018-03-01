<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use JWTAuth;


class OneKeyLoginController extends Controller
{
    public function oneKeyLogin(Request $request)
    {
        $retailId = '96956';

        return $this->loginWithToken($request, $retailId);
    }


    protected function loginWithToken($request, $retailId)
    {
        $this->validate($request, [
            'regionCode' => 'required',
            'cardTV' => 'required',
        ]);

        $cardTV = $request->input('cardTV');
        $regionCode = $request->input('regionCode');

        //! TODO
        //! 检查区域号范围格式
        //! 检查卡号范围格式

        $user = null;
        $oldToken = null;

        try {
            $oldToken = JWTAuth::getToken();
            if (!empty($oldToken)) {
                $user = JWTAuth::parseToken()->authenticate();
            }

        } catch (TokenExpiredException $e) {
            $user = null;
        } catch (TokenInvalidException $e) {
            $user = null;
        } catch (JWTException $e) {
            $user = null;
        }

        if (!empty($user)) {
            JWTAuth::invalidate($oldToken);

            if (strcmp($user->cardTV, $cardTV) == 0
                && strcmp($user->regionCode, $regionCode) == 0
                && strcmp($user->retailId, $retailId) == 0
            ) {
                return $this->responseToken($user);
            }
        }


//        $personInfo = $request->input('personInfo');
//        $stboxInfo = $request->input('stboxInfo');

        //! 注意属性变量类型 是int 还是string
        $user = User::firstOrNew([
            'retailId' => $retailId,
            'regionCode' => $regionCode,
            'cardTV' => $cardTV,
        ]);

        if (empty($user->id)) {
            //! 创建账号
            $name = $cardTV;
            $email = '' . $name . '@toodo.com.cn';
            $password = 'toodo1814';
            $user->fill([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
//                'personId' => $personId,
//                'stboxId' => $stboxId,
            ]);

            $user->save();
        }

        $this->updatePerson($request, $user);
        $this->updateStbData($request, $user);

        return $this->responseToken($user);
    }


    protected function updatePerson($request, $user)
    {
        //! 创建用户
//            $person = Person::create([
//                'IC' => '',
//                'name' => $name,
//                'sex' => 0,
//                'telephone' => '',
//                'mobile' => '',
//                'city' => '',
//                'address' => '',
//                'familyId' => 0,
//                'bindCard' => '',
//            ]);
//            $user->personId = $person->id;
    }

    protected function updateStbData($request, $user)
    {
        //! 收集机顶盒信息
//            $stbId = DB::table('stbs')->insertGetId([
//                'manufacturer' => '机顶盒厂商',
//                'model' => '产品型号',
//                'memory' => '内存大小',
//                'chip' => '芯片信号',
//                'os' => '搭载系统',
//            ]);
//            $stboxId = DB::table('stboxs')->insertGetId([
//                'personId' => $personId,
//                'stbId' => $stbId,
//                'notes' => '',
//            ]);
    }

    protected function responseToken($user)
    {
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
        ]);
    }
}
