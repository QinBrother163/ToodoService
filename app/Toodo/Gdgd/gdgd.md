SP反向订购服务地址：
商用局：反向同步订购关系
http://172.16.145.199:9007/services/sp
http://103.27.24.36:9007/services/sp        外网
测试局：反向同步订购关系
http://10.207.151.17:9007/services/sp
http://103.27.24.122:9007/services/sp       外网

FSDP后台
http://103.27.24.34:8080/aspportal/index/index_load.action
账号：广州飞奔科技有限公司
密码：phiben2017

5.1    童锁验证页面接口
FSDP童锁页面请求地址：
http://172.16.145.197:8080/sdpportal/childLockAction_childlock.action
以POST方式传参
测试环境：
http://10.207.151.23:8080/sdpportal/childLockAction_childlock.action

5.2    在线支付页面接口
FSDP二次确认页面请求地址：
http://172.16.145.197:8080/sdpportal/feePayAction_feePay.action
以POST方式传参
测试环境：
http://10.207.151.23:8080/sdpportal/feePayAction_feePay.action

198块直接消费
http://10.205.22.158/payplatform/prodorder/prod-order-tv!doOrder



GET http://127.0.0.1:8000/api/toodo/gdgd/queryUserInfo?streamingNO=11111111111111111111&timeStamp=20171010140000&devNO=3072631065&CARegionCode=101
 -- response --
200 OK
Host:  127.0.0.1:8000
Connection:  close
X-Powered-By:  PHP/5.6.30
Cache-Control:  no-cache, private
Content-Type:  application/json
Date:  Wed, 11 Oct 2017 07:22:37 GMT
X-RateLimit-Limit:  60
X-RateLimit-Remaining:  58

{"resultInfo":{"streamingNO":"11111111111111111111","resultCode":"0","custid":"760002944277","servID":"760016594594","servstatus":"2","stoplock":"","userName":"\u7701\u516c\u53f8\u5e02\u573a\u90e8\u94f6\u6cb3\u65e0\u5361\u7f51\u5173\u6d4b\u8bd5\u673a","devNO":"3072631065","catvID":"","areaid":"100","branchno":"GZ","custtype":"0","isinarr":"","resultDesc":"\u6b63\u5e38\u8c03\u7528"}}
