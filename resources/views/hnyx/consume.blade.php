<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>双动科技-消费跳转</title>
    <style>
        body {
            background: url("{{ asset('img/hnyx/bg.png') }}") no-repeat;
            width: 1280px;
            height: 720px;
            margin: 0;
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
            width: 270px;
            height: 270px;
            background: url("{{ isset($orderBiz->imageUrl)?$orderBiz->imageUrl:'' }}") no-repeat;
        }

        .ali-text {
            position: absolute;
            left: 32px;
            top: 16px;
            width: 288px;
            height: 256px;

            color: #ffffff;
            font-size: 20px;
            line-height: 32px;
        }

        .ali-text-title {
            color: #ffe400;
            font-size: 24px;
            text-align: center;
            line-height: 64px;
        }

        .ali-biz {
            position: absolute;
            left: 26px;
            top: 365px;
            width: 288px;
            height: 128px;

            color: #ffffff;
            font-size: 18px;
            line-height: 32px;
        }

    </style>
    <script type="text/javascript">
        window.backUrl = "{{ empty($backUrl)?'':$backUrl }}";
        window.orderUrl = "{{ empty($orderUrl)?'':$orderUrl }}";
        window.queryUrl = "{{ empty($queryUrl)?'':$queryUrl }}";
        window.callbackUrl = "{{ empty($callbackUrl)?'':$callbackUrl }}";
    </script>
</head>
<body>
<div id="ali-layout" class="ali-bg">
    <div class="ali-text-amount">所需金额：<span style="font-size: 28px;">{{ $orderBiz->totalAmount/100 }}元</span></div>
    <div class="ali-qr-img"></div>

    <div class="ali-text">
        <div class="ali-text-title">{{ $desc[0] }}</div>
        @if(count($desc)==5)
            <div>
                * {{ $desc[1] }} <br/>
                * {{ $desc[2] }} <br/>
                * <span style="color: #FF1493;font-weight: 400;">{{ $desc[3] }}</span> <span style="color: #ADFF2F">{{ $desc[4] }}</span>
            </div>
        @elseif(count($desc)==4)
            <div>
                * {{ $desc[1] }} <br/>
                * {{ $desc[2] }} <i style="color: #FF0000;font-size: 16px"><s>{{ $desc[3] }}</s></i>
            </div>
        @elseif(count($desc)==3)
            <div>
                * {{ $desc[1] }} {{ $desc[2] }}<br/>
            </div>
        @endif
    </div>
    <div class="ali-biz">
        客服电话：400-160-0891<br/>
        客服邮箱：toodo@toodo.com.cn<br/>
        客服时间：周一至周五 09:30-18:00<br/>
        双动官网：toodo.com.cn
    </div>
</div>

<script src="{{ asset('js/hnyx/consume.js?v='.md5_file(public_path('js/hnyx/consume.js'))) }}"></script>
</body>
</html>
