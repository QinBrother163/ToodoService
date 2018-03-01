var md5 = require('md5');
var JSON = require('JSON');

if (!Date.prototype.format) {
    Date.prototype.format = function (fmt) {
        const o = {
            "M+": this.getMonth() + 1,                 //月份
            "d+": this.getDate(),                    //日
            "h+": this.getHours(),                   //小时
            "m+": this.getMinutes(),                 //分
            "s+": this.getSeconds(),                 //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds()             //毫秒
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        for (let k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    }
}

export function RequestBody() {
    this.appId = '';               // 分配给开发者的应用ID:1000
    this.method = '';              // 接口名称:toodo.trade.pay
    this.format = 'JSON';          // 仅支持JSON
    this.charset = 'utf-8';        // 请求使用的编码格式，如utf-8,gbk,gb2312等
    this.signType = 'MD5';         // 商户生成签名字符串所使用的签名算法类型:RSA、MD5
    this.signCode = '';            // 商户请求参数的签名串 32位小写
    this.timestamp = '';           // 发送请求的时间，格式"yyyy-MM-dd HH:mm:ss":2014-07-24 03:07:50
    this.version = '1.0';          // 调用的接口版本，固定为：1.0
    this.appAuthToken = '';        // 应用授权码
    this.bizContent = '';          // 业务参数集合，最大长度不限，除公共参数外所有请求参数都必须放在这个参数中传递，具体参照各产品快速接入文档
}
RequestBody.prototype = {
    parse: function (json) {
        const body = JSON.parse(json);
        this.appId = body.appId;
        this.method = body.method;
        this.format = body.format;
        this.charset = body.charset;
        this.signType = body.signType;
        this.signCode = body.signCode;
        this.timestamp = body.timestamp;
        this.version = body.version;
        this.appAuthToken = body.appAuthToken;
        this.bizContent = body.bizContent;
    }
};

export function ResponseBody() {
    this.code = 0;       // 网关返回码
    this.msg = '调用成功'; // 网关返回码描述
    this.subCode = '';   // 业务返回码,详见文档:xxxx
    this.subMsg = '';    // 业务返回码描述,详见文档:交易已被支付
    this.timestamp = ''; // 应答的时间
    this.sign = '';      // 签名,详见文档 32位小写
    this.bizContent = '';// 业务参数集合，最大长度不限，除公共参数外所有返回参数都必须放在这个参数中传递，具体参照各产品快速接入文档
    this.token = '';     // 更新后的授权码,为空则不更新
}
ResponseBody.prototype = {
    parse: function (json) {
        const body = JSON.parse(json);
        this.code = body.code;
        this.msg = body.msg;
        this.subCode = body.subCode;
        this.subMsg = body.subMsg;
        this.timestamp = body.timestamp;
        this.sign = body.sign;
        this.bizContent = body.bizContent;
        this.token = body.token;
    }
};

export function ToodoClient(appId, appSecret, apiUrl) {
    this.start(appId, appSecret, apiUrl);
    this.isBusy = false;
}

ToodoClient.prototype = {
    /**
     * @param {string} appId
     * @param {string} appSecret
     * @param {string} apiUrl
     */
    start: function (appId, appSecret, apiUrl) {
        this.appId = appId;
        this.appSecret = appSecret;
        this.apiUrl = apiUrl;
        this.token = '';
    },
    /**
     * @param {RequestBody} bodyIn
     */
    signCodeIn: function (bodyIn) {
        const str = '' +
            bodyIn.appAuthToken +
            bodyIn.appId +
            bodyIn.bizContent +
            bodyIn.charset +
            bodyIn.format +
            bodyIn.method +
            bodyIn.timestamp +
            bodyIn.version +
            this.appSecret;
        return md5(str);
    },
    /**
     * @param {ResponseBody} bodyOut
     */
    signCodeOut: function (bodyOut) {
        const str = '' +
            bodyOut.bizContent +
            bodyOut.code +
            bodyOut.msg +
            bodyOut.subCode +
            bodyOut.subMsg +
            bodyOut.timestamp +
            bodyOut.token +
            this.appSecret;
        return md5(str);
    },
    /**
     * @param {string} apiUrl
     */
    setApiUrl: function (apiUrl) {
        this.apiUrl = apiUrl;
    },
    /**
     * @param {RequestBody} bodyIn
     * @param {function} callback
     * @param {ResponseBody} callback.bodyOut
     */
    send: function (bodyIn, callback) {
        const bodyOut = new ResponseBody();

        if (!XMLHttpRequest) {
            bodyOut.code = 10000;
            bodyOut.msg = '客户端错误';
            bodyOut.subCode = '105';
            bodyOut.subMsg = 'XMLHttpRequest对象不存在';
            if (callback) callback(bodyOut);
            return;
        }

        if (this.isBusy) {
            bodyOut.code = 10000;
            bodyOut.msg = '客户端错误';
            bodyOut.subCode = '99';
            bodyOut.subMsg = '很忙哦，请求队列已满';
            if (callback) callback(bodyOut);
            return;
        }

        this.isBusy = true;


        if (bodyIn.appAuthToken) {
            this.token = bodyIn.appAuthToken;
            bodyIn.appAuthToken = '';
        }

        bodyIn.appId = this.appId;
        bodyIn.timestamp = new Date().format("yyyy-MM-dd hh:mm:ss");
        bodyIn.signCode = this.signCodeIn(bodyIn);

        const xml = new XMLHttpRequest();
        const owner = this;

        const handleTimeout = setTimeout(function () {
            xml.abort();

            bodyOut.code = 10000;
            bodyOut.msg = '客户端错误';
            bodyOut.subCode = '103';
            bodyOut.subMsg = '请求超时';

            owner.isBusy = false;
            if (callback) callback(bodyOut);
        }, 10000);

        xml.onreadystatechange = function () {
            if (xml.readyState == 4) {
                clearTimeout(handleTimeout);

                if (xml.status == 200) {
                    try {
                        bodyOut.parse(xml.responseText);
                        if (bodyOut.code == 0) {
                            const md5 = owner.signCodeOut(bodyOut);
                            if (md5 != bodyOut.sign) {
                                bodyOut.code = 10000;
                                bodyOut.msg = '客户端错误';
                                bodyOut.subCode = '102';
                                bodyOut.subMsg = '返回结果签名出错';
                                // bodyOut.timestamp = '';
                                bodyOut.sign = '';
                                bodyOut.bizContent = '';
                                bodyOut.token = '';
                            }
                        }

                        if (bodyOut.code == 0) {
                            if (bodyOut.token) {
                                owner.token = bodyOut.token;
                            }
                        }
                    } catch (err) {
                        bodyOut.code = 10000;
                        bodyOut.msg = '客户端错误';
                        bodyOut.subCode = '101';
                        bodyOut.subMsg = '返回结果异常 err:' + err;
                    }

                } else {
                    bodyOut.code = 10000;
                    bodyOut.msg = '客户端错误';
                    bodyOut.subCode = '104';
                    bodyOut.subMsg = '请求返回错误';
                }

                owner.isBusy = false;
                if (callback) callback(bodyOut);
            }
        };
        const tokenUrl = this.apiUrl + '?token=' + this.token;
        xml.open('POST', tokenUrl, true);
        xml.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xml.send(JSON.stringify(bodyIn));
    },
    /**
     * @param {RequestBody} bodyIn
     */
    submit: function (bodyIn) {
        bodyIn.appId = this.appId;
        bodyIn.timestamp = new Date().format("yyyy-MM-dd hh:mm:ss");
        bodyIn.signCode = this.signCodeIn(bodyIn);

        const f = document.createElement("form");
        document.body.appendChild(f);

        for (let key in bodyIn) {
            //noinspection JSUnfilteredForInLoop
            if (typeof(bodyIn[key]) == 'function') {
                continue;
            }

            const ei = document.createElement('input');
            ei.type = 'hidden';
            ei.name = key;
            //noinspection JSUnfilteredForInLoop
            ei.value = bodyIn[key];
            f.appendChild(ei);
        }

        f.method = 'post';
        f.action = this.apiUrl;
        f.submit();
        document.body.removeChild(f);
    }
};
