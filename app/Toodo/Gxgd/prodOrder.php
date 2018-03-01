<?php

$appKey = '1000000018';
$appSecret = '43da9ccafc9cc8f07f3db95801345183';

/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $data post键值对数据
 * @return string
 */
function sendPost($url, $data)
{
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data),
            'timeout' => 30 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    return $result;
}

function sendGet($url)
{
    $options = array(
        'http' => array(
            'method' => 'GET',
            'timeout' => 30 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    return $result;
}

function signCode($inputBody, $secret)
{
    ksort($inputBody);
    $args = http_build_query($inputBody);
    $md5 = md5(urldecode($args) . $secret);
    return $md5;
}

$biz = [
    'method' => 'prodOrder',
    'productId' => '404550070043',
    'productName' => '广电测试包月产品',
    'productDesc' => '产品描述',
    'tariffId' => '302771',
    'qty' => 1,
    'userId' => '108767787',
    'stbId' => '1140150003308',
    'areaCode' => '',
    'partner' => $appKey,
    'callbackUrl' => 'http://10.0.4.108/tdsrv/api/toodo/gxgd/onCallback',
    'noticeUrl' => 'http://10.0.4.108/tdsrv/api/toodo/gxgd/onNotice',
    'appIndexUrl' => 'http://10.0.4.108/tdenter/index.html',
    'unitPrice' => 1000 / 100,
    'isHD' => '720P',
];
$biz['sign'] = signCode($biz, $appSecret);
$args = http_build_query($biz);
//$resp = sendGet('http://10.0.11.40/web-lezboss-test/service?' . $args);
$resp = sendGet('http://10.0.11.38/web-lezboss/service?' . $args);

$xml = simplexml_load_string($resp);
$json = json_decode(json_encode($xml), true);

if ($json['isSuccess'] == 'T') {
    echo "request:\n";
    echo json_encode($json['request'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    echo "response:\n";
    echo json_encode($json['response'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    echo "done!\n";
} else {
    echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
