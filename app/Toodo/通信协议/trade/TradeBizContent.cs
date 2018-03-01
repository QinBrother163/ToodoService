using System;

namespace com.toodo.trade
{
    using Int = Int32;

    /// <summary>
    /// 确认订单支付
    /// toodo.trade.confirm
    /// </summary>
    public class ConfirmIn : BizContent<ConfirmIn>
    {
        public string orderNo;
        public string tradeNo;
        public DateTime tradeTime;
    }
    public class ConfirmOut : BizContent<ConfirmOut>
    {
        public string orderNo;
        public int payStatus;
    }

    /// <summary>
    /// 查询商品信息
    /// toodo.trade.goods
    /// </summary>
    public class GoodsIn : BizContent<GoodsIn>
    {
        public Int pageIndex;//页面索引
        public Int pageSize;//一页有多少项目
        public Int merchantId;//商店编号：1000指全家e动
    }
    public class GoodsOut : BizContent<GoodsOut>
    {
        public class GoodsData
        {
            public Int Id;//商品Id
            public Int MerchantId;//商店编号
            public Int GoodsType;//商品类型-未使用
            public String Name;//商品名称
            public String Description;//简单介绍
            public String HeadIcon;//图标名称
            public Int LimitNumber;//限制数量
            public Int MarketPrice;//商店标价 单位：分
            public Int SellPrice;//交易价格 单位：分
            public Int Quantity;//商品存量、数量
            public Int TradeType;//单位符号-未使用
            public Int Status;//商品状态
            public Int SeqNo;//排列序号
        }

        public Int pageCount;//一共有多少页信息
        public Int pageIndex;//当前的页面索引
        public Int pageSize;//一页有多少项目
        public GoodsData[] goodsDatas;
    }

    /// <summary>
    /// 创建订单
    /// toodo.trade.create
    /// </summary>
    public class CreateIn : BizContent<CreateIn>
    {
        public class GoodsDetail
        {
            public int id;//商品的编号
            public string name;//商品名称
            public int quantity;//商品数量
            public int price;//商品单价，单位为分
        }

        public Int merchantId;//商店编号
        public GoodsDetail[] goodsDetails;//商品列表
    }
    public class CreateOut : BizContent<CreateOut>
    {
        public class OrderData
        {
            public int Id;
            public string OrderNo;
            public decimal Amount;
            public string SerialNumber;
            public string PassportId;
            public int GameId;
            public int PayStatus;
            public string Signature;
            public DateTime CreateDate;
            public string DeviceId;
            public int UserId;
            public int ShopId;
            public int ExpiryDate;
        }

        public OrderData orderData;
        public string subject;//订单标题
    }

    /// <summary>
    /// 查询未支付订单
    /// toodo.trade.query1
    /// </summary>
    public class Query1In : BizContent<Query1In>
    {
        public int merchantId;//商店编号
        public int pageIndex;
        public int pageSize;//!一页有多少项
    }
    public class Query1Out : BizContent<Query1Out>
    {
        public int merchantId;//商店编号
        public int pageIndex;//! 当前页索引 [0, pageCount-1]
        public int pageSize;//! 一页有多少项
        public int count;//! 一共多少项
        public CreateOut.OrderData[] orderDatas;
    }

    /// <summary>
    /// 支付订单
    /// toodo.trade.pay
    /// </summary>
    public class PayIn : BizContent<PayIn>
    {
        public class RetailInfo
        {
            public string productId;//! 产品关键字 pid
            public string contentId;//！内容提供商 sid
        }
        public CreateOut.OrderData orderData;
        public RetailInfo retailInfo;
        public string subject;
        public string lastPayTime;
    }

    public class PayOut : BizContent<PayOut>
    {
        public string orderNo;
        public string tradeNo;
        public string tradeTime;
        public string bizContent;
    }

}
