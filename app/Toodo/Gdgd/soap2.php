<?php

ini_set('date.timezone', 'Asia/Shanghai');


////echo 'no wsdl';
//{
//    $tns = 'http://sp.fsdp.zte.com.cn';
//    $client = new SoapClient(NULL, [
//        'location' => 'http://127.0.0.1:8000/api/fsdp',
//        'uri' => $tns,
//        'trace' => true,
//        'style' => SOAP_DOCUMENT,
//    ]);
//
//    try {
//        //!         'style' => SOAP_DOCUMENT,
//        $args = array();
//        $args[] = new SoapVar('20170321144840134444', XSD_STRING, null, null, 'streamingNO', $tns);
//        $args[] = new SoapVar('20170321144851', XSD_STRING, null, null, 'timeStamp', $tns);
//        //        'streamingNO' => '20170321144840134444',
////        'opType' => '1',
////        'customID' => 'xxx',
////        'devType' => '1',
////        'devNO' => '8002003224584594',
////        'catvID' => '',
////        'spID' => '14',
////        'serviceID' => '00000000Sp-C003',
////        'feeType' => '1',
////        'fee' => '500',
////        'originalFee' => '500',
////        'amount' => '1',
////        'effectiveDate'=>'20170321',
////        'expiryDate'=>'20170321',
////        'servID'=>'10086',
////        'deptid'=>'10086',
////        'operateid'=>'1',
////        'citycode'=>'10086',
//
//        $orderRelationSyncReq = new SoapVar($args, SOAP_ENC_OBJECT, null, null, 'orderRelationSyncReq', $tns);
//
////        $result = $client->__soapCall(
////            'function name can every thing',//! 函数名无效
////            [new SoapParam($payAuthReq, 'payAuthReq222')] //!SoapVar的命名会覆盖此处
////        );
//
////        $result = $client->__soapCall(
////            'payAuth',//! 函数名无效
////            [$payAuthReq]
////        );
//
//        $result = $client->orderRelationSync($orderRelationSyncReq);
//
//        echo '成功：';
//        var_dump($result);
//
//    } catch (SoapFault $exception) {
//        var_dump($exception);
//    }
//}


//echo 'with wsdl';
{
    $client = new SoapClient('../../public/soap/SpService.wsdl', [
        'trace' => true, //! for call getFunctions getTypes
    ]);

    $paras = array(
        'streamingNO' => '20170321144840134444',
        'opType' => '1',
        'customID' => 'xxx',
        'devType' => '1',
        'devNO' => '8002003224584594',
        'catvID' => '',
        'spID' => '14',
        'serviceID' => '00000000Sp-C003',
        'feeType' => '1',
        'fee' => '500',
        'originalFee' => '500',
        'amount' => '1',
        'effectiveDate'=>'20170321',
        'expiryDate'=>'20170321',
        'servID'=>'10086',
        'deptid'=>'10086',
        'operateid'=>'1',
        'citycode'=>'10086',
    );

    try {
        $result = $client->__soapCall('orderRelationSync', ['orderRelationSyncReq' => $paras]);

        var_dump($result);

    } catch (SoapFault $exception) {
        var_dump($exception);
    }
}