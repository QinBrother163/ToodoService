<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>双动科技-订购跳转</title>
    <style>
        body {
            background: url("{{ asset('img/hnyx/bg.png') }}") no-repeat;
            width: 1280px;
            height: 720px;
            margin: 0;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    function parseQuery(query) {
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
    }

    window.onload = function () {
        var orderUrl = "{{ $orderUrl }}";
        orderUrl = decodeURIComponent(orderUrl);

        var tgt;
        try {
            var bizIn = parseQuery(window.location.href);
            tgt = bizIn.pgt;
        } catch (e) {
        }
        try {
            if (!tgt) {
                tgt = System.Pgt();
            }
        } catch (e) {
        }
        var url = orderUrl + "&tgt=" + tgt;
        //window.location.href = url;
        window.location.replace(url);
    }
</script>
</body>
</html>
