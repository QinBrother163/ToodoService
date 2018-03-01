<?php

namespace App\Toodo\Gdgd;

use Illuminate\Http\Request;
use SoapClient;
use SoapServer;

class FsdpClient
{
    protected $client;
    protected $server;

    public function __construct()
    {
        $options = [
            'soap_version' => SOAP_1_1,
            'trace' => true,
            'exceptions' => false,
            'encoding' => 'UTF-8',
        ];
        $client = new SoapClient(public_path('soap/SpService.wsdl'), $options);

        $options = [
            'soap_version' => SOAP_1_1,
            'encoding' => 'UTF-8',
        ];
        $server = new SoapServer(public_path('soap/SpService.wsdl'), $options);
        $server->setClass(FSDP2SP::class);

        $this->client = $client;
        $this->server = $server;
    }

    protected function soapResult($result)
    {
        return get_object_vars($result);
    }

    public function orderRelation($inputBody)
    {
        $result = $this->client->__soapCall('orderRelation', ['orderRelationReq' => $inputBody]);
        return $this->soapResult($result);
    }

    public function orderRelationAffirm($inputBody)
    {
        $result = $this->client->__soapCall('orderRelationAffirm', ['orderRelationAffirmReq' => $inputBody]);
        return $this->soapResult($result);
    }

    public function orderRelationLv2($inputBody)
    {
        $result = $this->client->__soapCall('orderRelationLv2', ['orderRelationLv2Req' => $inputBody]);
        return $this->soapResult($result);
    }

    public function payAuth($inputBody)
    {
        $result = $this->client->__soapCall('payAuth', ['payAuthReq' => $inputBody]);
        return $this->soapResult($result);
    }

    public function queryServInfo($inputBody)
    {
        $result = $this->client->__soapCall('queryServInfo', ['queryServInfoReq' => $inputBody]);
        return $this->soapResult($result);
    }

    /*
       {
         "resultInfo": {
           "streamingNO": "20170321144851000000",
           "resultCode": "0",
           "custid": "3601433732",
           "servID": "3602023112",
           "servstatus": "2",
           "stoplock": "1",
           "userName": "演播厅728",
           "devNO": "8002003224584594",
           "catvID": "13570934943",
           "areaid": "100",
           "branchno": "GZ",
           "custtype": "0",
           "isinarr": "N",
           "resultDesc": "成功"
         }
       }
     */
    public function queryUserInfo($inputBody)
    {
        $result = $this->client->__soapCall('queryUserInfo', ['queryUserInfoReq' => $inputBody]);
        return $this->soapResult($result);
    }

    public function fsdp(Request $request)
    {
        if ($request->isMethod('GET')) {
            return 'nothing to show!';
        }

        ob_start();
        $this->server->handle($request->getContent());
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}