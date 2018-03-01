<?php

namespace App\Toodo\Gdgd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BossController extends Controller
{
    /**
     * 请求样例：
     * <request>
     * <clientid>UAPTEST</clientid>
     * <clientpwd>dbb9c38b04200dc69339e349446f7694</clientpwd>
     * <service>UAP_queryGDUserInfo</service>
     * <input>
     * <type>1</type>
     * <devNo>8769002447248220</devNo>
     * <city>DG</city>
     * </input>
     * </request>
     * 返回样例：
     * <response>
     * <status>0000</status>
     * <message>成功</message>
     * <output>
     * <custid>12085</custid>
     * <servid>763028</servid>
     * <addr>广东省东莞市莞城区1区1区红荔路富*******号#</addr>
     * <servStatus>2</servStatus>
     * <userName>xxx</userName>
     * <phoneNumber>15744444444</phoneNumber>
     * <devType>0</devType>
     * <devNo>8769002447248220</devNo>
     * <catvid>15744444444</catvid>
     * <catvPassword>e10adc3949ba59abbe56e057f20f883e</catvPassword>
     * <areaid>204</areaid>
     * <city>DG</city>
     * <isBindBank>Y</isBindBank>
     * <custType>0</custType>
     * <isInArr>N</isInArr>
     * <isActive>Y</isActive>
     * <userPayType>0</userPayType>
     * <devNetType>1</devNetType>
     * <isBaseArr>N</isBaseArr>
     * <type>0</type>
     * <uapUserId>259</uapUserId>
     * </output>
     * </response>
     */
    public function queryUserInfo(Request $request)
    {
        $clientId = "DDX01";
//        $clientPwd = "dc483e80a7a0bd9ef71d8cf973673924";
        $clientPwd = "dJoDOvZQgnfmOu9jT0IXKn2c8iB2Chn7";

//        $clientId = 'UAPTEST';
//        $clientPwd = 'dbb9c38b04200dc69339e349446f7694';

//        $service_port = 36802;
//        $address = '10.205.29.139';
        $service_port = 49999;
        $address = '10.205.22.153';

        $code = 0;
        $msg = '';

        $socket = null;
        $response = null;
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
//                return "201-socket_connect() failed";
                    $code = 201;
                }
            }

            if ($code == 0) {
                //! 消息体
                $data = [
                    'request' => [
                        'clientid' => $clientId,
                        'clientpwd' => $clientPwd,
                        'service' => 'UAP_queryUserInfo',
                        'input' => $request->all(),
                    ]
                ];
                $xmlData = new \SimpleXMLElement('<root></root>');
                $this->array2Xml($data, $xmlData);

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

                $ret = socket_write($socket, $input, strlen($input));
                if ($ret === false) {
//                return "201-socket_connect() failed";
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

                $json = json_encode($xml);
                $response = json_decode($json, TRUE);
//                $response = $xmlData;
            }

        } catch (\ErrorException $exception) {
            $code = 500;
            $msg = get_object_vars($exception);

        } finally {
            if ($socket) {
                socket_close($socket);
            }
        }

        if ($code != 0) {
            return [
                'code' => $code,
                'msg' => $msg,
            ];
        }
        return $response;
    }

    function array2Xml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key; //dealing with <0/>..<n/> issues
            }
            if (is_array($value)) {
                $subNode = $xmlData->addChild($key);
                $this->array2Xml($value, $subNode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}
