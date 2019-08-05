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
    session(['admin_login'=>null]);
    session(['admin_userinfo'=>null]);
    return view('welcome');
});





















































































// 后台 登录 路由
Route::get('admin/login','Admin\LoginController@login');

// 后台 执行登录 路由
Route::post('admin/login/dologin','Admin\LoginController@dologin');

Route::group(['middleware'=>'login'],function(){

    //后台 首页 路由
    Route::get('admin','Admin\IndexController@index');

    //后台 用户 路由
    Route::resource('admin/users','Admin\UsersController');

    //后台 分类 路由
    Route::resource('admin/cates','Admin\CatesController');

    //后台 管理员 管理
    Route::resource('admin/adminuser','Admin\AdminuserContreller');

    // 后台 权限 管理
    Route::resource('admin/nodes','Admin\NodesController');



});





















































