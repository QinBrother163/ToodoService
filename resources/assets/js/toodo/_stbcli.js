import {RequestBody, ToodoClient} from "./_tdcli";
import {retailId} from "./_retail";
import {stbNull} from "./_stbnull";
var md5 = require('md5');
var JSON = require('JSON');

function StbClient() {
    this.originUrl = location.protocol + '//' + location.host + '/tdsrv';
    this.appKey = '1000';
    this.appSecret = 'RcOFhtAYzwCGo91PGHdV';
    this._tdcli = null;
}
StbClient.prototype = {
    isReady: false,
    userId: '',
    token: '',

    md5: function (msg) {
        return md5(msg + this.appSecret);
    },
    /**
     * @param {function} callback
     * @param {number} callback.code
     * @param {string|Object} callback.biz
     */
    start: function (callback) {

        if (!this._tdcli) {
            this._tdcli = new ToodoClient(this.appKey, this.appSecret, this.originUrl);
        }

        let token = stbNull.getValue('toodo.token');
        let userId = stbNull.getValue('toodo.userId');
        // if (token && userId) {
        //     this.token = token;
        //     this.userId = userId;
        //     this.isReady = true;
        //     if (callback) callback(0);
        //     return;
        // }

        const bizIn = {
            'retailId': retailId,
            'regionCode': stbNull.getRegionCode(),
            'cardTV': stbNull.getCardTV()
        };

        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/user';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);

        const owner = this;
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo');
        this._tdcli.send(bodyIn, function (bodyOut) {
            if (bodyOut.code == 0) {
                const bizOut = JSON.parse(bodyOut.bizContent);
                owner.userId = bizOut.userId;
                owner.token = bodyOut.token;
                stbNull.setValue('toodo.userId', owner.userId);
                stbNull.setValue('toodo.token', owner.token);
                owner.isReady = true;
                //if (callback) callback(bodyOut.code, bizOut);
                owner.tdeUser(callback);//返回大厅的账号信息
            } else {
                if (callback) callback(bodyOut.code, bodyOut.subCode);
            }
        });
    },
    /**
     * @param {number} productId 查询的产品统一编号
     * @param {function} callback
     * @param {number} callback.code
     * @param {string|Object} callback.biz
     */
    queryServe1: function (productId, callback) {
        const bizIn = {
            'productId': productId
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/serve/query1';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/serve');
        this.send(bodyIn, callback);
    },
    /**
     * @param {number} productId 查询的产品统一编号
     * @param {function} callback
     * @param {number} callback.code
     * @param {Object} callback.biz
     */
    queryProduct1: function (productId, callback) {
        const bizIn = {
            'productId': productId
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/market/query1';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/market');
        this.send(bodyIn, callback);
    },
    /**
     * @param {number} productId 生成订单的产品统一编号
     * @param {string} callbackUrl 支付后回调地址
     * @param {string} data 原样传回给callbackUrl
     * @param {function} callback
     * @param {number} callback.code
     * @param {Object} callback.biz
     */
    order1: function (productId, callbackUrl, data, callback) {
        const bizIn = {
            'productId': productId,
            'userId': this.userId,
            'callbackUrl': callbackUrl,
            'data': data
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/trade/order1';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/trade');
        this.send(bodyIn, callback);
    },
    /**
     * @param {string} tradeNo 请求支付订单号
     */
    pay: function (tradeNo) {
        const bizIn = {
            'tradeNo': tradeNo
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/trade/pay';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/trade');
        this._tdcli.submit(bodyIn);
    },
    bill: function (callback) {
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/trade/bill';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = '';
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/trade');
        this.send(bodyIn, callback);
    },
    /**
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回账号信息
     */
    tdeUser: function (callback) {
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tde/user';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = '';
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tde');
        this.send(bodyIn, callback);
    },
    tdeLock: function (oldLock, newLock, callback) {
        const bizIn = {
            'childLock': oldLock,
            'newLock': newLock
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tde/lock';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tde');
        this.send(bodyIn, callback);
    },
    /**
     * @param {number} page 页面编号
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回页面信息
     */
    tdePage: function (page, callback) {
        const bizIn = {
            'page': page
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tde/page';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tde');
        this.send(bodyIn, callback);
    },
    /**
     * @param {number} category 歌曲分类
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回页面信息
     */
    tdaSong: function (category, callback) {
        const bizIn = {
            'category': category
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/song';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    tdaMvUrl: function (userId, songId, callback) {
        const bizIn = {
            'userId': userId,
            'songId': songId
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/mvUrl';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    tdaSong1: function (songId, callback) {
        const bizIn = {
            'songId': songId
        };
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/song1';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(bizIn);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    /**
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回页面信息
     */
    tdaMatch: function (callback) {
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/match';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = '';
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    /**
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回页面信息
     */
    tdaUser: function (callback) {
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/user';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = '';
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    /**
     * @param {Object} record 记录
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object} callback.biz 返回页面信息
     */
    tdaRecord: function (record, callback) {
        const bodyIn = new RequestBody();
        bodyIn.method = '/toodo/tda/record';
        bodyIn.appAuthToken = this.token;
        bodyIn.bizContent = JSON.stringify(record);
        this._tdcli.setApiUrl(this.originUrl + '/api/toodo/tda');
        this.send(bodyIn, callback);
    },
    /**
     * @param {RequestBody} bodyIn
     * @param {function} callback
     * @param {number} callback.code 返回码
     * @param {Object|number|string} callback.biz 返回数据
     */
    send: function (bodyIn, callback) {
        const owner = this;
        this._tdcli.send(bodyIn, function (bodyOut) {
            if (bodyOut.code == 0) {
                let bizOut = JSON.parse(bodyOut.bizContent);
                if (bodyOut.token) {
                    owner.token = bodyOut.token;
                    stbNull.setValue('toodo.token', owner.token);
                }
                /**
                 alert(typeof 1);                // 返回字符串"number"
                 alert(typeof "1");              // 返回字符串"string"
                 alert(typeof true);             // 返回字符串"boolean"
                 alert(typeof {});               // 返回字符串"object"
                 alert(typeof []);               // 返回字符串"object "
                 alert(typeof function(){});     // 返回字符串"function"
                 alert(typeof null);             // 返回字符串"object"
                 alert(typeof undefined);        // 返回字符串"undefined"
                 */
                if (bizOut && typeof(bizOut) === 'object') {
                    bizOut.stbcli = owner;
                }
                if (callback) callback(bodyOut.code, bizOut);
            } else {
                if (callback) callback(bodyOut.code, bodyOut.subCode);
            }
        });
    }
};


var stbcli = new StbClient();
export {StbClient,stbcli}