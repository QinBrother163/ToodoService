<?php

namespace App\Toodo\Market;

use App\Toodo\ToodoController;


class MarketController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];

        if ($method == '/toodo/market/query1') {
            return $this->query1($request);
        }
        if ($method == '/toodo/market/query') {
            return $this->query($request);
        }

        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

    protected function query1($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->productId)) {
                $subCode = 1;
                $subMsg = 'not set Query1In param productId';
            }
            if ($subCode != 0) {
                return [
                    'code' => 11001, 'msg' => '查询商品信息参数缺失',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }

        $productId = $bizIn->productId;

        $goods = TdoGoodsInfo::find($productId);
        return $this->biz($goods);
    }

    protected function query($request)
    {
        $bizContent = $request['bizContent'];
        $bizIn = json_decode($bizContent);
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';
            if ($subCode == 0 && empty($bizIn->storeId)) {
                $subCode = 2;
                $subMsg = 'not set QueryIn param storeId';
            }
            if ($subCode != 0) {
                return [
                    'code' => 11001, 'msg' => '查询商品信息参数缺失',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }

        $goodz = TdoGoodsInfo::where([
            'storeId' => $bizIn->storeId,
        ])->get();
        return $this->biz($goodz);
    }
}
