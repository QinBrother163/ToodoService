<?php

namespace Tests\Feature;

use App\Toodo\Trade\TdoOrderData;
use App\Toodo\UserService;
use Tests\AppCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ToodoTradeTest extends AppCase
{
    use DatabaseTransactions;

    public function testTrade()
    {
        $this->toodo('/api/toodo/trade', '/toodo/trade');
    }

    public function testOrder()
    {
        $bizIn = [];
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/trade/order',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => ''
        ];
        $input['signCode'] = $this->signIn($input);

        // not set OrderIn param orderNo
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 1,
        ]);

        $orderNo = $this->serialNo();
        // not set OrderIn param userId
        $bizIn['orderNo'] = $orderNo;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 2,
        ]);

        // not set OrderIn param storeId
        $bizIn['userId'] = 5;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 3,
        ]);

        // not set OrderIn param storeName
        $bizIn['storeId'] = 1000;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 4,
        ]);
        // not set OrderIn param totalAmount
        $bizIn['storeName'] = '双动科技';
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 5,
        ]);
        // not set OrderIn param subject
        $bizIn['totalAmount'] = 360000;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 6,
        ]);
        // not set OrderIn param body
        $bizIn['subject'] = '体感游戏包年送体感手柄 快递包邮';
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 7,
        ]);
        // not set OrderIn param goodsDetail
        $bizIn['body'] = '最好玩的体验方式了。';
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 8,
        ]);

        // 输入商品详情
        $bizIn['goodsDetail'] = [
            ['goodsId' => '错误编号B001', 'goodsName' => '体感游戏包年送体感手柄', 'price' => 36001, 'quantity' => 1],
            ['goodsId' => '错误编号TD003', 'goodsName' => '快递包邮', 'price' => 0, 'quantity' => 1],
        ];
        // 输入可选参数
        $bizIn['extendParams'] = [
            'callbackUrl' => 'http://127.0.0.1/tdenter/index.html',
            'data' => '自定义数据，原样传回给callbackUrl'
        ];
        $bizIn['extUserInfo'] = ['name' => '张勋', 'phone' => '10086', 'address' => '地球村中国街道', 'postCode' => '000000'];

        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        // 没有授权码
        $response = $this->post('/api/toodo/trade', $input);
        $response->assertJson([
            'code' => 10005,
            'subCode' => 1,//1
        ]);

//        // 授权码无效
//        $response = $this->post('/api/toodo/trade?token=乱七八糟的', $input);
//        $response->assertJson([
//            'code' => 10005,
//            'subCode' => 2,//2
//        ]);

        // 请求授权码-------------------------------------------
        $this->token();
        //echo 'token:' . $this->token . "\n";

        $bizIn['userId'] = $this->userId;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        // 错误的商品编号
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 13,
        ]);

        // 错误的商品总价格
        $bizIn['goodsDetail'] = [
            ['goodsId' => 'TD010', 'goodsName' => '体感游戏包年送体感手柄', 'price' => 36000, 'quantity' => 1],
        ];
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 15,
        ]);

        // 正确的商品总价格
        $bizIn['totalAmount'] = 36000;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 0,
        ]);

        $output = json_decode($response->baseResponse->getContent());
        $bizOut = json_decode($output->bizContent);
        $this->assertAttributeSame($orderNo, 'orderNo', $bizOut);
        $tradeNo = $bizOut->tradeNo;

        // 重复订单号
        $bizIn['orderNo'] = $orderNo;
        $input['bizContent'] = json_encode($bizIn);
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 11007,
            'subCode' => 10,
        ]);


        //! 删除测试数据
        $order = TdoOrderData::find($tradeNo);
        $this->assertSame($orderNo, $order->orderNo);
        TdoOrderData::where('tradeNo', $tradeNo)->delete();
    }

    public function testPay()
    {
        $this->token();

        //! 生成订单
        $bizIn['orderNo'] = $this->serialNo();
        $bizIn['userId'] = $this->userId;
        $bizIn['storeId'] = 1000;
        $bizIn['storeName'] = '双动科技';
        $bizIn['totalAmount'] = 36000;
        $bizIn['subject'] = '体感游戏包年送体感手柄 快递包邮';
        $bizIn['body'] = '最好玩的体验方式了。';
        $bizIn['goodsDetail'] = [
            ['goodsId' => 'TD010', 'goodsName' => '体感游戏包年送体感手柄', 'price' => 36000, 'quantity' => 1],
        ];
        $bizIn['extendParams'] = [
            'callbackUrl' => 'http://127.0.0.1/tdenter/index.html',
            'data' => '自定义数据，原样传回给callbackUrl'
        ];
        $bizIn['extUserInfo'] = ['name' => '张勋', 'phone' => '10086', 'address' => '地球村中国街道', 'postCode' => '000000'];
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/trade/order',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => json_encode($bizIn),
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertJson([
            'code' => 0,
        ]);
        $output = json_decode($response->baseResponse->getContent());
        $bizOut = json_decode($output->bizContent);
        $tradeNo = $bizOut->tradeNo;

        //！请求在线支付
        $bizIn = [
            'tradeNo' => $tradeNo,
        ];
        $input = [
            'appId' => $this->appId,
            'method' => '/toodo/trade/pay',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizContent' => json_encode($bizIn),
        ];
        $input['signCode'] = $this->signIn($input);
        $response = $this->post('/api/toodo/trade?token=' . $this->token, $input);
        $response->assertStatus(302);

        $order = TdoOrderData::find($tradeNo);
        $response = $this->post('/api/toodo/gxgd/pay?orderId=' . $order->serialNo, []);
        //echo $response->baseResponse->content();
        $response->assertStatus(200);

        $input = [
            'retCode' => 'SUCCESS',
            'retMsg' => '调用成功',
            'orderId' => $order->serialNo,
            'handleTime' => date('Y-m-d H:i:s'),
            'totalFee' => '360.00',
            'partner' => '00',
            'stbId' => 'xxx',
            'productId' => 'xxx',
            'productName' => '测试产品',
            'sign' => 'xxx',
        ];
        $response = $this->post('/api/toodo/gxgd/onNotice', $input);
        //echo $response->baseResponse->content();
        $this->assertSame('success', $response->baseResponse->content());

        $response = $this->post('/api/toodo/gxgd/onCallback', $input);
        $response->assertRedirect();

        $order = TdoOrderData::find($tradeNo);
        $this->assertSame(2, $order->tradeStatus);
    }
}
