<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>自动提交表单</title>
</head>

<body onload="biz()">
<script type="text/javascript">
    function submit(url, bodyIn) {
        var f = document.createElement("form");
        document.body.appendChild(f);

        for (var key in bodyIn) {
            if (typeof(bodyIn[key]) == 'function') {
                continue;
            }
            var ei = document.createElement('input');
            ei.type = 'hidden';
            ei.name = key;
            ei.value = bodyIn[key];
            f.appendChild(ei);
        }

        f.method = 'post';
        f.action = url;
        f.submit();
        document.body.removeChild(f);
    }

    function biz() {
        var url = '{{ $url }}';
        var json = '<?php echo json_encode($data) ?>';
        var bodyIn = JSON.parse(json);
        submit(url, bodyIn);
    }
</script>
</body>

</html>
