<?php

/*
测试环境接口URL：
http://10.0.11.40/web-lezboss-test/service

飞奔游戏
Partner：1000000018
AppKey: 43da9ccafc9cc8f07f3db95801345183
*/
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
    'method' => 'promotionOrder',
    'userId' => '108749857',
    'stbId' => '1140150003308',
    'areaCode' => '3996',
    'isHD' => '720P',
    'productId' => '404550068570',
    'productName' => 'test',
    'promotionId' => '600048040',
    'ptitle' => 'test',
    'amount' => '0.1',
    'tariffId' => '291493',
    'partner' => $appKey,
    'callbackUrl' => 'http://10.0.4.108/tdsrv/api/toodo/gxgd/onCallback',
    'noticeUrl' => 'http://10.0.4.108/tdsrv/api/toodo/gxgd/onNotice',
    'appIndexUrl' => 'http://10.0.4.108/tdenter/index.html',
];
$biz['sign'] = signCode($biz, $appSecret);
$args = http_build_query($biz);

$url = 'http://10.0.11.38/web-lezboss/service?' . $args;

echo $url;