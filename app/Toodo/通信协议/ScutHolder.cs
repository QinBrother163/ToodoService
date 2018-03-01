using System;
using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Security.Cryptography;
using System.Text;
using com.toodo.trade;
using Newtonsoft.Json;

// ReSharper disable once CheckNamespace
namespace com.toodo
{
    public class ScutHolder : Singleton<ScutHolder>
    {
        //! /ToodoService/app/Toodo/Edo/EdoController.php
        const string AppId = "1000";
        const string AppSecret = "RcOFhtAYzwCGo91PGHdV";

        public string serverUrl {
            get;
            set;
        }
        public string token {
            get;
            protected set;
        }

        protected string[] methods = {
            "/toodo/trade/goods",   //0
            "/toodo/trade/create",  //1
            "/toodo/trade/confirm", //2
            "/toodo/trade/query1",  //3

            "/toodo/edo/user",      //4
            "/toodo/edo/page",      //5
            "/toodo/edo/game",      //6
            "/toodo/edo/game/run",  //7
            "/toodo/edo/game/down", //8

            "/toodo/edo", //! 统一信息接口
        };

        protected Payment payment;


        static string md5(string str) {
            string cl = str;
            string pwd = "";
            MD5 md5 = MD5.Create();//实例化一个md5对像
            // 加密后是一个字节类型的数组，这里要注意编码UTF8/Unicode等的选择　
            byte[] s = md5.ComputeHash(Encoding.UTF8.GetBytes(cl));
            // 通过使用循环，将字节类型的数组转换为字符串，此字符串是常规字符格式化所得
            for (int i = 0; i < s.Length; i++) {
                // 将得到的字符串使用十六进制类型格式。格式后的字符是小写的字母，如果使用大写（X）则格式后的字符是大写字符
                pwd = pwd + s[i].ToString("x2");
            }
            return pwd;
        }

        string signCodeIn(RequestBody inBody) {
            var str = ""
                      + inBody.appAuthToken
                      + inBody.appId
                      + inBody.bizContent
                      + inBody.charset
                      + inBody.format
                      + inBody.method
                      + inBody.timestamp
                      + inBody.version
                      + AppSecret;
            return md5(str);
        }

        string signCodeOut(ResponseBody outBody) {
            var str = ""
                + outBody.bizContent
                + outBody.code
                + outBody.msg
                + outBody.subCode
                + outBody.subMsg
                + outBody.timestamp
                + outBody.token
               + AppSecret;
            return md5(str);
        }

        protected IEnumerator waitEdo(RequestBody inBody, ResponseBody outBody) {
            serverUrl = "http://127.0.0.1:8000/api";

            inBody.appId = AppId;
            inBody.format = "JSON";
            inBody.charset = "utf-8";
            inBody.timestamp = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
            inBody.version = "1.0.0";
            inBody.appAuthToken = token;

            inBody.signCode = signCodeIn(inBody);

            //var apiUrl = string.Format("{0}{1}?token={2}", serverUrl, inBody.method, inBody.appAuthToken);
            var apiUrl = string.Format("{0}{1}?token={2}", serverUrl, "/toodo/edo", inBody.appAuthToken);

            var headers = new Dictionary<string, string>
            {
                { "Content-Type", "application/json" },
                { "Accept", "application/json" }
            };
            var json = JsonConvert.SerializeObject(inBody);
            var postData = Encoding.UTF8.GetBytes(json);
            var www = new WWW(apiUrl, postData, headers);


            var startTime = Time.time;
            var isTimeOut = false;

            while (true) {
                if (www.isDone) {
                    break;
                }
                if (!string.IsNullOrEmpty(www.error)) {
                    break;
                }
                if (Time.time - startTime > 3.14159f) { //! 超时
                    isTimeOut = true;
                    break;
                }

                yield return new WaitForEndOfFrame();
            }

            if (isTimeOut) {
                //! 超时
                outBody.code = 10000;
                outBody.msg = "客户端错误";
                outBody.subCode = "103";
                outBody.subMsg = "请求超时";

            } else {
                var error = www.error;

                if (string.IsNullOrEmpty(error)) {
                    Debug.Log(www.text);
                    //! 成功
                    try {
                        var result = JsonConvert.DeserializeObject<ResponseBody>(www.text);
                        outBody.code = result.code;
                        outBody.msg = result.msg;
                        outBody.subCode = result.subCode;
                        outBody.subMsg = result.subMsg;
                        outBody.timestamp = result.timestamp;
                        outBody.sign = result.sign;
                        outBody.bizContent = result.bizContent;
                        outBody.token = result.token;

                        var md5 = signCodeOut(outBody);
                        if (md5 != outBody.sign) {
                            outBody.code = 10000;
                            outBody.msg = "客户端错误";
                            outBody.subCode = "102";
                            outBody.subMsg = "返回结果签名出错";

                        }

                    } catch (Exception exception) {
                        Debug.Log(exception);

                        outBody.code = 10000;
                        outBody.msg = "客户端错误";
                        outBody.subCode = "101";
                        outBody.subMsg = "返回结果异常";
                    }

                } else {
                    Debug.Log(error);
                    if (www.isDone) {
                        File.WriteAllBytes("error.html", www.bytes);
                    }

                    //！出错
                    outBody.code = 10000;
                    outBody.msg = "客户端错误";
                    outBody.subCode = "104";
                    outBody.subMsg = "请求返回错误";
                }

                www.Dispose();
            }

            Debug.LogFormat("-e code:{0} msg:{1} subCode:{2} subMsg:{3}", outBody.code, outBody.msg, outBody.subCode, outBody.subMsg);
            if (outBody.code == 0) {
                if (!string.IsNullOrEmpty(outBody.token)) {
                    token = outBody.token;
                }
            }
        }

        public bool isReady() {
            return payment != null;
        }

        public int init(int retailId, string bizContent) {
            // ReSharper disable once RedundantAssignment
            int ret = -1;

            payment = gameObject.GetComponent<Payment>();

            if (!payment) {
                var typeName = string.Format("com.toodo.trade.Payment{0}", retailId);
                payment = gameObject.AddComponent(Type.GetType(typeName)) as Payment;
            }

            if (payment != null && !payment.isReady()) {
                ret = payment.init(retailId, bizContent);

                if (ret != 0) {
                    Destroy(payment);
                    payment = null;
                }

            } else {
                ret = 2009;
            }

            return ret;
        }

        public string getUser() {
            return isReady() ? payment.getUser() : string.Empty;
        }


        public virtual IEnumerator waitQuery(RequestBody inBody, ResponseBody outBody) {
            if (!isReady()) {
                outBody.code = 2008;
                yield break;
            }
            yield return StartCoroutine(payment.waitQueryInfo(inBody, outBody));
        }


        public IEnumerator waitTradePay(RequestBody inBody, ResponseBody outBody) {
            if (!isReady()) {
                outBody.code = 2008;
                yield break;
            }

            yield return StartCoroutine(payment.waitPay(inBody, outBody));
        }

        public IEnumerator waitEdoUser(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[4];

            var userIn = edo.UserIn.parse(inBody.bizContent);
            if (token != userIn.Token) {
                token = userIn.Token;
            }

            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitEdoGame(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[6];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitEdoPage(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[5];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitEdoGameDown(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[8];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitEdoGameRun(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[7];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }


        public IEnumerator waitTradeConfirm(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[2];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitTradeGoods(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[0];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitTradeCreate(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[1];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

        public IEnumerator waitTradeQuery1(RequestBody inBody, ResponseBody outBody) {
            inBody.method = methods[3];
            yield return StartCoroutine(waitEdo(inBody, outBody));
        }

    }
}