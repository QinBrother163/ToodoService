using System;

namespace com.toodo
{
    public class ResponseBody
    {
        /// <summary>
        /// @code 网关返回码
        /// @msg 网关返回码描述
        /// </summary>
        public int code {
            get;
            set;
        }
        public String msg {
            get;
            set;
        }
        public String subCode;   // 业务返回码,详见文档:xxxx
        public String subMsg;    // 业务返回码描述,详见文档:交易已被支付
        public String timestamp; // 应答的时间
        public String sign;      // 签名,详见文档 32位小写
        public String bizContent;// 业务参数集合，最大长度不限，除公共参数外所有返回参数都必须放在这个参数中传递，具体参照各产品快速接入文档
        public String token; // 更新后的授权码,为空则不更新
    }
}
