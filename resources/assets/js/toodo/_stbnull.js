import {retailId,retail} from "./_retail";

function StbNull() {
}
if (retailId == retail.gxgd) {// 广西广电 =====================================
    StbNull.prototype = {
        getCardTV: function () {
            return guangxi.getStbNum();
        },
        getRegionCode: function () {
            return iPanel.getGlobalVar("GET_MEDIA_REGION_ID");
        },
        getValue: function (keyName) {
            var result = null;
            try {
                result = iPanel.getGlobalVar(keyName);
            } catch (e) {
                var aCookie = document.cookie.split("; ");
                for (var i = 0; i < aCookie.length; i++) {
                    var aCrumb = aCookie[i].split("=");
                    if (escape(keyName) == aCrumb[0]) {
                        result = unescape(aCrumb[1]);
                        break;
                    }
                }
            }
            if (!result || result == "#" || result == "clearValue") {
                result = "";
            }
            return result;
        },
        setValue: function (keyName, keyValue) {
            if (keyValue == "") {
                keyValue = "clearValue";
            }
            try {
                iPanel.setGlobalVar(keyName, keyValue);
            } catch (e) {
                document.cookie = escape(keyName) + "=" + escape(keyValue);
            }
        }
    };
} else if (retailId == retail.hnyx) {// 河南有线 =====================================
    var System = window.System;
    StbNull.prototype = {
        getCardTV: function () {
            return System.stbID;
        },
        getRegionCode: function () {
            var region = 'hnyx';
            try {
                region = System.GetCARegionID();
            } catch (e) {
            }
            return region
        },
        getValue: function (keyName) {
            var g = null;
            if (!g) {
                try {
                    g = new Global(keyName);
                } catch (e) {
                }
            }
            if (!g) {
                try {
                    g = new Global2(keyName);
                } catch (e) {
                }
            }
            if (!g) {
                g = {value: null};
            }
            return g.value;
        },
        setValue: function (keyName, keyValue) {
            var g = null;
            if (!g) {
                try {
                    g = new Global(keyName);
                } catch (e) {
                }
            }
            if (!g) {
                try {
                    g = new Global2(keyName);
                } catch (e) {
                }
            }
            if (!g) {
                return;
            }
            g.value = keyValue;
        }
    };
} else if (retailId == retail.gdgd) {// 广东广电 =====================================
    StbNull.prototype = {
        getCardTV: function () {
            if (!CA.icNo) {
                return '9695610086';
            }
            return CA.icNo;
        },
        getRegionCode: function () {
            return CA.regionCode;
        },
        getValue: function (keyName) {
            return SysSetting.getEnv(keyName);
        },
        setValue: function (keyName, keyValue) {
            SysSetting.setEnv(keyName, keyValue);
        }
    };
} else {
    StbNull.prototype = {
        getCardTV: function () {
            return '10086';
        },
        getRegionCode: function () {
            return '0';
        },
        getValue: function (keyName) {
            let result = '';
            const aCookie = document.cookie.split("; ");
            for (let i = 0; i < aCookie.length; i++) {
                const aCrumb = aCookie[i].split("=");
                if (escape(keyName) == aCrumb[0]) {
                    result = unescape(aCrumb[1]);
                    break;
                }
            }
            return result;
        },
        setValue: function (keyName, keyValue) {
            document.cookie = escape(keyName) + "=" + escape(keyValue);
        }
    };
}

var stbNull = new StbNull();
export {StbNull,stbNull}