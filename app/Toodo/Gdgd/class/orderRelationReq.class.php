<?php

class orderRelationReq
{
    public $streamingNO;
    public $opType;
    public $customID;
    public $spID;
    public $devType;
    public $devNO;
    public $serviceID;
    public $unit;
    public $count;
    public $catvID;
    public $effectiveDate;
    public $expiryDate;
    public $CARegionCode;

    public function __construct($parmas)
    {
        $this->streamingNO = $parmas['streamingNO'];
        $this->opType = $parmas['opType'];
        $this->customID = $parmas['customID'];
        $this->spID = $parmas['spID'];
        $this->devType = $parmas['devType'];
        $this->devNO = $parmas['devNO'];
        $this->serviceID = $parmas['serviceID'];
        $this->unit = $parmas['unit'];
        $this->count = $parmas['count'];
        $this->catvID = $parmas['catvID'];
        $this->effectiveDate = $parmas['effectiveDate'];
        $this->expiryDate = $parmas['expiryDate'];
        $this->CARegionCode = $parmas['CARegionCode'];
    }
}

?>