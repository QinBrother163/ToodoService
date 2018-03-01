import {retail, retailId} from '../toodo/_retail';
import {getKeyCodes, getEvent, getKey, getCodes} from '../toodo/_keycodes';
import {aliPage} from './AliPage';
require('../toodo/init');


const keyCode = getKeyCodes();
const preCodes = getCodes();


const show = function () {
    let bg = document.getElementById('result-layout');
    if (bg) {
        bg.style.display = 'block';
    }
    document.onkeydown = handleKey;
};
const hide = function () {
    document.onkeydown = null;
    let bg = document.getElementById('result-layout');
    if (bg) {
        bg.style.display = 'none';
    }
};

const handleKey = function (e) {
    e = getEvent(e);
    const curKey = getKey(e);
    if (preCodes.indexOf(curKey) != -1) {
        try {
            e.preventDefault();
        } catch (e) {
        }
    }
    switch (curKey) {
        case keyCode.ok:
            if (code == 0) {
                window.location.href = addressUrl;
            } else if (code == 1) {
                hide();
                aliPage.show(onAliPay, queryUrl);
            }
            break;
        case keyCode.num0:
        case keyCode.back:
        case keyCode.esc:
            goBack();
            break;
    }
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

const onAliPay = function (code, msg) {
    console.log('-e code:' + code + ' msg:' + msg);
    //console.log(orderUrl);
    if (code != 0) {
        return goBack();
    } else {
        window.location.href = orderUrl;
    }
};


let code = parseInt(window.code);
//let orderBiz = window.orderBiz;
let addressUrl = decodeURIComponent(window.addressUrl);
let queryUrl = decodeURIComponent(window.queryUrl);
let orderUrl = decodeURIComponent(window.orderUrl);
let callbackUrl = decodeURIComponent(window.callbackUrl);

window.onload = function () {
    show();

    //setTimeout(goBack, 3000);
};


