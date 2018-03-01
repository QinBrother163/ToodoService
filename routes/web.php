<?php

use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index');

//接口
Route::get('/toodo/address', '\App\Toodo\Biz\BizController@address');

Route::get('/gxgd/adi', function (Request $request) {
    $songId = $request->input('song');
    $userId = $request->input('user');
    $stbId = $request->input('stb');
    $asset = \App\Toodo\Gxgd\TdoGxgdAsset::find($songId);
    return $asset->getMvUrl($userId, $stbId);
});


Route::get('/hnyx/payByQrCode', '\App\Toodo\Hnyx\HnyxController@payByQrCode');
Route::get('/hnyx/queryPayResult', '\App\Toodo\Hnyx\HnyxController@queryPayResult');
Route::get('/hnyx/address', '\App\Toodo\Hnyx\HnyxController@address');
Route::get('/hnyx/simConsume/{tradeNo}', '\App\Toodo\Hnyx\HnyxController@simConsume');


Route::get('/tdance', function (Request $request) {
    $ts = time();
    $url = $request->fullUrl();
    $url = str_replace('tdsrv/', '', $url) . "?ts=$ts";
    Log::debug('-e rd ' . $url);

    return redirect()->away($url);
});


Route::get('/toodo/tdc/page','\App\Toodo\Tdc\TdcController@page');
Route::get('/toodo/tdc/item','\App\Toodo\Tdc\TdcController@item');
Route::get('/toodo','\App\Toodo\ToodoController@onGoGo');
