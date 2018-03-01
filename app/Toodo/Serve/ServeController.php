<?php

namespace App\Toodo\Serve;

use App\Toodo\Gxgd\GxgdPayment;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\ToodoController;


class ServeController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];

        //        if ($method == '/toodo/serve/call') {
        //            return $this->call($request);
        //        }
        if ($method == '/toodo/serve/query') {
            return $this->query($request);
        }
        if ($method == '/toodo/serve/query1') {
            return $this->query1($request);
        }

        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

    protected function call($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->productId)) {
                $subCode = 1;
                $subMsg = 'not set CallIn param productId';
            }
            if ($subCode == 0 && !isset($bizIn->callUrl)) {
                $subCode = 2;
                $subMsg = 'not set CallIn param callUrl';
            }

            if ($subCode != 0) {
                return [
                    'code' => 11006, 'msg' => '调用服务输入参数缺失',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }
        $productId = $bizIn->productId;
        $callUrl = $bizIn->callUrl;
        $data = isset($bizIn->data) ? $bizIn->data : '';

        $user = $this->user;
        if (empty($user)) {
            return [
                'code' => 10005,
                'msg' => '验证授权失败',
                'subCode' => 4,
                'subMsg' => '获取用户失败',
            ];
        }

        $srvs = TdoServiceData::where([
            'userId' => $user->id,
            'productId' => $productId,
        ])->get();

        if (count($srvs) <= 0) {
            $prod = TdoGoodsInfo::find($productId);
            return $prod;
        }

        $bizOut = [
            'userId' => $user->id,
            'productId' => $productId,
            'data' => $data,
        ];

        $resp = $this->biz($bizOut);
        return view('toodo.submit', [
            'url' => $callUrl,
            'data' => $resp,
        ]);
    }

    protected function query($request)
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
        $srvs = TdoServiceData::where([
            'userId' => $user->id,
        ])->get();
        return $this->biz($srvs);
    }

    protected function query1($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);

        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && !isset($bizIn->productId)) {
                $subCode = 1;
                $subMsg = 'not set query1 param productId';
            }
            if ($subCode != 0) {
                return [
                    'code' => 11006, 'msg' => '查询服务输入参数缺失',
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

        $productId = $bizIn->productId;
        /** @var TdoServiceData $srv */
        $srv = TdoServiceData::where([
            'userId' => $user->id,
            'productId' => $productId,
        ])->first();

        if ($user->id == 4) {
            \Log::info('-e query1 start -----------------');
        }
        if ($user->retailId == config('retail.gxgd')) {
            /** @var GxgdPayment $payment */
            $payment = app(GxgdPayment::class);
            $ret = $payment->auth([
                'user' => $user,
                'productId' => $productId,
            ]);
            if ($srv && !$ret) {
                $srv->delete();
                $srv = null;
                //TODO 变更服务 0
            }
            if (!$srv && $ret) {
                $srv = new TdoServiceData();
                $srv->fill([
                    'userId' => $user->id,
                    'retailId' => $user->retailId,
                    'productId' => $productId,
                ]);
                $prod = TdoGoodsInfo::find($productId);
                $srv->book($user, $prod, 1);
                //TODO 变更服务 1
            }
        }
        if ($user->id == 4) {
            \Log::info('-e query1 end:', (array)$srv);
        }
        return $this->biz($srv);
    }
}
