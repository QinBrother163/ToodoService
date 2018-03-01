<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>双动科技-填写收货地址</title>
    <style type="text/css">
        body {
            background: url("{{ asset('img/hnyx/bg.png') }}") no-repeat;
            width: 1280px;
            height: 720px;
            margin: 0;
        }

        .address-bg1 {
            position: absolute;
            left: 350px;
            top: 235px;
            width: 579px;
            height: 337px;
            background: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .address-text {
            position: absolute;
            left: 157px;
            width: 336px;
            color: #ffffff;
            font-size: 20px;
            line-height: 32px;
        }

        #address-name {
            top: 71px;
        }

        #address-phone {
            top: 107px;
        }

        #address-address {
            top: 142px;
        }

        .address-bg2 {
            position: absolute;
            left: 138px;
            top: 160px;
            width: 1000px;
            height: 460px;
            background: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .address-text-op {
            position: absolute;
            left: 109px;
            top: 126px;
            width: 490px;
            /*height: 256px;*/

            text-align: left;
            color: #ffffff;
            font-size: 20px;
            line-height: 35px;
        }

        .address-qr-img {
            position: absolute;
            left: 628px;
            top: 100px;
            width: 256px;
            height: 256px;
            /*background: rgba(17, 251, 255, 0.3);*/
            background: url("{{ empty($qrUrl)?'':$qrUrl }}") no-repeat;
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
            left: 48px;
            top: 268px;
        }

        #btn1 {
            left: 332px;
            top: 268px;
        }

        #btn2 {
            left: 360px;
            top: 368px;
        }
    </style>
    <script type="text/javascript">
        window.queryUrl = "{{ empty($queryUrl)?'':$queryUrl }}";
        window.callbackUrl = "{{ empty($callbackUrl)?'':$callbackUrl }}";
    </script>
</head>
<body>
<div id="address-out-layout" class="address-bg1">
    <div id="address-name" class="address-text">收货人：答复风</div>
    <div id="address-phone" class="address-text">手机：13986999692</div>
    <div id="address-address" class="address-text">地址：广州市黄埔区广州市黄埔区广州市黄埔区广州市黄埔区广州市黄埔区广州市黄埔区</div>
    <div id="btn0" class="btn-bg-focus">
        <div class="btn-text">修改地址</div>
    </div>
    <div id="btn1" class="btn-bg">
        <div class="btn-text">关闭</div>
    </div>
</div>

<div id="address-in-layout" class="address-bg2">
    <div class="address-text-op">
        只要3步，轻松输入快递地址：<br>
        1、用手机扫描二维码，在手机端输入快递地址，然后点击 下一步；<br>
        2、在手机端，核对信息，点击 确定 查看结果；<br>
        3、如果您已经完成手机端的两步操作，正确提交快递地址，请点击 我已完成 按钮。<br>
    </div>
    <div class="address-qr-img"></div>
    <div id="btn2" class="btn-bg-focus">
        <div class="btn-text">我已完成</div>
    </div>
</div>

<div id="address-loading" class="address-bg1">
    <div style="text-align: center;color: #ffffff;font-size: 36px;line-height: 300px">正在查询,请稍候...</div>
</div>

<script src="{{ asset('js/hnyx/address.js?v='.md5_file(public_path('js/hnyx/address.js'))) }}"></script>
</body>
</html>
