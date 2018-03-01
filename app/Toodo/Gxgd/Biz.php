<?php

namespace App\Toodo\Gxgd;


// queryProdInfo
use App\User;

class queryProdInfoIn
{
    public $method;
    public $stbId;
    public $productId;
    public $partner;
    public $sign;
}

class TariffDto
{
    public $tariffId;
    public $priceValue;
    public $billingType;
    public $billingTypeName;
    public $timeFeeDate;
}

class ProdDto
{
    public $prodId;
    public $prodName;
    public $prodType;
    public $status;
    public $orderDate;
    public $tariffs;
    //促销
    public $spId;
    public $spName;
    public $spRemark;
}

class PromotionDto
{
    public $promotionId;//	string	促销编号
    public $busiCode;//	string	业务编号
    public $effDate;//	string	生效日期
    public $expDate;//	string	失效日期
    public $pContent;//	string	促销描述
    public $pTitle;//	string	促销标题
    public $pType;//	string	促销类型 1充值、2订购、3赠送 5 特殊活动
    public $promotionCid;//	string	子促销
    public $unit;//	string	参与促销单位 A 按金额，M 按月，P 金额等于固定值。
    public $value;//	string	参与促销最低值 A、P，单位元
    public $presentCircle;//	String	最大赠送周期，单位和资费单位一致。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
    public $useCircle;//	String	已使用周期，单位和资费单位一致。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
    public $promotionPrice;//	String	产品促销优惠价，单位：元。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
    public $orderCircle;//	String	最大订购周期。
}

class queryProdInfoOut
{
    public $retCode;
    public $resultMessage;
    public $prodInfos;
}

// prodOrder
class prodOrderIn
{
    public $method;
    public $productId;
    public $productName;
    public $productDesc;
    public $tariffId;
    public $qty;
    public $userId;
    public $stbId;
    public $areaCode;
    public $partner;
    public $callbackUrl;
    public $noticeUrl;
    public $appIndexUrl;
    public $unitPrice;
    public $isHD;
    public $sign;
}

// consumeOrder
class consumeOrderIn
{
    public $method;
    public $stbId;
    public $userId;
    public $areaCode;
    public $productId;
    public $amount;
    public $partner;
    public $productName;
    public $sprId;
    public $isHD;
    public $callbackUrl;
    public $noticeUrl;
    public $appIndexUrl;
    public $sign;
}

class promotionOrderIn
{
    public $method;// String	是	固定值：promotionOrder
    public $userId;// String	是	用户ID
    public $stbId;// String	是	机顶盒编号
    public $areaCode;// String	是	用户区域码
    public $isHD;// String	是	机顶盒类型, "720P"高清,"480P"标清
    public $productId;// String	是	产品ID
    public $productName;// String	是	产品名称
    public $promotionId;// String	是	促销编号
    public $ptitle;// String	是	促销标题
    public $amount;// String	是	金额
    public $tariffId;// String	是	资费ID
    public $partner;// String	是	商户ID
    public $callbackUrl;// String	是	回调URL
    public $noticeUrl;// String	是	通知URL
    public $appIndexUrl;// String	是	应用首页URL
    public $sign;// String	是	签名，参考4.签名效验章节说明
}

class OrderOut
{
    public $resultCode;
    public $errorMsg;
    public $orderId;
    public $orderUrl;
}

class OrderCallback
{
    public $retCode;
    public $retMsg;
    public $orderId;
    public $handleTime;
    public $totalFee;
    public $partner;
    public $stbId;
    public $productId;
    public $productName;
    public $sign;
}

class bizUser
{
    public $userId;
    public $stbId;
    public $areaCode;
    public $search;
}

class bizOrder
{
    public $method;
    public $orderId;
    public $orderUrl;
}

class AuthIn
{
    /** @var User */
    public $user;
    public $productId;


    public $nns_func;
    public $nns_user_id;
    public $nns_product_id;
    public $nns_video_id;
    public $nns_cp_id;
    public $nns_output_type;
}

class AuthOut
{
    public $state;
    public $reason;
    public $is_support_preview;
    public $preview_time;
}