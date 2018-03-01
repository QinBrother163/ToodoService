<?php 
class payAuthReq { 
public $streamingNO; 
public $timeStamp; 
public $devType; 
public $devNO; 
public $catvID; 
public $spID; 
public $serviceID; 
public $payType; 
public $fixedFee; 
public $redirectURL; 
public $noticeAction; 
public $payBack; 
public $CARegionCode; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->timeStamp = $parmas['timeStamp'];
$this->devType = $parmas['devType'];
$this->devNO = $parmas['devNO'];
$this->catvID = $parmas['catvID'];
$this->spID = $parmas['spID'];
$this->serviceID = $parmas['serviceID'];
$this->payType = $parmas['payType'];
$this->fixedFee = $parmas['fixedFee'];
$this->redirectURL = $parmas['redirectURL'];
$this->noticeAction = $parmas['noticeAction'];
$this->payBack = $parmas['payBack'];
$this->CARegionCode = $parmas['CARegionCode'];
}
}
?>