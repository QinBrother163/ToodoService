using System;
using System.Collections.Generic;


// ReSharper disable once CheckNamespace
namespace com.toodo.edo
{
    using Int = Int32;

    public class UserIn : BizContent<UserIn>
    {
        public String DeviceId;//9001_toodo001 	设备ID
        public String Token;//	授权码
        public Int retailId;//	渠道编号
    }
    public class UserOut : BizContent<UserOut>
    {
        public class EdoUser : BizContent<EdoUser>
        {
            public class Item
            {
                public string ItemId;
                public int GoodsId;
                public DateTime CreateDate;
                public DateTime ExpiryDate;
                public int GoodsNum;
                public int GoodsType;
            }
            public class Biz2 : BizContent<Biz2>
            {
                public string lastPayTime; //! 上一次成功支付时间
            }

            public int UserId;
            public String NickName;
            public String PassportId;
            public String RetailId;
            public List<Item> Items;
            public Biz2 bizContent;
        }

        public class Biz
        {
            public string productId;//! 产品关键字 pid
            public string contentId;//！内容提供商 sid
            public int chargeMode; //运营模式
        }

        public String SessionId;//登录语句 从服务器上得到的句柄
        public String UserId;//用户ID 带Z前缀是预登录表中的
        public Int UserType;//0:Guest；1：正式
        public String LoginTime;//登录时间 例：2011-10-11 13:20
        public Int GuideId;//引导客户端判断跳转哪个接口 1005：创建角色
        public String PassportId;//通行证ID
        public String Token;//授权码
        public EdoUser edoUser;
        public Biz bizContent;
    }


    public class PageIn : BizContent<PageIn>
    {
        public int page;//信息页面编号/0.主页、1.体感游戏
    }
    public class PageOut : BizContent<PageOut>
    {
        public class ItemInfo
        {
            public Int id;//项目索引
            public String itemName;//名称
            public Int itemId;//关联项目Id
            public Int itemType;//项目类型/0.游戏、1.广告、2.主题
            public String itemPicture;//项目图片
            public Int pictureType;//图片规格类型/0.横、1.竖
            public String itemDescription;//简述
            public int operateType;//游戏操作方式
            public int propId; //单次启动游戏的收费
        }

        public ItemInfo[] itemInfos;
    }


    public class GameIn : BizContent<GameIn>
    {
    }
    public class GameOut : BizContent<GameOut>
    {
        public class GameInfo : BizContent<GameInfo>
        {
            public Int gameId;//游戏Id
            public String gameName;//游戏名称
            public String gameNameCn;//游戏中文名
            public String gameDescription;//游戏介绍
            public Int gameType;//游戏类型/ 0.zip、 1.apk
            public String packageName;//游戏包名
            public Int versionCode;//版本序号
            public String gameUrl;//游戏地址
            public String gameVersion;//游戏版本
            public Int gameSize;//游戏大小/kb
            public String resUrl;//资源地址
            public String resVersion;//资源本版
            public Int resSize;//资源大小/kb
        }

        public GameInfo[] gameInfos;
    }


    public class RunGameIn : BizContent<RunGameIn>
    {
        public Int gameId;//游戏编号
        public Int versionCode;//版本序号
    }
    public class RunGameOut : BizContent<RunGameOut>
    {
    }


    public class DownGameIn : BizContent<DownGameIn>
    {
        public Int gameId;//游戏编号
        public Int versionCode;//版本序号
        public String fileInfos;//资源列表： fileName fileVersion
        public Int flag;//操作序号
    }
    public class DownGameOut : BizContent<DownGameOut>
    {
    }
}