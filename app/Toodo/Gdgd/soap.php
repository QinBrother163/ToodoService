<?php

ini_set('date.timezone', 'Asia/Shanghai');

$tns = 'http://sp.fsdp.zte.com.cn';

//echo 'no wsdl';
{
    $client = new SoapClient(NULL, [
        'location' => 'http://103.27.24.122:9007/services/sp',
        'uri' => $tns,
        'trace' => true,
        'style' => SOAP_DOCUMENT,
    ]);

    $paras = array(
        'streamingNO' => '20170321144840134444',
        'timeStamp' => '20170321144851',
        'devType' => '1',
        'devNO' => '8002003224584594',
        'spID' => '14',
        'serviceID' => '00000000Sp-C003',
    );

    try {
        //!         'style' => SOAP_RPC,
//        $result = $client->payAuthReq(
//            new SoapParam('20170321144840134444', 'ns1:streamingNO')
//        );

//        $result = $client->__soapCall(
//            'payAuthReq',
//            [new SoapParam('20170321144840134444', 'ns1:streamingNO')]
//        );

        //!         'style' => SOAP_DOCUMENT,
        $args = array();
        $args[] = new SoapVar('20170321144840134444', XSD_STRING, null, null, 'streamingNO', $tns);
        $args[] = new SoapVar('20170321144851', XSD_STRING, null, null, 'timeStamp', $tns);
        $payAuthReq = new SoapVar($args, SOAP_ENC_OBJECT, null, null, 'payAuthReq', $tns);

//        $result = $client->__soapCall(
//            'function name can every thing',//! 函数名无效
//            [new SoapParam($payAuthReq, 'payAuthReq222')] //!SoapVar的命名会覆盖此处
//        );

//        $result = $client->__soapCall(
//            'payAuth',//! 函数名无效
//            [$payAuthReq]
//        );

        $result = $client->什么函数名都可以($payAuthReq);

        echo '成功：';
        var_dump($result);

    } catch (SoapFault $exception) {
        var_dump($exception);
    }
}

//echo 'with wsdl';
//{
//    $client = new SoapClient('soap/SpService.wsdl', [
//        'trace' => true,
//    ]);
//
//    $paras = array(
//        'streamingNO' => '20170321144840134444',
//        'timeStamp' => '20170321144851',
//        'devType' => '1',
//        'devNO' => '8002003224584594',
//        'spID' => '14',
//        'serviceID' => '00000000Sp-C003',
//    );
//    $result = $client->__soapCall('payAuth', ['payAuthReq' => $paras]);
//
//    var_dump($result);
//}