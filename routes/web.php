<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function () {
    phpinfo();
});
//企业注册
Route::middleware('auth')->group(function(){
        Route::get('/reg','ApiregController@regview');
        Route::post('/regist','ApiregController@reg');
        Route::get('/firm/list','ApiregController@firm_list');
    //获取公司信息
        Route::get('/firm/list_do','ApiregController@firm_list_do');
});
Route::middleware(['access_token','Token'])->group(function(){
    //显示客户端ip
        Route::get('/clientip','api\ApiController@client_ip');
//    //显示客户端UA
//        Route::get('/clientua','api\ApiController@clientua');
//    //显示客户端UA
//        Route::get('/reginfo','api\ApiController@regInfo')->middleware(['Token','access_token']);
});
//获取access_token
    Route::get('/getAccess_token','token\TokenController@access_token')->middleware('Token');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
