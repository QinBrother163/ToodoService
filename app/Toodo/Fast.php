<?php

namespace App\Toodo;


class Fast
{
    static $timeout = 10;

    /**
     * @param $url string
     * @return array
     */
    public static function getUrlArgs($url)
    {
        $query = parse_url($url)['query'];
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    public static function curlPostJson($url, $data)
    {
        $data = json_encode($data);
        return self::post($url, $data, 'application/json');
    }

    public static function curlPostXml($url, $data)
    {
        return self::post($url, $data, 'application/xml');
    }

    public static function curlPost($url, $data)
    {
        $data = http_build_query($data);
        return self::post($url, $data, 'application/x-www-form-urlencoded');
    }

    /**
     * @param string $url
     * @param string $data
     * @param string $type
     * @return array resp
     * @return string resp.code
     * @return string resp.result
     */
    public static function post($url, $data, $type)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: $type; charset=utf-8",
            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($code, $result);
    }

    /**
     * @param string $url
     * @param array|object $data
     * @return array resp
     * @return int resp.code
     * @return string resp.result
     */
    public static function curlGetJson($url, $data)
    {
        $args = http_build_query($data);
        $url .= "?$args";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept:  application/json',
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($code, $result);
    }

    public static function curlGet($url, $data)
    {
        $args = http_build_query($data);
        $url .= "?$args";
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_HTTPGET, true);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //curl_setopt($ch, CURLINFO_HEADER_OUT, true); //TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header
        //! TODO
        curl_setopt($ch, CURLOPT_HEADER, true);// 返回 response_header, 该选项非常重要,如果不为 true, 只会获得响应的正文
        curl_setopt($ch, CURLOPT_NOBODY, false);// 是否不需要响应的正文,为了节省带宽及时间,在只需要响应头的情况下可以不要正文

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);

        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //$header = curl_getinfo($ch, CURLINFO_HEADER_OUT); //官方文档描述是“发送请求的字符串”，其实就是请求的header。这个就是直接查看请求header，因为上面允许查看
        //\Log::debug('-e header:' . $header);

        //! TODO
        \Log::debug('-e result:' . $result);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        //$header = substr($result, 0, $headerSize);
        $result = substr($result, $headerSize);


        curl_close($ch);
        return array($code, $result);
    }

    public static function serialNo($numLen = 20)
    {
        return date('YmdHis') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, $numLen - 14);
    }

    //返回当前的毫秒时间戳
    public static function ms()
    {
        list($mms, $sec) = explode(' ', microtime());
        $ms = (float)sprintf('%.0f', (floatval($mms) + floatval($sec)) * 1000);
        return $ms;
    }

    public static function qrUrl($url)
    {
        $args = http_build_query([
            'url' => $url,
        ]);
        return url('/api/qrCode') . "?$args";
    }
}