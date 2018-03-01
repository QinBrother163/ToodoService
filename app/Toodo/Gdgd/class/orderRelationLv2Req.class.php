<?php 
class orderRelationLv2Req { 
public $streamingNO; 
public $opType; 
public $devType; 
public $devNO; 
public $catvID; 
public $spID; 
public $serviceID; 
public $effectiveDate; 
public $expiryDate; 
public $CARegionCode; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->opType = $parmas['opType'];
$this->devType = $parmas['devType'];
$this->devNO = $parmas['devNO'];
$this->catvID = $parmas['catvID'];
$this->spID = $parmas['spID'];
$this->serviceID = $parmas['serviceID'];
$this->effectiveDate = $parmas['effectiveDate'];
$this->expiryDate = $parmas['expiryDate'];
$this->CARegionCode = $parmas['CARegionCode'];
}
}
?>