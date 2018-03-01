<?php

namespace App\Toodo\Gdgd;


class FSDP2SP
{
    /**
     * 广电业务产品订购/退订通知
     * @param \App\Toodo\Gdgd\orderRelationSyncReq $orderRelationSyncReq
     * @return \App\Toodo\Gdgd\orderRelationSyncResp
     */
    function orderRelationSync($orderRelationSyncReq)
    {
        $req = $orderRelationSyncReq;

        $resp = new orderRelationSyncResp();
        $resp->servID = $req->servID;
        $resp->streamingNO = $req->streamingNO;

        /**
         * @region start ===============================================
         */
        if (!isset($req->streamingNO)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter streamingNO is required)';
            return $resp;
        }
        if (!isset($req->opType)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter opType is required)';
            return $resp;
        }
        if (!isset($req->customID)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter customID is required)';
            return $resp;
        }
        if (!isset($req->devType)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter devType is required)';
            return $resp;
        }
        if (!isset($req->devNO)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter devNO is required)';
            return $resp;
        }
        if (!isset($req->spID)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter spID is required)';
            return $resp;
        }
        if (!isset($req->serviceID)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter serviceID is required)';
            return $resp;
        }
        if (!isset($req->feeType)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter feeType is required)';
            return $resp;
        }
        if (!isset($req->fee)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter fee is required)';
            return $resp;
        }
        if (!isset($req->servID)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter servID is required)';
            return $resp;
        }
        if (!isset($req->deptid)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter deptid is required)';
            return $resp;
        }
        if (!isset($req->operateid)) {
            $resp->resultCode = 110;
            $resp->resultDesc = 'Invalid Input value(parameter operateid is required)';
            return $resp;
        }
        /**
         * @region end ===============================================
         */


        $resp->resultCode = 0;
        $resp->resultDesc = '成功';

        return $resp;
    }
}

class orderRelationSyncReq
{
    public $streamingNO;
    public $opType;
    public $customID;
    public $devType;
    public $devNO;
    public $catvID;
    public $spID;
    public $serviceID;
    public $feeType;
    public $fee;
    public $originalFee;
    public $amount;
    public $effectiveDate;
    public $expiryDate;
    public $servID;
    public $deptid;
    public $operateid;
    public $citycode;
}

class orderRelationSyncResp
{
    public $streamingNO;
    public $servID;
    public $resultCode;
    public $resultDesc;
}