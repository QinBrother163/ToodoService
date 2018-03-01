<?php

namespace App\Toodo\Gdgd;

use App\Toodo\Trade\BasePayment;
use App\User;

class GdgdPayment extends BasePayment
{
    protected $childLockUrl = 'http://172.16.145.197:8080/sdpportal/childLockAction_childlock.action';
    protected $feePayUrl = 'http://172.16.145.197:8080/sdpportal/feePayAction_feePay.action';

    /**
     * @var FsdpClient
     */
    protected $fsdp;

    public function __construct()
    {
        parent::__construct();
        $this->fsdp = app(FsdpClient::class);
    }

    public function signCode($inputBody)
    {
        return '';
    }

    public function createOrder($inputBody)
    {
        $user = User::find($inputBody->userId);

        $bizIn = [
            'streamingNO' => $inputBody['tradeNo'],
            'timeStamp' => date('YmdHis'),
            'devNO' => $user->cardTV,
            'CARegionCode' => $user->regionCode,
        ];
        $bizOut = $this->fsdp->queryUserInfo($bizIn);
        if (empty($bizOut['resultCode'])) {
            return [
                'subCode' => 1,
                'subMsg' => '调用queryUserInfo失败',
            ];
        }
        if ($bizOut['resultCode'] != 0) {
            return [
                'subCode' => $bizOut['resultCode'],
                'subMsg' => $bizOut['resultDesc'],
            ];
        }
        if ($bizOut['servstatus'] != 2) {
            return [
                'subCode' => 2,
                'subMsg' => '账号非正常使用状态 status:' . $bizOut['servstatus'],
            ];
        }
        if ($bizOut['custtype'] != 0) {
            return [
                'subCode' => 4,
                'subMsg' => '账号非个人客户 type:' . $bizOut['custtype'],
            ];
        }

        $bizIn = [
            'streamingNO' => $inputBody['tradeNo'],
            'timeStamp' => date('YmdHis'),
            'devType' => 1,
            'devNO' => '',
            'catvID' => '',
            'spID' => 14,
            'serviceID' => '00000000Sp-C003',
            'payType' => 1,
            'fixedFee' => '',
            'redirectURL' => '',
            'noticeAction' => '',
            'payBack' => '',
            'CARegionCode' => '',
        ];
        /**
         * {
         *   "streamingNO": "20170321144840134444",
         *   "servID": "3602023112",
         *   "resultCode": "0",
         *   "orderID": "20170506084716100028068",
         *   "needCnfm": "1"
         * }
         */
        $bizOut = $this->fsdp->payAuth($bizIn);
        if (empty($bizOut['resultCode'])) {
            return [
                'subCode' => 3,
                'subMsg' => '调用payAuth失败',
            ];
        }
        if ($bizOut['resultCode'] != 0) {
            return [
                'subCode' => $bizOut['resultCode'],
                'subMsg' => $bizOut['resultDesc'],
            ];
        }
        return [
            'subCode' => 0,
            'biz' => $bizOut,
            'serialNo' => $bizOut['orderID'],
        ];
    }

    public function payOnline($bizOrder)
    {
        $extendParams = json_decode($bizOrder->extendParams);
        $biz = $extendParams->biz;

        if (1) {
            return $this->submit($this->childLockUrl,[
                'orderid' => '',
                'customID' => '',
                'spid' => '',
                'devType' => '',
                'devNo' => '',
                'CARegionCode' => '',
                'serviceid' => '',
                'returl' => url('/api/toodo/gdgd/onConfirm'),
                'retData' => '',
            ]);
        }

        if (2) {
            return $this->submit($this->feePayUrl,[
                'orderid' => '',
                'customID' => '',
                'spid' => '',
                'devType' => '',
                'devNo' => '',
                'CARegionCode' => '',
                'serviceid' => '',
                'ServiceName' => '',
                'Fee' => '',
                'returl' => url('/api/toodo/gdgd/onCallback'),
                'retData' => '',
            ]);
        }

        return $this->submit($this->feePayUrl,[
            'orderid' => '',
            'customID' => '',
            'spid' => '',
            'devType' => '',
            'devNo' => '',
            'CARegionCode' => '',
            'serviceid' => '',
            'ServiceName' => '',
            'Fee' => '',
            'returl' => '',
            'retData' => '',
        ]);
    }

    public function onConfirm($inputBody)
    {
        if (2) {
            return $this->submit($this->feePayUrl,[
                'orderid' => '',
                'customID' => '',
                'spid' => '',
                'devType' => '',
                'devNo' => '',
                'CARegionCode' => '',
                'serviceid' => '',
                'ServiceName' => '',
                'Fee' => '',
                'returl' => url('/api/toodo/gdgd/onCallback'),
                'retData' => '',
            ]);
        }
    }

    public function onCallback($inputBody)
    {
        $code = 1;
        $serialNo = '';
        if ($inputBody->retCode == 'SUCCESS') {
            $serialNo = $inputBody->orderId;
            $code = 0;
        }

        $resp = [
            'code' => $code,
            'serialNo' => $serialNo,
        ];
        return $this->trader->onCallback($resp);
    }

    public function onNotice($inputBody)
    {
        $code = 1;
        $serialNo = '';
        if ($inputBody->retCode == 'SUCCESS') {
            $serialNo = $inputBody->orderId;
            $code = 0;
        }

        $resp = [
            'code' => $code,
            'serialNo' => $serialNo,
        ];

        $resp = $this->trader->onNotice($resp);
        if ($resp) return 'success';
        return 'failure';
    }

}