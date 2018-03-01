<?php


$inputJson = array(
    'devno' => '8769002447248220',
    'type' => 1,
    'branchNO' => 'DG',
    'permark' => 1,
);

$clientId = "DDX01";
$clientPwd = "dc483e80a7a0bd9ef71d8cf973673924"; //旧版
//$clientPwd = "dJoDOvZQgnfmOu9jT0IXKn2c8iB2Chn7"; //新版

//        $clientId = 'UAPTEST';
//        $clientPwd = 'dbb9c38b04200dc69339e349446f7694';

$service_port = '36802'; //旧商
$address = '10.205.29.139';


//$service_port = '49999'; //新商
//$address = '10.205.22.153';
//$service_port = '39999'; //新测
//$address = '10.205.22.240';


function array2Xml($data, $xmlData)
{
    foreach ($data as $key => $value) {
        if (is_numeric($key)) {
            $key = 'item' . $key; //dealing with <0/>..<n/> issues
        }
        if (is_array($value)) {
            $subNode = $xmlData->addChild($key);
            array2Xml($value, $subNode);
        } else {
            $xmlData->addChild("$key", htmlspecialchars("$value"));
        }
    }
}


$code = 0;
$msg = '';

$socket = null;
try {
    if ($code == 0) {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
//                return "200-socket_create() failed";
            $code = 200;
        }
    }

    if ($code == 0) {
        $ret = socket_connect($socket, $address, $service_port);
        if ($ret === false) {
            $msg = "201-socket_connect() failed";
            $code = 201;
        }
    }

    if ($code == 0) {
        //! 消息体
        $data = array(
            'request' => array(
                'clientid' => $clientId,
                'clientpwd' => $clientPwd,
                'service' => 'UAP_queryUserInfo',
                'input' => $inputJson,
            )
        );

        $xmlData = new SimpleXMLElement('<root></root>');
        array2Xml($data, $xmlData);

        $body = $xmlData->children()->asXML();

        //! 消息头
        $headLength = 8;
        $inputLength = strlen($body) + $headLength;
        $head = (string)$inputLength;
        $num = strlen($head);
        for ($i = $num; $i < $headLength; $i++) {
            $head = "0" . $head;
        }

        $input = $head . $body;

        echo '-e request:   ' . $input;

        $ret = socket_write($socket, $input, strlen($input));
        if ($ret === false) {
            $msg = "202-socket_write() failed";
            $code = 202;
        }
    }

    if ($code == 0) {
        $output = '';
        while ($out = socket_read($socket, 8192)) {
            $output = $output . $out;
            if (strlen($out) < 8192) {
                break;
            }
        }

        $xmlData = substr($output, $headLength);
        $xml = simplexml_load_string($xmlData);

        echo '
        
-e response:   ' . $xml->asXML();

    }

} catch (Exception $exception) {
    $code = $exception->getCode();
    $msg = $exception->getMessage();

}

if ($socket) {
    socket_close($socket);
    $socket = null;
}

echo 'time:' . time() . '
';
echo 'code: ' . $code . ' msg: ' . $msg;
