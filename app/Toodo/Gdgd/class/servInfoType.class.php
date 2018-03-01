<?php 
class servInfoType { 
public $custid; 
public $servid; 
public $addr; 
public $servstatus; 
public $stoplock; 
public function __construct($parmas){
$this->custid = $parmas['custid'];
$this->servid = $parmas['servid'];
$this->addr = $parmas['addr'];
$this->servstatus = $parmas['servstatus'];
$this->stoplock = $parmas['stoplock'];
}
}
?>