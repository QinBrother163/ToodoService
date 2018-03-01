require('../toodo/init');
import {retail, retailId} from '../toodo/_retail';
import {getKeyCodes, getEvent, getKey, getCodes} from '../toodo/_keycodes';
import {httpGet} from '../toodo/_url';

const JSON = require('JSON');

const keyCode = getKeyCodes();
const preCodes = getCodes();


const reqAddress = function (callback) {
    httpGet(function (status, result) {
        let biz = null;
        if (status == 200) {
            let bizOut = {};
            try {
                bizOut = JSON.parse(result);
                if (bizOut.code == 0) {
                    biz = JSON.parse(bizOut.biz);
                }
            } catch (e) {
            }
        }
        callback(biz);
    }, queryUrl);
};

const goBack = function () {
    if(callbackUrl){
        window.location.href = callbackUrl;
        return;
    }
    if (retailId == retail.hnyx) {
        if (navigator.userAgent.indexOf('Avit-07') != -1) {
            location.href = 'file://htmldata/mod/general/relogin.htm';
        } else if (navigator.userAgent.indexOf('Avit-09') != -1) {
            try {
                method.closeBrowser();
            } catch (e) {
            }
        } else {
            try {
                let gvarRootUrl = new Global('superRootUrl');
                let backUrl = gvarRootUrl.value;
                window.location.href = backUrl;
            } catch (e) {
            }
        }
    }

    if (retailId == retail.none) {
        //关闭浏览器
        window.opener = null;
        window.open('', '_self');
        window.close();
    }
};

function AddressOut() {
    this.layout = document.getElementById('address-out-layout');
    this.nodeName = document.getElementById('address-name');
    this.nodePhone = document.getElementById('address-phone');
    this.nodeAddress = document.getElementById('address-address');

    var btns = [];
    for (var i = 0; i < 2; ++i) {
        var node = document.getElementById('btn' + i);
        btns.push(node);
    }
    this.buttons = btns;
}
AddressOut.prototype = {
    current: 0,
    callback: null,

    show: function (callback, btn, address) {
        this.callback = callback;

        this.layout.style.display = 'block';
        this.nodeName.innerHTML = '收货人：' + address.name;
        this.nodePhone.innerHTML = '手机：' + address.phone;
        this.nodeAddress.innerHTML = '地址：' + address.address;

        this.setSelected(btn);

        var owner = this;
        document.onkeydown = function (e) {
            owner.handleKey(e);
        };
    },
    hide: function () {
        document.onkeydown = null;
        this.layout.style.display = 'none';
    },
    setSelected: function (index) {
        this.current = index;
        var btns = this.buttons;
        for (var i = 0; i < btns.length; ++i) {
            this._setFocus(btns[i], i == index);
        }
    },
    _setFocus: function (node, focus) {
        node.className = focus ? 'btn-bg-focus' : 'btn-bg';
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
                if (owner.callback) owner.callback(-1);
                break;
            case keyCode.left:
            case keyCode.left2:
                if (owner.current != 0) {
                    owner.setSelected(0);
                }
                break;
            case keyCode.right:
            case keyCode.right2:
                if (owner.current != 1) {
                    owner.setSelected(1);
                }
                break;
            case keyCode.ok:
                if (owner.callback) owner.callback(owner.current);
                break;
        }
    },
};
function AddressIn() {
    this.layout = document.getElementById('address-in-layout');
}
AddressIn.prototype = {
    callback: null,

    show: function (callback) {
        this.callback = callback;

        this.layout.style.display = 'block';

        var owner = this;
        document.onkeydown = function (e) {
            owner.handleKey(e);
        };
    },
    hide: function () {
        document.onkeydown = null;
        this.layout.style.display = 'none';
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
                if (owner.callback) owner.callback(-1);
                break;
            case keyCode.ok:
                if (owner.callback) owner.callback(0);
                break;
        }
    },
};


const onPageOut = function (code) {
    pageOut.hide();
    if (code == 0) {
        pageIn.show(onPageIn);
    } else {
        goBack();
    }
};
const onPageIn = function (code) {
    pageIn.hide();
    if (code == 0) {
        reqAddress(function (biz) {
            onAddress(biz, true);
        });
    } else {
        goBack();
    }
};
const onAddress = function (address, need) {
    if (address) {
        pageOut.show(onPageOut, 0, address);
    } else if (need) {
        goBack();
    } else {
        pageIn.show(onPageIn);
    }
};


let queryUrl = decodeURIComponent(window.queryUrl);
let callbackUrl = decodeURIComponent(window.callbackUrl);

let pageOut = new AddressOut();
let pageIn = new AddressIn();


window.onload = function () {
    reqAddress(function (biz) {
        onAddress(biz, false);
    });
};


