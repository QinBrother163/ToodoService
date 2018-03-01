var JavaApi = function () {
};
JavaApi.prototype = {
    parseQuery: function (query) {
        var start = query.indexOf('?');
        if (start >= 0) {
            query = query.slice(start + 1);
        }
        var args = {};
        var arr = query.split('&');
        for (var m = 0; m < arr.length; m++) {
            var v = arr[m];
            var tmp = v.split('=');
            args[tmp[0]] = decodeURIComponent(tmp[1]);
        }
        return args;
    },
    parseArgs: function (args) {
        var k, v;
        var arr = [];
        for (k in args) {
            //! js 会把'0'当作false args[k] => args[k] !== ''
            if (args.hasOwnProperty(k) && args[k] !== '') {
                v = encodeURIComponent(args[k]);
                arr.push(k + '=' + v);
            }
        }
        return arr.join('&');
    },
    call: function (method, args) {
        var url = 'js://JavaApi?m=' + method;
        var query;
        if (args) {
            query = this.parseArgs(args);
            url += '&' + query;
        }
        return prompt(url);
    },

    setBackKeyEnable: function (enable) {
        return this.call(0, {enable: !!enable});
    },
    test1: function () {
        return this.call(1, false);
    }
};

window.javaApi = new JavaApi();