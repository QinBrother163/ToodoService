(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId]){return installedModules[moduleId].exports}var module=installedModules[moduleId]={i:moduleId,l:false,exports:{}};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.l=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.i=function(value){return value};__webpack_require__.d=function(exports,name,getter){if(!__webpack_require__.o(exports,name)){Object.defineProperty(exports,name,{configurable:false,enumerable:true,get:getter})}};__webpack_require__.n=function(module){var getter=module&&module.__esModule?function getDefault(){return module["default"]}:function getModuleExports(){return module};__webpack_require__.d(getter,"a",getter);return getter};__webpack_require__.o=function(object,property){return Object.prototype.hasOwnProperty.call(object,property)};__webpack_require__.p="";return __webpack_require__(__webpack_require__.s=12)})([function(module,__webpack_exports__,__webpack_require__){"use strict";__webpack_require__.d(__webpack_exports__,"b",function(){return retail});__webpack_require__.d(__webpack_exports__,"a",function(){return retailId});var retail={gxgd:"96335",hnyx:"96266",gdgd:"96956",none:"1000"};function getRetailId(){try{if(guangxi&&iPanel){return retail.gxgd}}catch(e){}try{var System=window.System;if(System&&System.stbID){return retail.hnyx}}catch(e){}try{if(CA&&StorageService&&FileSystem){return retail.gdgd}}catch(e){}return retail.none}var retailId=getRetailId()},function(module,__webpack_exports__,__webpack_require__){"use strict";__webpack_require__.d(__webpack_exports__,"a",function(){return getKeyCodes});__webpack_require__.d(__webpack_exports__,"c",function(){return getEvent});__webpack_require__.d(__webpack_exports__,"d",function(){return getKey});__webpack_require__.d(__webpack_exports__,"b",function(){return getCodes});var __WEBPACK_IMPORTED_MODULE_0__retail__=__webpack_require__(0);function getKeyCodes(){var keyMap={};if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].gxgd){keyMap={up:38,down:40,left:37,right:39,ok:13,f1:400,f2:401,f3:403,f4:402,num1:49,num2:50,num3:51,num4:52,num5:53,num6:54,num7:55,num8:56,num9:57,num0:48,mute:518,back:399,track:406,volUp:517,volDown:516,fav:404,playBack:521,pageUp:33,pageDown:34,menu:515,esc:514,home:520}}else if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].hnyx){keyMap={up:38,down:40,left:37,right:39,ok:13,f1:112,f2:113,f3:114,f4:115,num1:49,num2:50,num3:51,num4:52,num5:53,num6:54,num7:55,num8:56,num9:57,num0:48,mute:77,back:66,track:82,volUp:190,volDown:188,fav:84,playBack:80,pageUp:33,pageDown:34,menu:72,esc:27,home:72}}else if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].gdgd){keyMap={up:87,down:83,left:65,right:68,ok:13,f1:400,f2:401,f3:402,f4:403,num1:49,num2:50,num3:51,num4:52,num5:53,num6:54,num7:55,num8:56,num9:57,num0:48,mute:67,back:8,track:86,volUp:61,volDown:45,fav:76,playBack:521,pageUp:306,pageDown:307,menu:72,esc:27,home:72}}else{keyMap={up:38,down:40,left:37,right:39,ok:13,f1:112,f2:113,f3:114,f4:115,num1:49,num2:50,num3:51,num4:52,num5:53,num6:54,num7:55,num8:56,num9:57,num0:48,mute:77,back:8,track:82,volUp:190,volDown:188,fav:84,playBack:80,pageUp:33,pageDown:34,menu:72,esc:27,home:72}}var key=65;keyMap.A=key++;keyMap.B=key++;keyMap.C=key++;keyMap.D=key++;keyMap.E=key++;keyMap.F=key++;keyMap.G=key++;keyMap.H=key++;keyMap.I=key++;keyMap.J=key++;keyMap.K=key++;keyMap.L=key++;keyMap.M=key++;keyMap.N=key++;keyMap.O=key++;keyMap.P=key++;keyMap.Q=key++;keyMap.R=key++;keyMap.S=key++;keyMap.T=key++;keyMap.U=key++;keyMap.V=key++;keyMap.W=key++;keyMap.X=key++;keyMap.Y=key++;keyMap.Z=key;if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].hnyx){keyMap.up2=keyMap.U;keyMap.down2=keyMap.O;keyMap.left2=keyMap.I;keyMap.right2=keyMap.E;keyMap.A=keyMap.J;keyMap.B=keyMap.K;keyMap.X=keyMap.L;keyMap.Y=keyMap.D}if(!keyMap.up2){keyMap.up2=keyMap.W;keyMap.down2=keyMap.S;keyMap.left2=keyMap.A;keyMap.right2=keyMap.D}return keyMap}function getEvent(evt){return evt||window.event}function getKey(evt){evt=getEvent(evt);return evt.keyCode||evt.which||evt.charCode}function getCodes(){var keyMap=getKeyCodes();var codes=[];for(var code in keyMap){if(keyMap.hasOwnProperty(code)){codes.push(keyMap[code])}}return codes}},function(module,__webpack_exports__,__webpack_require__){"use strict";__webpack_require__.d(__webpack_exports__,"b",function(){return parseArgs});__webpack_require__.d(__webpack_exports__,"a",function(){return httpGet});var parseQuery=function parseQuery(query){var start=query.indexOf("?");if(start>=0){query=query.slice(start+1)}var args={};var arr=query.split("&");for(var m=0;m<arr.length;m++){var v=arr[m];var tmp=v.split("=");args[tmp[0]]=decodeURIComponent(tmp[1])}return args};var parseArgs=function parseArgs(args){var k=void 0,v=void 0;var arr=[];for(k in args){
//! js 会把'0'当作false args[k] => args[k] !== ''
if(args.hasOwnProperty(k)&&args[k]!==""){v=encodeURIComponent(args[k]);arr.push(k+"="+v)}}return arr.join("&")};var httpGet=function httpGet(callback,url){if(!callback)return;if(!XMLHttpRequest){if(callback)callback(-1,"找不到XMLHttpRequest");return}var xml=new XMLHttpRequest;var handleTimeout=setTimeout(function(){xml.abort();if(callback)callback(103,"请求超时")},1e4);xml.onreadystatechange=function(){if(xml.readyState==4){clearTimeout(handleTimeout);callback(xml.status,xml.responseText)}};xml.open("GET",url,true);xml.send(null)}},function(module,__webpack_exports__,__webpack_require__){"use strict";Object.defineProperty(__webpack_exports__,"__esModule",{value:true});var __WEBPACK_IMPORTED_MODULE_0__retail__=__webpack_require__(0);if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].gxgd){try{iPanel.setGlobalVar("SEND_RETURN_KEY_TO_PAGE","1");iPanel.setGlobalVar("SEND_EXIT_KEY_TO_PAGE","1")}catch(e){}}else if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].hnyx){try{method.stopDefault(1)}catch(e){}}else if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].gdgd){}else{document.onkeypress=function(e){return false}}window.onunload=function(){if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].gxgd){try{iPanel.setGlobalVar("SEND_RETURN_KEY_TO_PAGE","0");iPanel.setGlobalVar("SEND_EXIT_KEY_TO_PAGE","0")}catch(e){}}else if(__WEBPACK_IMPORTED_MODULE_0__retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__retail__["b"].hnyx){}}},function(module,exports){var JSON;if(!JSON){JSON={}}(function(){"use strict";var global=Function("return this")(),JSON=global.JSON;if(!JSON){JSON={}}function f(n){return n<10?"0"+n:n}if(typeof Date.prototype.toJSON!=="function"){Date.prototype.toJSON=function(key){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+f(this.getUTCMonth()+1)+"-"+f(this.getUTCDate())+"T"+f(this.getUTCHours())+":"+f(this.getUTCMinutes())+":"+f(this.getUTCSeconds())+"Z":null};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(key){return this.valueOf()}}var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},rep;function quote(string){escapable.lastIndex=0;return escapable.test(string)?'"'+string.replace(escapable,function(a){var c=meta[a];return typeof c==="string"?c:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+string+'"'}function str(key,holder){var i,k,v,length,mind=gap,partial,value=holder[key];if(value&&typeof value==="object"&&typeof value.toJSON==="function"){value=value.toJSON(key)}if(typeof rep==="function"){value=rep.call(holder,key,value)}switch(typeof value){case"string":return quote(value);case"number":return isFinite(value)?String(value):"null";case"boolean":case"null":return String(value);case"object":if(!value){return"null"}gap+=indent;partial=[];if(Object.prototype.toString.apply(value)==="[object Array]"){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||"null"}v=partial.length===0?"[]":gap?"[\n"+gap+partial.join(",\n"+gap)+"\n"+mind+"]":"["+partial.join(",")+"]";gap=mind;return v}if(rep&&typeof rep==="object"){length=rep.length;for(i=0;i<length;i+=1){if(typeof rep[i]==="string"){k=rep[i];v=str(k,value);if(v){partial.push(quote(k)+(gap?": ":":")+v)}}}}else{for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?": ":":")+v)}}}}v=partial.length===0?"{}":gap?"{\n"+gap+partial.join(",\n"+gap)+"\n"+mind+"}":"{"+partial.join(",")+"}";gap=mind;return v}}if(typeof JSON.stringify!=="function"){JSON.stringify=function(value,replacer,space){var i;gap="";indent="";if(typeof space==="number"){for(i=0;i<space;i+=1){indent+=" "}}else if(typeof space==="string"){indent=space}rep=replacer;if(replacer&&typeof replacer!=="function"&&(typeof replacer!=="object"||typeof replacer.length!=="number")){throw new Error("JSON.stringify")}return str("",{"":value})}}if(typeof JSON.parse!=="function"){JSON.parse=function(text,reviver){var j;function walk(holder,key){var k,v,value=holder[key];if(value&&typeof value==="object"){for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v}else{delete value[k]}}}}return reviver.call(holder,key,value)}text=String(text);cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(a){return"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})}if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,""))){j=eval("("+text+")");return typeof reviver==="function"?walk({"":j},""):j}throw new SyntaxError("JSON.parse")}}global.JSON=JSON;module.exports=JSON})()},function(module,__webpack_exports__,__webpack_require__){"use strict";__webpack_require__.d(__webpack_exports__,"a",function(){return aliPage});var __WEBPACK_IMPORTED_MODULE_0__toodo_keycodes__=__webpack_require__(1);var __WEBPACK_IMPORTED_MODULE_1__toodo_url__=__webpack_require__(2);var JSON=__webpack_require__(4);var keyCode=__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__toodo_keycodes__["a"])();var preCodes=__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__toodo_keycodes__["b"])();function AliPage(){}AliPage.prototype={callback:null,handelQueryTimeOut:null,tryCnt:0,show:function show(callback,queryUrl){var bg=document.getElementById("ali-layout");if(bg){bg.style.display="block"}this.callback=callback;var owner=this;if(0){owner.hide(1,"充值失败");return}document.onkeydown=function(e){owner.handleKey(e)};owner.tryCnt=0;owner.query(queryUrl)},hide:function hide(code,msg){document.onkeydown=null;if(this.handelQueryTimeOut){clearTimeout(this.handelQueryTimeOut);this.handelQueryTimeOut=null}var bg=document.getElementById("ali-layout");if(bg){bg.style.display="none"}if(typeof this.callback==="function"){this.callback(code,msg)}this.callback=null},handleKey:function handleKey(e){var owner=this;e=__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__toodo_keycodes__["c"])(e);var curKey=__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__toodo_keycodes__["d"])(e);if(preCodes.indexOf(curKey)!=-1){try{e.preventDefault()}catch(e){}}switch(curKey){case keyCode.num0:case keyCode.back:case keyCode.esc:owner.hide(-1,"取消操作");break}},query:function query(url){var owner=this;owner.tryCnt++;__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__toodo_url__["a"])(function(status,result){if(status!=200){return owner.hide(1,"错误 返回码:"+status)}var bizOut=null;try{bizOut=JSON.parse(result)}catch(e){}if(!bizOut){return owner.hide(1,"错误 返回数据:"+result)}if(bizOut.code!="0000"&&bizOut.code!="0004"){return owner.hide(1,"查询失败")}if(bizOut.isPaid=="1"){return owner.hide(0,"充值成功")}
//! 轮询结果
owner.handelQueryTimeOut=setTimeout(function(){owner.query(url)},3e3)},url)}};var aliPage=new AliPage},,function(module,__webpack_exports__,__webpack_require__){"use strict";Object.defineProperty(__webpack_exports__,"__esModule",{value:true});var __WEBPACK_IMPORTED_MODULE_0__toodo_retail__=__webpack_require__(0);var __WEBPACK_IMPORTED_MODULE_1__AliPage__=__webpack_require__(5);__webpack_require__(3);var goBack=function goBack(){if(callbackUrl){window.location.href=callbackUrl;return}if(__WEBPACK_IMPORTED_MODULE_0__toodo_retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__toodo_retail__["b"].hnyx){if(navigator.userAgent.indexOf("Avit-07")!=-1){location.href="file://htmldata/mod/general/relogin.htm"}else if(navigator.userAgent.indexOf("Avit-09")!=-1){try{method.closeBrowser()}catch(e){}}else{try{var gvarRootUrl=new Global("superRootUrl");window.location.href=gvarRootUrl.value}catch(e){}}}if(__WEBPACK_IMPORTED_MODULE_0__toodo_retail__["a"]==__WEBPACK_IMPORTED_MODULE_0__toodo_retail__["b"].none){window.opener=null;window.open("","_self");window.close()}};var onAliPay=function onAliPay(code,msg){if(code==0){window.location.replace(orderUrl)}else if(code==-1){goBack()}else{window.location.replace(backUrl)}};var backUrl=decodeURIComponent(window.backUrl);var orderUrl=decodeURIComponent(window.orderUrl);var queryUrl=decodeURIComponent(window.queryUrl);var callbackUrl=decodeURIComponent(window.callbackUrl);window.onload=function(){__WEBPACK_IMPORTED_MODULE_1__AliPage__["a"].show(onAliPay,queryUrl)}},,,,,function(module,exports,__webpack_require__){module.exports=__webpack_require__(7)}]);