<?php

namespace App\Toodo\Biz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BizController extends Controller
{
    protected $bizSrv;

    public function __construct(BizService $srv)
    {
        $this->bizSrv = $srv;
    }

    protected function biz2($bizOut)
    {
        $ts = time();
        $biz = json_encode($bizOut);
        $response = [
            'code' => 0,
            'msg' => 'success',
            'ts' => $ts,
            'biz' => $biz,
        ];
        $response['sign'] = $this->bizSrv->sign3('0success', $ts, $biz);
        return $response;
    }

    public function address(Request $request)
    {
        ///toodo/address?appId=9999&userId=1&ts=&sign=
        $this->validate($request, [
            //'appId' => 'required',
            'userId' => 'required',
            'retailId' => 'required',
            'ts' => 'required',
            'sign' => 'required',
        ]);
        //$appId = $request->input('appId');
        $userId = $request->input('userId');
        $retailId = $request->input('retailId');
        $ts = $request->input('ts');
        $sign = $request->input('sign');

        //        if ($appId != $this->srvId) {
        //            return [
        //                'code' => 403,
        //                'msg' => 'appId error',
        //            ];
        //        }

        $md5 = $this->bizSrv->sign3($userId, $retailId, $ts);
        if ($md5 != $sign) {
            return [
                'code' => 403,
                'msg' => 'sign error',
                //'md5' => $md5,
            ];
        }


        $address = TdoUserAddress::where([
            'userId' => $userId,
            'retailId' => $retailId,
        ])->first();

        if (!$address) {
            $address = $this->bizSrv->remoteAddress($userId, $retailId);
        }

        if (!$address) {
            return [
                'code' => 404,
                'msg' => 'not found address',
            ];
        }
        return $this->biz2($address);
    }
}
