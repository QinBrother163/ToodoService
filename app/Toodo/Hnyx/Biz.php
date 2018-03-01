<?php

namespace App\Toodo\Hnyx;


class OwnBill
{
    public $tradeNo;     //交易号
    public $productId;   //产品编号
    public $goodsId;     //商品编号
    public $serialNo;    //支付流水号
    public $payTimeout;  //最晚付款时间
    public $queryTime;   //查询时间     每15秒查询一次
    public $queryCnt;    //已查询次数   在第15、30、60、120、240、480、960、1920秒各查询一次
}


class PayByQrCodeRequest
{
    public $tvnNum; //String	用户的TVN号码。
    public $amount; //double	总金额，单位为分，必须大于1，小于500000
    public $channelCode; //String 	渠道类型code。	tv, huge
    public $size; //int	二维码尺寸。	默认8,范围1-20，1 = 45px
}

class PayByQrCodeResponse //二维码支付订单
{
    public $code; //返回编码	成功：0000，失败：其他
    public $message;
    public $imageUrl; //二维码图片地址，有效时长30分
    public $businessSN; //业务流水号，唯一
    public $qrCodeValue; //二维码值
}

class QueryPayResultRequest
{
    public $businessSN;    //String	业务流水号，唯一。
}

class QueryPayResultResponse
{
    /**
     * @var $code
     * 错误码    说明
     * 0000    请求成功。
     * 0001    客户信息不存在。
     * 0002    金额参数不正确
     * 0003    内部错误。
     * 0004    查不到该订单信息
     * 0005    二维码尺寸不正确
     */
    public $code;    //String	返回编码	成功：0000，失败：其他
    public $message;    //String	返回信息	错误信息
    public $isPaid;    //String	是否已支付	0 未支付1 支付
    public $noticeBoss;    //String	是否已通知Boss	0 未通知boss1 已通知boss
}


class OrderProdIn
{
    public $cseq;
    public $csi;
    public $stamp;
    public $token;
    public $tgt;
    public $productId;
    public $productType;
    public $assetId;
    public $backUrl;
}

class OrderProdOut
{
    public $cseq;
    public $tvnNumber;
    public $productId;
    public $assetId;
    /**
     * @var $returnCode string
     * 00000000    成功
     * 00000001    安全校验失败
     * 00000002    内部错误
     * 00000010    客户信息不存在,TGT失效
     * 00020101    该产品已购买
     * 00020102    产品已过有效期
     * 00020103    产品不存在
     * 00020104    产品状态非法
     * 00020106    客户状态非法
     * 00020306    用户状态非法
     * 00020307    未经授权的内容
     * 300001    抱歉，查询预存款余额信息失败，请稍候再试！
     * 300002    抱歉，预存款余额信息未建立，请前往营业厅办理！
     * 300003    抱歉，此产品包信息未被发布，不能订购！
     * 300004    抱歉，预存款余额不足，不能订购此产品！
     * 300005    抱歉，订购失败，请稍候再试！
     * 300006    抱歉，订购此产品包失败，请重新选择其他产品包！
     * 300007    抱歉，您已经订购了此产品包，不能重复订购！
     * 300008    抱歉，此产品包只能在营业厅办理，请莅临就近营业厅办理此业务！
     * 300009    抱歉，您的预存款余额不足，不能订购此产品！
     */
    public $returnCode;
    public $activeTime;
}

class AuthProdIn
{
    public $cseq;
    public $csi;
    public $stamp;
    public $token;
    public $tgt;
    public $productId;
    public $resourceId;
    public $serviceId;
}

class AuthProdOutData
{
    /**
     * @var $subFlag
     * 00000001    安全校验失败
     * 00000002    内部错误
     * 00020301    产品信息不存在
     * 00020302    产品状态非法
     * 00020303    内容不存在
     * 00020304    内容状态非法
     * 00020306    用户状态非法
     * 00000010    客户信息不存在,TGT失效
     */
    public $subFlag;
    public $ts;
}

class AuthProdOut
{
    /** @var  AuthProdOutData */
    public $DataArea;
}


class ConsumeProdIn
{
    public $businessInfoId;
    public $stbId;
    public $goodsId;
    public $name;
    public $spId;
    public $token;
    public $stamp;
    public $backUrl;
}

class ConsumeProdOut
{
    /**
     * @var $errorCode
     *   1    订购成功
     * 203    发送给boss处理出现错误
     * 204    boss订购出现未知错误
     * 205    订购信息缓存失败
     */
    public $errorCode;
    public $stbId;
    public $price;
    public $stamp;
    public $token;
}


class SimPayIn
{
    public $appId;
    public $serialNo;
    public $ts;
    public $sign;
}

class SimPayOutBiz
{
    public $serialNo;
    public $tradeStatus;
}

class SimPayOut
{
    public $code;
    public $msg;
    public $ts;
    public $sign;
    /** @var  SimPayOutBiz */
    public $biz;
}


class bizUser
{

}

class bizOrder            //二维码支付订单
{
    public $code; //返回编码	成功：0000，失败：其他
    public $message;
    public $imageUrl; //二维码图片地址，有效时长30分
    public $businessSN; //业务流水号，唯一
    public $qrCodeValue; //二维码值

    public $orderUrl;// 在线支付地址
    public $consume; // true:一次性消费订单 false:持续周期订单
}
