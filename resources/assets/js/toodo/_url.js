const parseQuery = function (query) {
    const start = query.indexOf('?');
    if (start >= 0) {
        query = query.slice(start + 1);
    }
    const args = {};
    const arr = query.split('&');
    for (let m = 0; m < arr.length; m++) {
        const v = arr[m];
        const tmp = v.split('=');
        args[tmp[0]] = decodeURIComponent(tmp[1]);
    }
    return args;
};
const parseArgs = function (args) {
    let k, v;
    const arr = [];
    for (k in args) {
        //! js 会把'0'当作false args[k] => args[k] !== ''
        if (args.hasOwnProperty(k) && args[k] !== '') {
            v = encodeURIComponent(args[k]);
            arr.push(k + '=' + v);
        }
    }
    return arr.join('&');
};

const httpGet = function (callback, url) {
    if (!callback) return;

    if (!XMLHttpRequest) {
        if (callback) callback(-1, '找不到XMLHttpRequest');
        return;
    }

    const xml = new XMLHttpRequest();
    const handleTimeout = setTimeout(function () {
        xml.abort();
        if (callback) callback(103, '请求超时');
    }, 10000);

    xml.onreadystatechange = function () {
        if (xml.readyState == 4) {
            clearTimeout(handleTimeout);
            callback(xml.status, xml.responseText);
        }
    };

    xml.open('GET', url, true);
    //xml.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xml.send(null);
};

export {parseQuery, parseArgs, httpGet}