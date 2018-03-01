<?php 
class orderRelationAffirmReq { 
public $streamingNO; 
public $orderID; 
public $payWay; 
public $bankAccNO; 
public $payReqID; 
public $payCode; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->orderID = $parmas['orderID'];
$this->payWay = $parmas['payWay'];
$this->bankAccNO = $parmas['bankAccNO'];
$this->payReqID = $parmas['payReqID'];
$this->payCode = $parmas['payCode'];
}
}
?>