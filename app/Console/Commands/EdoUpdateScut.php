<?php

namespace App\Console\Commands;

use App\Toodo\Edo\EdoBizService;
use App\Toodo\Edo\EdoUser;
use App\Toodo\Market\TdoGoodsInfo;
use App\Toodo\Trade\TdoOrderData;
use App\Toodo\Trade\Trader;
use App\Toodo\UserService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;

class EdoUpdateScut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edo:scut {func=null} {args=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '升级scut服务器';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ts = time();

        $func = $this->argument('func');
        switch ($func) {
            case 'user'://更新用户
                $userId = 1380000;
                $perPage = 100;

                $db = \DB::connection('mysql.scut');
                $clt = $db->table('snsuserinfo')->where('UserId', '>=', $userId);

                $page = 1;
                do {
                    $paginate = $clt->paginate($perPage, ['*'], 'page', $page);
                    $users = $paginate->items();
                    $cnt = $paginate->firstItem();
                    foreach ($users as $user) {
                        $this->syncUser($db, $user, $cnt);
                        $cnt++;
                    }
                    if ($paginate->currentPage() == $paginate->lastPage()) $page = 0;
                    else $page++;
                    echo sprintf('-e user %s/%s', $paginate->currentPage(), $paginate->lastPage()) . "\n";

                } while ($page);
                $db->disconnect();
                break;
            case 'order'://更新订单
                $orderNo = '20170701';
                $perPage = 100;

                $db = \DB::connection('mysql.scut');
                $clt = $db->table('orderdata')
                    ->where('PayStatus', 5)
                    ->where('OrderNo', '>', $orderNo);

                $page = 1;
                do {
                    $paginate = $clt->paginate($perPage, ['*'], 'page', $page);
                    $orders = $paginate->items();
                    $cnt = $paginate->firstItem();
                    foreach ($orders as $order) {
                        $this->syncOrder($db, $order, $cnt);
                        $cnt++;
                    }
                    if ($paginate->currentPage() == $paginate->lastPage()) $page = 0;
                    else $page++;
                    echo sprintf('-e order %s/%s', $paginate->currentPage(), $paginate->lastPage()) . "\n";
                    //echo json_encode($paginate, JSON_PRETTY_PRINT) . "\n";
                } while ($page);
                $db->disconnect();
                break;
            case 'notify':
                $this->readNotify();
                break;
            default:
                echo '-e empty func';
                break;
        }

        echo sprintf('-e func=%s use time %ds', $func, time() - $ts);
        return 0;
    }

    /**
     * @param $db Connection
     * @param $user1
     * @param $cnt
     */
    protected function syncUser($db, $user1, $cnt)
    {
        //        echo $cnt
        //            . "\t" . $user1->UserId
        //            . "\t" . $user1->PassportID
        //            . "\t" . $user1->RegTime
        //            //. "\t" . $user->DeviceID
        //            . "\t" . substr($user1->DeviceID, 6)
        //            . "\n";

        //多次读表浪费时间
        //$user2 = $db->table('edouser')->where('UserId', $user1->UserId)->first();
        //        echo $cnt
        //            . "\t" . $user2->UserId
        //            //. "\t" . iconv("UTF-8", "GB2312//IGNORE", $user2->NickName)
        //            . "\t" . iconv("UTF-8", "gbk//IGNORE", $user2->NickName)
        //            . "\t" . $user2->PassportId
        //            . "\t" . $user2->RetailId
        //            . "\t" . $user2->buyHand
        //            . "\t" . $user2->vipGrade
        //            //. "\t" . $user2->Items
        //            . "\n\n";

        $retailId = substr($user1->DeviceID, 0, 5);
        $cardTV = substr($user1->DeviceID, 6);

        $findPos = strrpos($cardTV, "_");
        $regionCode = !$findPos ? '0' : substr($cardTV, $findPos + 1);

        /** @var UserService $userSrv */
        $userSrv = app(UserService::class);
        $result = $userSrv->getOrLogin(null, $retailId, $regionCode, $cardTV);
        /** @var User $user */
        $user = $result['user'];

        $user->created_at = $user1->RegTime;
        $user->save();

        /** @var EdoBizService $edoBiz */
        $edoBiz = app(EdoBizService::class);
        /** @var EdoUser $edoUser */
        $edoUser = $edoBiz->search($user, false);

        $edoUser->created_at = $user1->RegTime;
        $edoUser->passportId = $user1->UserId;
        $edoUser->save();
    }

    protected $prodIds = [
        '10001' => 24,//TD024	钻石套餐
        '10002' => 23,//TD023	黄金套餐
        '10003' => 21,//TD021	套餐一
        '10004' => 22,//TD022	套餐二
        '20001' => 20,//TD020	包月
    ];

    protected function syncOrder($db, $order, $cnt)
    {
        //        echo $cnt
        //            . "\t" . $order->OrderNo
        //            . "\t" . intval($order->Amount)
        //            . "\t" . $order->PayStatus
        //            . "\t" . $order->UserId
        //            . "\t" . $order->PassportId
        //            . "\t" . $order->CreateDate
        //            . "\t" . $order->SerialNumber
        //            . "\t" . iconv("UTF-8", "gbk//IGNORE", $order->Signature)
        //            . "\n";

        $tradeNo = $order->OrderNo;
        $tdoOrder = TdoOrderData::find($tradeNo);
        if (!empty($tdoOrder)) {
            echo '-e exist order ' . $tradeNo . "\n";
            return;
        }

        /** @var EdoUser $edoUser */
        $edoUser = EdoUser::where('passportId', $order->UserId)->first();
        if (empty($edoUser)) {
            echo '-e empty user ' . $order->UserId . "\n";
            return;
        }

        //$json = iconv("UTF-8", "GBK//IGNORE", $order->Signature);
        $json = $order->Signature;
        $prods = json_decode($json, true);//不可以转换字符编码
        //echo count($prods);
        if (empty($prods)) {
            echo '-e empty prods ' . $json . "\n";
            return;
        }

        $prod = (object)$prods[0];
        $productId = $this->prodIds[$prod->id];
        $goods = TdoGoodsInfo::find($productId);
        if (empty($goods)) {
            echo '-e not found goods ' . $productId . "\n";
            return;
        }

        //创建订单
        $tdoOrder = new TdoOrderData();
        $tdoOrder->fill([
            'tradeNo' => $tradeNo,
            'retailId' => $edoUser->retailId,
            'orderNo' => $tradeNo,
            'userId' => $edoUser->userId,
            'storeId' => $goods->storeId,
            'storeName' => $goods->storeName,
            'totalAmount' => $goods->price,
            'subject' => $goods->goodsName,
            'body' => $goods->goodsDesc,
            'goodsDetail' => json_encode([
                [
                    'goodsId' => $goods->goodsId,
                    'goodsName' => $goods->goodsName,
                    'price' => $goods->price,
                    'quantity' => 1
                ],
            ]),
            //'extendParams' => json_encode($extendParams),
            //'extUserInfo' => json_encode($userInfo),
            'payTimeout' => date('Y-m-d H:i:s', strtotime("$order->CreateDate +1 day")),
            'tradeStatus' => 0,
            'serialNo' => $order->SerialNumber,
        ]);
        if (!empty($order->DeviceId)) {
            $tdoOrder->extUserInfo = json_encode([
                'phone' => $order->DeviceId,
            ]);
        }
        $tdoOrder->created_at = $order->CreateDate;
        $tdoOrder->save();

        //激活有效订单
        /** @var Trader $trader */
        $trader = app(Trader::class);
        $trader->grabOrder($order->OrderNo, false);
    }

    protected function readNotify()
    {
        //退订通知
        /** @var Trader $trader */
        $trader = app(Trader::class);

        $path = public_path('notify.txt');
        $file = fopen($path, "r") or die("Unable to open file!");

        $cnt = 0;
        // 输出单行直到 end-of-file
        while (!feof($file)) {
            $line = fgets($file);

            if (empty($line)) continue;
            if (!str_contains($line, 'POST request:')) continue;

            $json = strstr($line, '{"');

            $obj = json_decode($json);
            $cnt++;
            //{"contentId":"","extendInfo":"","notificationURL":"http://202.99.114.74:56307/union/unsubNotify/201710071421470000023954","operateType":"0","productId":"sdtgjsfby025@204","serviceId":"","transactionId":"201710071421470000023954","userId":"398791828260200360_204"}

            //            echo $cnt
            //                . "\t" . $obj->transactionId
            //                . "\t" . $obj->productId
            //                . "\t" . $obj->userId
            //                . "\n";
            $trader->dropOrder($obj->transactionId);
        }
        echo "-e notify $cnt lines\n";
        fclose($file);
    }
}
