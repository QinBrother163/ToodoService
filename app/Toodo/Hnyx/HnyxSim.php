<?php

namespace App\Toodo\Hnyx;

use App\Toodo\Fast;

class HnyxSim
{
    /**
     * @param $inputBody PayByQrCodeRequest|array
     * @return array
     */
    public function payByQrCode($inputBody)
    {
        $bizUrl = env('TDBIZ_URL');
        $appId = env('TDSRV_APP_ID');
        $appSecret = env('TDSRV_APP_SECRET');

        $serialNo = Fast::serialNo();
        $ts = time();
        $msg = "$appId$serialNo$ts$appSecret";
        $bizIn = [
            'appId' => $appId,
            'serialNo' => $serialNo,
            'ts' => $ts,
            'sign' => md5($msg),
            //'str' => $msg,
        ];

        $args = http_build_query($bizIn);
        $url = "$bizUrl/hnyx/simPay?$args";

        $resp = [
            'code' => '0000',
            'message' => '成功',
            'imageUrl' => Fast::qrUrl($url),
            'businessSN' => $serialNo,
            'qrCodeValue' => $url,
        ];
        return $resp;
    }

    /**
     * @param $inputBody QueryPayResultRequest|array
     * @return array
     */
    public function queryPayResult($inputBody)
    {
        $inputBody = (object)$inputBody;

        $bizUrl = env('TDBIZ_URL');
        $appId = env('TDSRV_APP_ID');
        $appSecret = env('TDSRV_APP_SECRET');

        $url = "$bizUrl/toodo/simPay";

        $serialNo = $inputBody->businessSN;
        $ts = time();
        $msg = "$appId$serialNo$ts$appSecret";
        $bizIn = [
            'appId' => $appId,
            'serialNo' => $serialNo,
            'ts' => $ts,
            'sign' => md5($msg),
            //'str' => $msg,
        ];
        list($code, $result) = Fast::curlGetJson($url, $bizIn);

        /**
         * @var $code
         * 错误码    说明
         * 0000    请求成功。
         * 0001    客户信息不存在。
         * 0002    金额参数不正确
         * 0003    内部错误。
         * 0004    查不到该订单信息
         * 0005    二维码尺寸不正确
         */
        if ($code != 200) {
            return [
                'code' => '0003',
                'message' => '内部错误',
                'isPaid' => '0',
                'noticeBoss' => '0',
            ];
        } else {
            /** @var SimPayOut $bizOut */
            $bizOut = json_decode($result);
            if ($bizOut->code != 0) {
                return [
                    'code' => '0004',
                    'message' => '查不到该订单信息',
                    'isPaid' => '0',
                    'noticeBoss' => '0',
                ];
            } else {
                $bizOut->biz = json_decode($bizOut->biz);
                $biz = $bizOut->biz;
                return [
                    'code' => '0000',
                    'message' => '请求成功',
                    'isPaid' => $biz->tradeStatus >= 2 ? '1' : '0',
                    'noticeBoss' => '0',
                ];
            }
        }
    }
}