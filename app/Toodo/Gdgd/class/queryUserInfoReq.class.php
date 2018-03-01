<?php 
class queryUserInfoReq { 
public $streamingNO; 
public $timeStamp; 
public $devNO; 
public $CARegionCode; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->timeStamp = $parmas['timeStamp'];
$this->devNO = $parmas['devNO'];
$this->CARegionCode = $parmas['CARegionCode'];
}
}
?>