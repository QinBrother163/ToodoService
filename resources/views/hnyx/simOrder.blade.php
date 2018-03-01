<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>双动科技-模拟订购页面</title>
    <style>
        body {
            background: #8eb4cb;
            width: 1280px;
            height: 720px;
            margin: 0;
        }

        .sim-btn {
            position: absolute;
            left: 200px;
            font-size: 24px;
            color: #60ff00;
            line-height: 32px;
        }

        .sim-btn-focus {
            position: absolute;
            left: 200px;
            font-size: 24px;
            color: #ff2400;
            background: #ffe400;
            line-height: 32px;
        }
    </style>
    <script type="text/javascript">
        window.backUrl = "{{ $backUrl }}";
        window.tradeNo = "{{ $tradeNo }}";
    </script>
</head>
<body>

<div class="sim-btn" style="font-size: 18px;top: 24px;">请选择模拟订购结果</div>
<div id="sim-btn0" class="sim-btn-focus" style="top: 60px">0.订购成功！</div>
{{--<div id="sim-btn1" class="sim-btn" style="top: 100px">1.余额不足！</div>--}}
<div id="sim-btn2" class="sim-btn" style="top: 140px">2.订购失败！</div>
<div id="biz1" class="sim-btn" style="font-size: 18px;top: 256px;"></div>
<div id="biz2" class="sim-btn" style="font-size: 18px;top: 564px;"></div>

<script src="{{ asset('js/hnyx/simOrder.js?v='.md5_file(public_path('js/hnyx/simOrder.js'))) }}"></script>
<script type="text/javascript">
    //document.getElementById('biz1').innerHTML = window.location.href;
    try {
        //document.getElementById('biz2').innerHTML = 'System.Pgt:'+System.Pgt();
    } catch (e) {
    }
</script>
</body>
</html>
