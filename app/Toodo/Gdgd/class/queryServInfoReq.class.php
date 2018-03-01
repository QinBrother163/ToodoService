<?php 
class queryServInfoReq { 
public $keywordtype; 
public $quekeyword; 
public function __construct($parmas){
$this->keywordtype = $parmas['keywordtype'];
$this->quekeyword = $parmas['quekeyword'];
}
}
?>