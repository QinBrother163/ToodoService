<?php

namespace Tests\Feature;

use Tests\AppCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ToodoServeTest extends AppCase
{
    public function testQuery()
    {
        $this->token();

        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/serve/query',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => '',
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/serve?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 0,
        ]);
        //echo $response->baseResponse->content();
    }
}
