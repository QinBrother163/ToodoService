<?php

namespace App\Toodo\Gxgd;


use App\Toodo\Fast;

class GxgdSim
{
    /**
     * @param $biz queryProdInfoIn|prodOrderIn|consumeOrderIn|object
     * @return bool|object
     */
    public function toodo($biz)
    {
        $method = $biz->method;
        if ($method == 'prodOrder') return $this->prodOrder($biz);
        if ($method == 'consumeOrder') return $this->consumeOrder($biz);
        if ($method == 'queryProdInfo') return $this->queryProdInfo($biz);
        if ($method == 'promotionOrder') return $this->promotionOrder($biz);
        return false;
    }

    /**
     * @param $biz queryProdInfoIn|prodOrderIn|consumeOrderIn|object
     * @return object
     */
    public function prodOrder($biz)
    {
        $orderId = Fast::serialNo();
        $bodyOut = [
            'isSuccess' => 'T',
            'request' => $biz,
            'response' => [
                "resultCode" => "SUCCESS",
                "errorMsg" => '',
                'orderId' => $orderId,
                'orderUrl' => url('/api/toodo/gxgd/pay?orderId=' . $orderId),
            ],
        ];
        return json_decode(json_encode($bodyOut, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * @param $biz queryProdInfoIn|prodOrderIn|consumeOrderIn|object
     * @return object
     */
    public function consumeOrder($biz)
    {
        $orderId = Fast::serialNo();
        $bodyOut = [
            'isSuccess' => 'T',
            'request' => $biz,
            'response' => [
                "resultCode" => "SUCCESS",
                "errorMsg" => '',
                'orderId' => $orderId,
                'orderUrl' => url('/api/toodo/gxgd/pay?orderId=' . $orderId),
            ],
        ];
        return json_decode(json_encode($bodyOut, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * @param $biz queryProdInfoIn|prodOrderIn|consumeOrderIn|object
     * @return object
     */
    public function queryProdInfo($biz)
    {
        $bodyOut = [
            'isSuccess' => 'T',
            'request' => $biz,
            'response' => [
                "retCode" => "SUCCESS",
                "prodInfos" => [
                    "prodDto" => [
                        "prodId" => "404550070043",
                        "prodName" => "广电测试包月产品",
                        "prodType" => "73",
                        "status" => "正常",
                        "orderDate" => [],
                        "tariffs" => [
                            "tariffDto" => [
                                "tariffId" => "302771",
                                "priceValue" => "10.00",
                                "billingType" => [],
                                "billingTypeName" => "包月(按日)"
                            ]
                        ]
                    ]
                ]
            ],
        ];
        return json_decode(json_encode($bodyOut, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function queryPromotionInfo($biz)
    {
        $bizIn = [
            'method' => '',//	String	是	固定值：queryPromotionInfo
            'stbId' => '',//	String	是	机顶盒编号
            'productId' => '',//	String	是	产品ID，由广电IDC提供。
            'partner' => '',//	String 	是	商户ID，广电提供。
            'sign' => '',//	String	是	签名，参考4.签名效验章节说明
        ];
        $bizOut = [
            'prodId' => '',//	String	产品ID
            'prodName' => '',//	String	产品名称
            'prodType' => '',//	String	产品类型
            'status' => '',//	String	产品状态
            'orderDate' => '',//	String	订购日期，产品状态为“未订购”下为空
            'spId' => '',//	String	促销信息编号
            'spName' => '',//	String	促销信息名称
            'spRemark' => '',//	String	促销信息备注
            'tariffId' => '',//	String	资费ID
            'priceValue' => '',//	String	资费 单位：元
            'billingType' => '',//	String	计费方式
            'billingTypeName' => '',//	String	计费方式名称
        ];
    }

    public function queryPromotionDetailsInfo($biz)
    {
        $bizIn = [
            'method' => '',//	String	是	固定值：queryPromotionDetailsInfo
            'userId' => '',//	String	是	用户编号
            'productId' => '',//	String	是	产品ID，由广电IDC提供。
            'promotionId' => '',//	String 	是	促销ID
            'partner' => '',//	String 	是	商户ID，广电提供。
            'sign' => '',//	String	是	签名，参考4.签名效验章节说明
        ];
        $bizOut = [
            'promotion_id' => '',//	string	促销编号
            'busi_code' => '',//	string	业务编号
            'eff_date' => '',//	string	生效日期
            'exp_date' => '',//	string	失效日期
            'p_content' => '',//	string	促销描述
            'p_title' => '',//	string	促销标题
            'p_type' => '',//	string	促销类型 1充值、2订购、3赠送 5 特殊活动
            'promotion_cid' => '',//	string	子促销
            'unit' => '',//	string	参与促销单位 A 按金额，M 按月，P 金额等于固定值。
            'value' => '',//	string	参与促销最低值 A、P，单位元
            'presentCircle' => '',//	String	最大赠送周期，单位和资费单位一致。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
            'useCircle' => '',//	String	已使用周期，单位和资费单位一致。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
            'promotionPrice' => '',//	String	产品促销优惠价，单位：元。当用户查询不到促销产品或者对应字段没有设置的时候，字段值为空。
            'orderCircle' => '',//	String	最大订购周期。
        ];
    }

    /**
     * @param $biz object|promotionOrderIn
     * @return object
     */
    public function promotionOrder($biz)
    {
        $orderId = Fast::serialNo();
        $bodyOut = [
            'isSuccess' => 'T',
            'request' => $biz,
            'response' => [
                "resultCode" => "SUCCESS",
                "errorMsg" => '',
                'orderId' => $orderId,
                'orderUrl' => url('/api/toodo/gxgd/pay?orderId=' . $orderId),
            ],
        ];
        return json_decode(json_encode($bodyOut, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}