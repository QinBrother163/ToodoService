TVN置换  192.168.6.81:8081
SPID=12000002
产品id=661 
产品包id=941

用户信息转换接口的IP地址及端口：192.168.6.81:8081
产品订购的IP地址及端口：192.168.6.81:8081
鉴权接口的IP地址及端口：192.168.6.81:8081

//波波的接口
private string serviceProvideID = "12000002";
private string receiveURL = "http://10.63.70.181/payret/PayResult.php";

http://IP:PORT/gateway/rechargeServlet?businessInfoId=10000000&stbId=20800230&goodsId=VODC2013050609562303&name=%E7%A9%BA%E4%B8%AD%E7%9B%91%E7%8B%B1&spId=&token=&stamp=&backUrl=
http://www.baidu.com?errorCode=1&stbId=20800230&price=100&stamp=1382948746625&token=CC7937849E7F15C20E4FD38962A5E9C5

http://spgw.henancatv.com


1 大网服务器地址信息：
 	账号密码： root Admin888 
  	91段IP信息：172.30.91.34/35 
  	111段是和终端交互的 172.30.111.34/35 

2 接口地址：spgw.henancatv.com:端口号 
  172.30.93.225:8080(不用) 
3 SPID=12358071
4 MD5加密方法与测试环境一致（32位大写）加密KEY：csi_csi_stamp .


php artisan hnyx:asset delete 10011,10016
-e delete in: 
```xml
<?xml version="1.0" encoding="UTF-8"?>
<Root cseq="1504667572702"><DelAssets csi="12000002" stamp="1504667572702" token="2BB8D6AA224CDB8437E611E24FBC77D6"><Asset assetId="VODC1709011721240401"/><Asset assetId="VODC1709011803480501"/></DelAssets></Root>
```
-e delete out: 200
```xml
<?xml version="1.0" encoding="utf-8" standalone="yes"?>
<Root cseq="1504667572702"><DelRes token="2BB8D6AA224CDB8437E611E24FBC77D6" stamp="1504667572702"><Success><Asset assetId="VODC1709011721240401"/><Asset assetId="VODC1709011803480501"/></Success><Failure/></DelRes></Root>
```
