import {retail, retailId} from '../toodo/_retail';
import {aliPage} from './AliPage';
require('../toodo/init');


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
                window.location.href = gvarRootUrl.value;
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
    //console.log('-e code:' + code + ' msg:' + msg);
    if (code == 0) {
        //window.location.href = orderUrl;
        window.location.replace(orderUrl);
    } else if (code == -1) {
        goBack();
        // window.location.replace(orderUrl);
    } else {
        window.location.replace(backUrl);
    }
};


let backUrl = decodeURIComponent(window.backUrl);
let orderUrl = decodeURIComponent(window.orderUrl);
let queryUrl = decodeURIComponent(window.queryUrl);
let callbackUrl = decodeURIComponent(window.callbackUrl);

window.onload = function () {
    aliPage.show(onAliPay, queryUrl);

    // setTimeout(function () {
    //     window.location.replace(orderUrl);
    // }, 13000);
};
