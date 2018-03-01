<?php

function postXml($url, $xml)
{
    $header[] = "Content-type: text/xml";      //定义content-type为xml,注意是数组
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        printcurl_error($curl);
    }
    curl_close($curl);

    return $response;
}

function xml_to_array($xmlContent)
{
    $array = (array)(simplexml_load_string($xmlContent));
    foreach ($array as $key => $item) {
        $array[$key] = struct_to_array((array)$item);
    }
    return $array;
}

function struct_to_array($item)
{
    if (!is_string($item)) {
        $item = (array)$item;
        foreach ($item as $key => $val) {
            $item[$key] = struct_to_array($val);
        }
    }
    return $item;
}