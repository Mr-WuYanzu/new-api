<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/check','CheckUserController@check');
    $router->get('/update','CheckUserController@update');//通过审核
    $router->get('/del','CheckUserController@del');//驳回
    $router->resource('/user',UserController::class);//用户注册信息
});

