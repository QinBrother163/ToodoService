﻿using System;

namespace com.toodo
{
    public class RequestBody
    {
        public String appId;       // 分配给开发者的应用ID:1000
        public String method;      // 接口名称:toodo.trade.pay
        public String format;      // 仅支持JSON
        public String charset;     // 请求使用的编码格式，如utf-8,gbk,gb2312等
        public String signType;    // 商户生成签名字符串所使用的签名算法类型:RSA、MD5
        public String signCode;    // 商户请求参数的签名串 32位小写
        public String timestamp;   // 发送请求的时间，格式"yyyy-MM-dd HH:mm:ss":2014-07-24 03:07:50
        public String version;     // 调用的接口版本，固定为：1.0
        public String appAuthToken;// 应用授权码
        public String bizContent;  // 业务参数集合，最大长度不限，除公共参数外所有请求参数都必须放在这个参数中传递，具体参照各产品快速接入文档
    }
}
