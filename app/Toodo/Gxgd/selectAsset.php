<?php


function curlPost($url, $data)
{
    $args = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Content-Length: ' . strlen($args))
    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($code, $result);
}

function curlHttpGet($url, $data)
{
    $args = http_build_query($data);
    $url .= "?$args";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($code, $result);
}

$biz = [
    'func' => 'select_asset',
    'import_id' => 'GGLYVIDEOCP100000001000000000001',
    'select_type' => 'check,online,lock',
    'cp_id' => 'test',
];

list($code, $result) = curlPost('http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php', $biz);
echo 'post-------' . "$code\n";
echo $result . "\n";


$biz = [
    'nns_func' => 'check_auth_and_get_media_by_media',
    'nns_user_id' => '',
    'nns_version' => '1.0.0.GXGD.0.0TEST',
    'nns_video_id' => '',
    'nns_cp_video_id' => 'test2017070101001101001700000000',
    'nns_video_type' => 0,
    'nns_cp_id' => 'test',
    'nns_tag' => 26,
    'nns_cdn_flag' => 'rtsp_vod',
];

list($code, $result) = curlHttpGet('http://10.0.11.51/gxcatv20/AuthIndexStandard', $biz);
echo 'get-------' . "$code\n";
$xml = simplexml_load_string($result);
//echo json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

/** @var SimpleXMLElement $media */
$media = $xml->video->index->media;
echo $media->attributes()->url;//->video->index->media;