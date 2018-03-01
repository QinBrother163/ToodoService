<?php

namespace Tests;

use App\Toodo\Fast;
use App\Toodo\RequestBody;
use App\Toodo\ResponseBody;


abstract class AppCase extends TestCase
{
    protected $appId = '1000';
    protected $appSecret = 'RcOFhtAYzwCGo91PGHdV';

    protected $retailId = '1000';
    protected $cardTV = '10086';
    protected $regionCode = '1000';
    protected $userId = '1';
    protected $token = '';


    protected function signIn($input)
    {
        return RequestBody::signCode($input, $this->appSecret);
    }

    protected function signOut($output)
    {
        return ResponseBody::signCode($output, $this->appSecret);
    }

    protected function serialNo($numLen = 20)
    {
        return Fast::serialNo($numLen);
    }

    protected function toodo($url, $method)
    {
        $input = [];
        $response = $this->post($url, $input);
        $response->assertStatus(200);

        // not set input param appId
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10001,
            'subCode' => '1',
        ]);

        // not set input param method
        $input['appId'] = $this->appId;
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10001,
            'subCode' => '2',
        ]);

        // not set input param timestamp
        $input['method'] = $method;
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10001,
            'subCode' => '3',
        ]);

        // not set input param signCode
        $input['timestamp'] = date('Y-m-d H:i:s');
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10001,
            'subCode' => '4',
        ]);

        // not set input param bizContent
        $input['signCode'] = $this->signIn($input);
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10001,
            'subCode' => '5',
        ]);

        // 输入签名不正确
        $input['bizContent'] = '{}';
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10003,
        ]);

        // 找不到指定方法
        $input['signCode'] = $this->signIn($input);
        $response = $this->post($url, $input);
        $response->assertJson([
            'code' => 10004,
        ]);
    }

    protected function token()
    {
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/user',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => json_encode([
                'cardTV' => $this->cardTV,
                'retailId' => $this->retailId,
                'regionCode' => $this->regionCode,
            ]),
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo', $input);
        $response->assertJson([
            'code' => 0,
        ]);
        $output = json_decode($response->baseResponse->getContent());
        $this->token = $output->token;
    }
}
