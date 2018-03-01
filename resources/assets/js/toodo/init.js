import {retail, retailId} from "./_retail";


if (retailId == retail.gxgd) {
    try {
        //iPanel.setGlobalVar("SEND_ALL_KEY_TO_PAGE", "1");
        iPanel.setGlobalVar("SEND_RETURN_KEY_TO_PAGE", "1");
        iPanel.setGlobalVar("SEND_EXIT_KEY_TO_PAGE", "1");
    } catch (e) {
    }
} else if (retailId == retail.hnyx) {
    // try {
    //     enableBrowserBackKey(false);
    // } catch (e) {
    // }
    try {
        method.stopDefault(1);
    } catch (e) {
    }
} else if (retailId == retail.gdgd) {

} else {
    // 屏蔽退格返回键
    document.onkeypress = function (e) {
        return false;
    };
}

window.onunload = function () {
    if (retailId == retail.gxgd) {
        try {
            //iPanel.setGlobalVar("SEND_ALL_KEY_TO_PAGE", "0");
            iPanel.setGlobalVar("SEND_RETURN_KEY_TO_PAGE", "0");
            iPanel.setGlobalVar("SEND_EXIT_KEY_TO_PAGE", "0");
        } catch (e) {
        }
    } else if (retailId == retail.hnyx) {
        // try {
        //     enableBrowserBackKey(true);
        // } catch (e) {
        // }
    }
};