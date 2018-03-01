<?php 
class orderRelationResp { 
public $streamingNO; 
public $resultCode; 
public $resultDesc; 
public $orderID; 
public $orderType; 
public $feeName; 
public $sums; 
public $needCnfm; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->resultCode = $parmas['resultCode'];
$this->resultDesc = $parmas['resultDesc'];
$this->orderID = $parmas['orderID'];
$this->orderType = $parmas['orderType'];
$this->feeName = $parmas['feeName'];
$this->sums = $parmas['sums'];
$this->needCnfm = $parmas['needCnfm'];
}
}
?>