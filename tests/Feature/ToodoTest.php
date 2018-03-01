<?php

namespace Tests\Feature;

use Tests\AppCase;

class ToodoTest extends AppCase
{
    public function testToodo()
    {
        $this->toodo('/api/toodo', '/toodo');
    }

    public function testUser()
    {
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/user',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => ''
        ];
        $input['signCode'] = $this->signIn($input);

        // not set UserIn param cardTV
        $response = $this->post('/api/toodo', $input);
        $response->assertJson([
            'code' => 11001,
            'subCode' => '1',
        ]);

        // not set UserIn param retailId
        $input['bizContent'] = json_encode([
            'cardTV' => $this->cardTV,
        ]);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo', $input);
        $response->assertJson([
            'code' => 11001,
            'subCode' => '2',
        ]);

        // 获取用户信息
        $input['bizContent'] = json_encode([
            'cardTV' => $this->cardTV,
            'retailId' => $this->retailId,
            'regionCode' => $this->regionCode,
        ]);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo', $input);
        $response->assertJson([
            'code' => 0,
        ]);

        $output = (array)json_decode($response->baseResponse->getContent());
        $md5 = $this->signOut($output);
//        echo ' sign:' . $output['sign'];
//        echo ' md5 :' . $md5;
        // 验证MD5
        $this->assertTrue($output['sign'] === $md5);

        // 通过token获取用户信息
        $response = $this->post('/api/toodo?token=' . $output['token'], $input);
        $response->assertJson([
            'code' => 0,
            'token' => $output['token'],
            'bizContent' => $output['bizContent'],
        ]);
    }
}
