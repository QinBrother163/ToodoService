<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>双动科技-订购结果</title>
    <style type="text/css">
        body {
            background: url("{{ asset('img/hnyx/bg.png') }}") no-repeat;
            width: 1280px;
            height: 720px;
            margin: 0;
        }

        .result {
            position: absolute;
            left: 408px;
            top: 246px;
            display: none;
        }

        .result-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 112px;
            height: 112px;
        }

        .result-title {
            position: absolute;
            left: 140px;
            top: -4px;
            width: 200px;
            font-size: 26px;
        }

        .result-text {
            position: absolute;
            left: 140px;
            top: 45px;
            width: 400px;
            color: #ffffff;
            font-size: 21px;
            line-height: 28px;
        }

        .result-btn {
            position: absolute;
            top: 205px;
            width: 181px;
            height: 58px;
        }

        #result-btn0 {
            left: -190px;
            background: url("{{ asset('img/hnyx/btn0.png') }}") no-repeat;
        }

        #result-btn1 {
            left: 190px;
            background: url("{{ asset('img/hnyx/btn1.png') }}") no-repeat;
        }

        .ali-bg {
            position: absolute;
            left: 99px;
            top: 112px;
            width: 1098px;
            height: 519px;
            background: url("{{ asset('img/hnyx/alipay.png') }}");

            color: #ffffff;
            font-size: 20px;
            display: none;
        }

        .ali-text-amount {
            position: absolute;
            left: 659px;
            top: 67px;
            color: #ffffff;
            font-size: 20px;
        }

        .ali-qr-img {
            position: absolute;
            left: 422px;
            top: 172px;
            width: 260px;
            height: 260px;
            background: url("{{ isset($orderBiz->imageUrl)?$orderBiz->imageUrl:'' }}") no-repeat;
        }

        .ali-text {
            width: 336px;
            line-height: 32px;
        }

        .ali-text-title {
            position: relative;
            top: 28px;
            color: #ffe400;
            font-size: 24px;
            text-align: center;
        }

        .ali-text-desc {
            position: relative;
            left: 32px;
            top: 60px;
        }

        .ali-text-biz {
            position: relative;
            left: 32px;
            top: 276px;
            font-size: 18px;
        }

        .btn-bg {
            position: absolute;
            width: 200px;
            height: 52px;
            background: #11fbff;
        }

        .btn-bg-focus {
            position: absolute;
            width: 200px;
            height: 52px;
            background: #70ff78;
            border: #ff2400 4px solid;
        }

        .btn-text {
            text-align: center;
            color: #000000;
            font-size: 24px;
            line-height: 52px;
        }

        #btn0 {
            left: -45px;
            top: 266px;
        }

        #btn1 {
            left: 334px;
            top: 266px;
        }
    </style>
    <script type="text/javascript">
        window.code = "{{ $code }}";
        window.addressUrl = "{{ empty($addressUrl)?'':$addressUrl }}";
        window.queryUrl = "{{ empty($queryUrl)?'':$queryUrl }}";
        window.orderUrl = "{{ empty($orderUrl)?'':$orderUrl }}";
        window.callbackUrl = "{{ empty($callbackUrl)?'':$callbackUrl }}";
    </script>
</head>
<body>
@if($code==0)
    <div id="result-layout" class="result">
        <div class="result-icon" style="background: url({{ asset('img/hnyx/icon_0.png') }});"></div>
        <div class="result-title" style="color: #60ff00;">{{ $msg }}</div>
        <div class="result-text">
            <div style="font-weight: 700">支付凭证</div>
            <div style="position: absolute; top: 76px;">商家订单号：{{ $orderBiz->tradeNo }}</div>
            <div style="position: absolute; top: 37px;">交易号：{{ $orderBiz->serialNo }}</div>
            <div style="position: absolute; top: 115px;">交易金额：{{ $orderBiz->totalAmount/100 }}元</div>
            <div style="position: absolute; top: 154px;">交易日期：{{ $orderBiz->payTime }}</div>
        </div>
        <div id="btn0" class="btn-bg-focus">
            <div class="btn-text">快递地址</div>
        </div>
        <div id="btn1" class="btn-bg">
            <div class="btn-text">返回</div>
        </div>
    </div>
@elseif($code==1)
    <div id="result-layout" class="result">
        <div class="result-icon" style="background: url({{ asset('img/hnyx/icon_1.png') }});"></div>
        <div class="result-title" style="color: #ffd800;font-size: 26px">{{ $msg }}</div>
        <div class="result-text">
            <div style="position: absolute; top: 0;">{{ $subMsg }} 可以充值后，再尝试订购产品。</div>
            <div id="result-btn0" class="result-btn"></div>
            <div id="result-btn1" class="result-btn"></div>
        </div>
    </div>

    <div id="ali-layout" class="ali-bg">
        <div class="ali-text-amount">所需金额：{{ $orderBiz->totalAmount/100 }}元</div>
        <div class="ali-qr-img"></div>
        <div class="ali-text">
            <div class="ali-text-title">{{ $orderBiz->subject }}</div>
            <div class="ali-text-desc">{{ $orderBiz->body }}</div>

            <div class="ali-text-biz">客服电话：4001 6008 91</div>
            <div class="ali-text-biz">客服邮箱：toodo@toodo.com.cn</div>
            <div class="ali-text-biz">客服时间：周一到周日09:30-24:00</div>
            <div class="ali-text-biz">双动官网：toodo.com.cn</div>
        </div>
    </div>
@else
    <div id="result-layout" class="result">
        <div class="result-icon" style="background: url({{ asset('img/hnyx/icon_2.png') }});"></div>
        <div class="result-title" style="color: #ff2400;font-size: 26px">{{ $msg }}</div>
        <div class="result-text">
            <div style="position: absolute; top: 0;">{{ $subMsg }}</div>
        </div>
    </div>
@endif

<script src="{{ asset('js/hnyx/result.js?v='.md5_file(public_path('js/hnyx/result.js'))) }}"></script>
</body>
</html>
