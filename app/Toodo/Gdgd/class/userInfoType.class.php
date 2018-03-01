<?php 
class userInfoType { 
public $streamingNO; 
public $resultCode; 
public $custid; 
public $servID; 
public $servstatus; 
public $stoplock; 
public $userName; 
public $devNO; 
public $catvID; 
public $areaid; 
public $branchno; 
public $custtype; 
public $isinarr; 
public $resultDesc; 
public function __construct($parmas){
$this->streamingNO = $parmas['streamingNO'];
$this->resultCode = $parmas['resultCode'];
$this->custid = $parmas['custid'];
$this->servID = $parmas['servID'];
$this->servstatus = $parmas['servstatus'];
$this->stoplock = $parmas['stoplock'];
$this->userName = $parmas['userName'];
$this->devNO = $parmas['devNO'];
$this->catvID = $parmas['catvID'];
$this->areaid = $parmas['areaid'];
$this->branchno = $parmas['branchno'];
$this->custtype = $parmas['custtype'];
$this->isinarr = $parmas['isinarr'];
$this->resultDesc = $parmas['resultDesc'];
}
}
?>