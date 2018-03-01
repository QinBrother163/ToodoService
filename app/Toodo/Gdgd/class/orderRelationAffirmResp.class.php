<?php 
class orderRelationAffirmResp { 
public $streamingNO; 
public $servID; 
public $resultCode; 
public $resultDesc; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->servID = $parmas['servID'];
$this->resultCode = $parmas['resultCode'];
$this->resultDesc = $parmas['resultDesc'];
}
}
?>