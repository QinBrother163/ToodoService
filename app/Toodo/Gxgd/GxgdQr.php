<?php

namespace App\Toodo\Gxgd;

use App\Toodo\Fast;
use Illuminate\Support\Facades\Cache;
use Log;


class GxgdQr
{
    protected $tokenKey = 'gxgd.qr.token';
    protected $client_id = 'e587a147-85eb-4831-95e0-3c8c946f';
    protected $client_secret = 'b3681756-184e-475e-bfe6-cf81f3042';

    protected $url = 'http://qr.96335.com'; //外网

    //protected $url = 'http://10.1.41.135'; //内网

    public function getToken()
    {
        $token = Cache::get($this->tokenKey, function () {
            return $this->token();
        });
        return $token;
    }

    public function token()
    {
        $url = "$this->url/index/client/token";
        $biz = [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials',
        ];

        // {"error":"invalid_client","error_description":"Bad client credentials","openid":"1"}
        // {"access_token":"adfe9ff0-a1ad-4492-a84d-1ae5eef27fc0","token_type":"bearer","expires_in":6669,"scope":"read write","openid":"1"}

        list($code, $result) = Fast::curlPost($url, $biz);
        Log::info("-e GxgdQr token $code, $result");

        if ($code != 200) {
            return false;
        }
        $bizOut = json_decode($result);
        if (!isset($bizOut->access_token)) {
            return false;
        }
        $token = $bizOut->access_token;
        $expires = (int)$bizOut->expires_in;
        $min = (int)($expires / 60) - 1;
        Cache::put($this->tokenKey, $token, $min);
        return $token;
    }

    public function create($content)
    {
        $token = Cache::get($this->tokenKey, function () {
            return $this->token();
        });
        if (!$token) {
            return false;
        }

        $url = "$this->url/index/qrcode/create";
        $biz = [
            'access_token' => $token,
            'content' => $content,
            'title' => '生成二维码',
            'type' => '1', // 二维码类型 0:文本（默认）1：网址 2：支付码
            'image_type' => '0', // 0：jpg（默认）1：png;
            'network_type' => '1', // 0：外网（默认）1：内网
            'is_time' => '1', // 0：永久（默认）1：临时
            'valid_time' => strtotime('+1 day'), // 格式： Unix时间戳(Unix timestamp) 例：1484818376
            //'is_call' => '0', // 调用次数限制0：无限（默认）1：有限
            //'call_number' => '', // 调用次数限制-限制次数
            //'way' => '', // 二维码类别、传播渠道
        ];

        list($code, $result) = Fast::curlPost($url, $biz);
        Log::info("-e GxgdQr create $code, $result");

        if ($code != 200) {
            return false;
        }
        $bizOut = json_decode($result);
        if (!isset($bizOut->code)) {
            return false;
        }
        if ($bizOut->code != 1) {
            return false;
        }
        return $bizOut->result_data->s;
    }
}