<?php

include('soap_code_create.php');


$gen = new soap_code_create('../soap/SpService.wsdl','class','');
$gen->create_base_class();