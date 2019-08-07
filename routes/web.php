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

    // 后台 角色 管理
    Route::resource('admin/roles','Admin\RolesController');

    // 后台 权限 管理
    Route::resource('admin/nodes','Admin\NodesController');

    // 后台 网站配置 管理
    Route::get('admin/webs','Admin\webController@web');

    // 后台 修改 网站配置
    Route::post('admin/web/doweb','Admin\webController@doweb');

});











//前台首页
Route::get('/','Home\IndexController@index');

//前台登录页面
Route::get('home/user/login','Home\UserController@lindex');
//执行前台登录
Route::post('home/user/login','Home\UserController@store');

//前台注册页面 邮箱 手机号
Route::get('home/register','Home\RegisterController@index');
//执行前台邮箱注册
Route::post('home/register','Home\RegisterController@store');
//执行前台邮箱注册激活
Route::get('home/register/changestatus','Home\RegisterController@changestatus');
//前台手机验证码
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
//处理前台手机号注册数据
Route::post('home/register/insert','Home\RegisterController@insert');

//前台个人中心页面
Route::get('home/user/userdetail','Home\UserController@uindex');

//前台账户安全页面
Route::get('home/user/usersecurity','Home\UserController@sindex');

//前台收藏夹页面
Route::get('home/user/usercollection','Home\UserController@cindex');

//前台收货地址页面
Route::get('home/user/user_addres','Home\UserController@aindex');

//前台商品详情页面
Route::get('home/shop/shopproduct','Home\ShopController@pindex');

//前台查看购物车页面
Route::get('home/shop/shopbuycar','Home\ShopController@c1index');

//前台购物车确认结算页面
Route::get('home/shop/shopbuycar_two','Home\ShopController@c2index');

//前台成功提交订单页面
Route::get('home/shop/shopbuycar_three','Home\ShopController@c3index');









































