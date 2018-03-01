<?php

namespace App\Toodo\Biz;

use App\Toodo\Fast;
use App\Toodo\RequestBody;
use App\Toodo\ResponseBody;


class BizService
{
    protected $bizId;
    protected $bizSecret;
    protected $bizUrl;

    protected $srvId;
    protected $srvSecret;


    function __construct()
    {
        $this->bizId = env('TDBIZ_APP_ID', 9998);
        $this->bizSecret = env('TDBIZ_APP_SECRET');

        $bizUrl = env('TDBIZ_URL', 'http://feiben.toodo.com.cn/tdbiz');
        $this->bizUrl = "$bizUrl/api/toodo/biz";

        $this->srvId = env('TDSRV_APP_ID', 1000);
        $this->srvSecret = env('TDSRV_APP_SECRET');
    }

    /**
     * @param $url string
     * @param $method string
     * @param $bizIn array|object
     * @return bool|int|object
     */
    public function send($url, $method, $bizIn)
    {
        $bodyIn = [
            'appId' => $this->bizId,
            'method' => $method,
            'format' => 'JSON',
            'charset' => 'utf-8',
            'signType' => 'MD5',
            'timestamp' => date(''),
            'version' => '1.0',
            'appAuthToken' => '',
            'bizContent' => json_encode($bizIn),
        ];
        $bodyIn['signCode'] = RequestBody::signCode($bodyIn, $this->bizSecret);

        list($code, $result) = Fast::curlPostJson($url, $bodyIn);
        if ($code == '200') {
            /* @var ResponseBody $bodyOut */
            $bodyOut = json_decode($result);
            if ($bodyOut->code !== 0) {
                return $bodyOut->code;
            }
            return json_decode($bodyOut->bizContent);
        }
        return false;
    }

    public function order($order)
    {
        return $this->send($this->bizUrl, '/toodo/biz/order', $order);
    }

    public function sign3($arg1, $arg2, $arg3)
    {
        $msg = "$this->srvId$arg1$arg2$arg3$this->srvSecret";
        return md5($msg);
    }

    public function addressQueryUrl($userId, $retailId)
    {
        $ts = time();
        $sign = $this->sign3($userId, $retailId, $ts);
        $bizIn = [
            'userId' => $userId,
            'retailId' => $retailId,
            'ts' => $ts,
            'sign' => $sign,
        ];
        $args = http_build_query($bizIn);
        $url = url('/toodo/address');
        $url = "$url?$args";
        return $url;
    }

    public function addressSubmitUrl($userId, $retailId)
    {
        $ts = time();
        $sign = $this->sign3($userId, '', $ts);
        $bizIn = [
            'appId' => $this->srvId,
            'userId' => $userId,
            'ts' => $ts,
            'retailId' => $retailId,
            'sign' => $sign,
        ];
        $args = http_build_query($bizIn);
        $url = "http://feiben.toodo.com.cn/tdbiz/hnyx/address";
        $url = "$url?$args";
        return $url;
    }

    public function remoteAddress($userId, $retailId)
    {
        $ts = time();
        $bizIn = [
            'appId' => $this->srvId,
            'userId' => $userId,
            'retailId' => $retailId,
            'ts' => $ts,
            'sign' => $this->sign3($userId, '', $ts),
        ];
        $url = env('TDBIZ_URL', 'http://feiben.toodo.com.cn/tdbiz');
        $url = "$url/toodo/address";
        list($status, $result) = Fast::curlGetJson($url, $bizIn);
        if ($status != 200) {
            return false;
        }
        $bizOut = json_decode($result);
        if ($bizOut->code != 0) {
            return false;
        }
        $address = json_decode($bizOut->biz);
        return $address;
    }
}