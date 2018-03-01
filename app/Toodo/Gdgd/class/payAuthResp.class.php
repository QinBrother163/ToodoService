<?php 
class payAuthResp { 
public $streamingNO; 
public $servID; 
public $resultCode; 
public $resultDesc; 
public $orderID; 
public $needCnfm; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->servID = $parmas['servID'];
$this->resultCode = $parmas['resultCode'];
$this->resultDesc = $parmas['resultDesc'];
$this->orderID = $parmas['orderID'];
$this->needCnfm = $parmas['needCnfm'];
}
}
?>