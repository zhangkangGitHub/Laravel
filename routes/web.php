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








































































































































//前台首页
Route::get('/','Home\IndexController@index');

//前台登录页面
Route::get('home/login','Home\LoginController@index');
//执行前台登录
Route::post('home/login','Home\LoginController@store');

//前台注销 退出
Route::get('home/login/laout','Home\LoginController@laout');

//前台注册页面 邮箱 手机号
Route::get('home/register','Home\RegisterController@index');
//执行前台邮箱注册
Route::post('home/register','Home\RegisterController@store');
//执行前台邮箱注册激活
Route::get('home/register/changestatus','Home\RegisterController@changestatus');
//前台手机验证码
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
//执行前台手机号注册数据
Route::post('home/register/insert','Home\RegisterController@insert');

//前台个人中心页面
Route::get('home/user/userdetail','Home\UserController@uindex');
//执行前台个人信息修改
Route::post('home/user/phone','Home\UserController@phone');

//前台账户安全页面
Route::get('home/user/usersecurity','Home\UserController@sindex');

//前台收藏夹页面
Route::get('home/user/usercollection','Home\UserController@cindex');

//前台收货地址页面
Route::get('home/user/user_addres','Home\UserController@aindex');

//前台我的订单页面
Route::get('home/user/user_order','Home\UserController@oindex');

//前台商品详情页面
Route::get('home/shop/shopproduct','Home\ShopController@pindex');

//前台查看购物车页面
Route::get('home/shop/shopbuycar','Home\ShopController@c1index');

//前台购物车确认结算页面
Route::get('home/shop/shopbuycar_two','Home\ShopController@c2index');

//前台成功提交订单页面
Route::get('home/shop/shopbuycar_three','Home\ShopController@c3index');





