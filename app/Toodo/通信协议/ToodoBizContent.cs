using System;
using System.Collections.Generic;


// ReSharper disable once CheckNamespace
namespace com.toodo
{
    using Int = Int32;

    public class UserIn : BizContent<UserIn>
    {
        public String retailId;  //	渠道编号
        public String regionCode;//	区域
        public String cardTV;    // 设备ID
    }
    public class UserOut : BizContent<UserIn>
    {
        public String userId;    //	用户编号
        public String retailId;  //	渠道编号
        public String regionCode;//	区域
        public String cardTV;    // 设备ID
    }

    public class RefreshIn : BizContent<RefreshIn>
    {
    }
    public class RefreshOut : BizContent<RefreshOut>
    {
    }
}