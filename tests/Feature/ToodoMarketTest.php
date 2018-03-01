<?php

namespace Tests\Feature;

use Tests\AppCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ToodoMarketTest extends AppCase
{
    public function testQuery()
    {
        $this->token();
        //查询一个商品
        $bizIn = [
            'productId' => 20,
        ];
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/market/query1',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => json_encode($bizIn),
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/market?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 0,
        ]);
        //查询全部商品
        $bizIn = [
            'storeId' => $this->appId,
        ];
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/market/query',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => json_encode($bizIn),
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/market?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 0,
        ]);
    }
}
