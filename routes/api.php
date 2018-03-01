<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//! ===========================================================================
//! 双动科技基本接口
Route::group(['prefix' => 'toodo'], function () {
    //！全家e动接口
    Route::post('edo', '\App\Toodo\Edo\EdoController@toodo');
    //    Route::post('edo/user', '\App\Toodo\Edo\EdoController@user');
    //    Route::post('edo/page', '\App\Toodo\Edo\EdoController@page');
    //    Route::post('edo/game', '\App\Toodo\Edo\EdoController@game');
    //    Route::middleware('jwt.auth')->post('edo/game/down', '\App\Toodo\Edo\EdoController@downGame');
    //    Route::middleware('jwt.auth')->post('edo/game/run', '\App\Toodo\Edo\EdoController@runGame');

    //! 大厅接口
    //    Route::post('tdc', '\App\Toodo\Tdc\TdcController@toodo');
    Route::post('tde', '\App\Toodo\Tde\TdeController@toodo');

    //! 体感热舞
    Route::post('tda', '\App\Toodo\Tda\TdaController@toodo');

    //! 双动基本服务
    Route::post('', '\App\Toodo\ToodoController@toodo');
    Route::post('serve', '\App\Toodo\Serve\ServeController@toodo');
    Route::post('market', '\App\Toodo\Market\MarketController@toodo');
    Route::post('trade', '\App\Toodo\Trade\TradeController@toodo');
    //    Route::post('token', 'OneKeyLoginController@oneKeyLogin');
    //    Route::post('refresh', 'AuthenticateController@refreshToken');
    //    Route::middleware('jwt.auth')->post('user', 'AuthenticateController@getAuthenticatedUser');
    //    Route::middleware('jwt.auth')->post('call', '\App\Toodo\ToodoController@call');
});

Route::get('/coin', '\App\Toodo\Tde\TdeController@coin');
Route::get('/qrCode', '\App\Toodo\Tde\TdeController@qrCode');

//! ===========================================================================
//! 河南有线业务接口
Route::group(['prefix' => 'toodo/hnyx'], function () {
    Route::get('pay', '\App\Toodo\Hnyx\HnyxController@pay');
    Route::get('onCallback', '\App\Toodo\Hnyx\HnyxController@onCallback');
    Route::post('onCallback', '\App\Toodo\Hnyx\HnyxController@onCallback');

    Route::get('onConsume/{tradeNo}', '\App\Toodo\Hnyx\HnyxController@onConsume');
    Route::get('onIngest/{songId}/{opId}', '\App\Toodo\Hnyx\HnyxController@onIngest');
});

//！===========================================================================
//！联通小沃业务接口
Route::group(['prefix'=>'toodo/unicom'], function () {
    Route::get('onCallback', '\App\Toodo\Unicom\UnicomController@onCallback');
    Route::post('onCallback', '\App\Toodo\Unicom\UnicomController@onCallback');
});

//! ===========================================================================
//! 广西广电业务接口
Route::group(['prefix' => 'toodo/gxgd'], function () {
    Route::get('pay', '\App\Toodo\Gxgd\GxgdController@pay');
    Route::get('onCallback', '\App\Toodo\Gxgd\GxgdController@onCallback');
    Route::get('onIndex', '\App\Toodo\Gxgd\GxgdController@onIndex');

    Route::post('pay', '\App\Toodo\Gxgd\GxgdController@pay');
    Route::post('onCallback', '\App\Toodo\Gxgd\GxgdController@onCallback');
    Route::post('onNotice', '\App\Toodo\Gxgd\GxgdController@onNotice');

    //Route::resource('assets', '\App\Toodo\Gxgd\AssetController');
});
Route::get('/toodo/gxgd/asset/sync', '\App\Toodo\Gxgd\AssetController@sync');
Route::get('/toodo/gxgd/asset/query', '\App\Toodo\Gxgd\AssetController@query');

//! ===========================================================================
//! 广东广电业务接口
Route::group(['prefix' => 'toodo/gdgd'], function () {
    Route::get('test', '\App\Toodo\Gdgd\GdgdController@test');
    Route::post('test', '\App\Toodo\Gdgd\GdgdController@test');

    Route::get('wsdl', '\App\Toodo\Gdgd\GdgdController@wsdl');
    Route::post('pay', '\App\Toodo\Gdgd\GdgdController@pay');
    Route::post('onConfirm', '\App\Toodo\Gdgd\GdgdController@onConfirm');
    Route::post('onCallback', '\App\Toodo\Gdgd\GdgdController@onCallback');
    Route::post('onNotice', '\App\Toodo\Gdgd\GdgdController@onNotice');

    Route::get('/orderRelation', '\App\Toodo\Gdgd\SoapController@orderRelation');
    Route::get('/orderRelationAffirm', '\App\Toodo\Gdgd\SoapController@orderRelationAffirm');
    Route::get('/orderRelationLv2', '\App\Toodo\Gdgd\SoapController@orderRelationLv2');
    Route::get('/payAuth', '\App\Toodo\Gdgd\SoapController@payAuth');
    Route::get('/queryServInfo', '\App\Toodo\Gdgd\SoapController@queryServInfo');
    Route::get('/queryUserInfo', '\App\Toodo\Gdgd\SoapController@queryUserInfo');

    Route::post('/orderRelation', '\App\Toodo\Gdgd\SoapController@orderRelation');
    Route::post('/orderRelationAffirm', '\App\Toodo\Gdgd\SoapController@orderRelationAffirm');
    Route::post('/orderRelationLv2', '\App\Toodo\Gdgd\SoapController@orderRelationLv2');
    Route::post('/payAuth', '\App\Toodo\Gdgd\SoapController@payAuth');
    Route::post('/queryServInfo', '\App\Toodo\Gdgd\SoapController@queryServInfo');
    Route::post('/queryUserInfo', '\App\Toodo\Gdgd\SoapController@queryUserInfo');

    //! 广东广电SoapServer
    Route::get('/fsdp', '\App\Toodo\Gdgd\SoapController@fsdp');
    Route::post('/fsdp', '\App\Toodo\Gdgd\SoapController@fsdp');

    //! 广东广电BOSS
    Route::get('/boss/queryUserInfo', '\App\Toodo\Gdgd\BossController@queryUserInfo');
    Route::post('/boss/queryUserInfo', '\App\Toodo\Gdgd\BossController@queryUserInfo');
});


Route::group(['prefix' => 'git'], function () {
    Route::post('push', 'GitEventController@onPush');
    Route::post('test', 'GitEventController@onTest');
});