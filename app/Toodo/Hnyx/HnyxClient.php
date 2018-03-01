<?php

namespace App\Toodo\Hnyx;

use SoapClient;
use SoapFault;


class HnyxClient
{
    /**
     * @param $wsdl
     * @return SoapClient
     */
    protected function soapClient($wsdl)
    {
        $options = [
            'soap_version' => SOAP_1_1,
            'trace' => true,
            'exceptions' => false,
            'encoding' => 'UTF-8',
        ];
        $client = new SoapClient($wsdl, $options);
        return $client;
    }

    protected function soapResult($result)
    {
        return get_object_vars($result);
    }

    public function payByQrCode($inputBody)
    {
        $wsdl = 'http://172.30.40.70:8181/roma.out/cxf/payByQrCode?wsdl';
        $client = $this->soapClient($wsdl);
        //\Log::debug('-e func:', $client->__getFunctions());
        //\Log::debug('-e type:', $client->__getTypes());

        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Root></Root>');
        foreach ($inputBody as $key => $val) {
            $xml->addChild($key, $val);
        }
        $xml = $xml->asXML();
        \Log::debug('-e payByQrCode input:' . $xml);

        $result = $client->payByQrCodeSync(['xmlContent' => $xml]);
        if ($result instanceof SoapFault) {
            return false;
        }
        $xml = $result->return;
        \Log::debug('-e payByQrCode output:' . $xml);

        $xml = simplexml_load_string($xml);
        $result = json_decode(json_encode($xml), true);
        return $result;
    }

    public function queryPayResult($inputBody)
    {
        $wsdl = 'http://172.30.40.70:8181/roma.out/cxf/queryPayResult?wsdl';
        $client = $this->soapClient($wsdl);
        //\Log::debug('-e func:', $client->__getFunctions());
        //\Log::debug('-e type:', $client->__getTypes());

        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Root></Root>');
        foreach ($inputBody as $key => $val) {
            $xml->addChild($key, $val);
        }
        $xml = $xml->asXML();
//        \Log::debug('-e queryPayResult input:' . $xml);

        $result = $client->queryPayResultSync(['xmlContent' => $xml]);
        if ($result instanceof SoapFault) {
            return false;
        }
        $xml = $result->return;
//        \Log::debug('-e queryPayResult output:' . $xml);

        $xml = simplexml_load_string($xml);
        $result = json_decode(json_encode($xml), true);
        return $result;
    }
}