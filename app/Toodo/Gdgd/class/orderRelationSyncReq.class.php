<?php

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

    public function __construct($parmas)
    {
        $this->streamingNO = $parmas['streamingNO'];
        $this->opType = $parmas['opType'];
        $this->customID = $parmas['customID'];
        $this->devType = $parmas['devType'];
        $this->devNO = $parmas['devNO'];
        $this->catvID = $parmas['catvID'];
        $this->spID = $parmas['spID'];
        $this->serviceID = $parmas['serviceID'];
        $this->feeType = $parmas['feeType'];
        $this->fee = $parmas['fee'];
        $this->originalFee = $parmas['originalFee'];
        $this->amount = $parmas['amount'];
        $this->effectiveDate = $parmas['effectiveDate'];
        $this->expiryDate = $parmas['expiryDate'];
        $this->servID = $parmas['servID'];
        $this->deptid = $parmas['deptid'];
        $this->operateid = $parmas['operateid'];
        $this->citycode = $parmas['citycode'];
    }
}
