import {getKeyCodes, getEvent, getKey, getCodes} from "../toodo/_keycodes";
import {httpGet} from '../toodo/_url';
const JSON = require('JSON');


const keyCode = getKeyCodes();
const preCodes = getCodes();

function AliPage() {

}

AliPage.prototype = {
    callback: null,
    handelQueryTimeOut: null,
    tryCnt: 0,

    /**
     * @param callback {function}
     * @param callback.code {int}
     *                    0 充值成功
     *                    1 充值失败
     *                   -1 取消操作
     * @param callback.msg {string}
     * @param queryUrl {string} 查询充值结果url
     */
    show: function (callback, queryUrl) {
        let bg = document.getElementById('ali-layout');
        if (bg) {
            bg.style.display = 'block';
        }

        this.callback = callback;

        const owner = this;
        if (0) {
            owner.hide(1, '充值失败');
            return;
        }
        document.onkeydown = function (e) {
            owner.handleKey(e);
        };
        owner.tryCnt = 0;
        owner.query(queryUrl);
    },
    hide: function (code, msg) {
        document.onkeydown = null;

        if (this.handelQueryTimeOut) {
            clearTimeout(this.handelQueryTimeOut);
            this.handelQueryTimeOut = null;
        }

        let bg = document.getElementById('ali-layout');
        if (bg) {
            bg.style.display = 'none';
        }

        if (typeof(this.callback) === 'function') {
            this.callback(code, msg);
        }
        this.callback = null;
    },
    handleKey: function (e) {
        const owner = this;
        e = getEvent(e);
        const curKey = getKey(e);
        if (preCodes.indexOf(curKey) != -1) {
            try {
                e.preventDefault();
            } catch (e) {
            }
        }
        switch (curKey) {
            case keyCode.num0:
            case keyCode.back:
            case keyCode.esc:
                owner.hide(-1, '取消操作');
                break;
        }
    },
    query: function (url) {
        const owner = this;
        owner.tryCnt++;
        httpGet(function (status, result) {
            if (status != 200) {
                return owner.hide(1, '错误 返回码:' + status);
            }

            let bizOut = null;
            try {
                bizOut = JSON.parse(result);
            } catch (e) {
            }
            if (!bizOut) {
                return owner.hide(1, '错误 返回数据:' + result);
            }

            if (bizOut.code != '0000' && bizOut.code != '0004') {
                return owner.hide(1, '查询失败');
            }

            if (bizOut.isPaid == '1') {
                return owner.hide(0, '充值成功');
            }

            //! 轮询结果
            owner.handelQueryTimeOut = setTimeout(function () {
                owner.query(url);
            }, 3000);
        }, url);
    },

};


const aliPage = new AliPage();
export {aliPage}