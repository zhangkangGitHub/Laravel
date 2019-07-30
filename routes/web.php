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






























//后台 首页 路由
Route::get('admin','Admin\IndexController@index');

//后台 用户 路由
Route::resource('admin/users','Admin\UsersController');






















































//前台首页
Route::get('/','Home\IndexController@index');

//前台登录页面
Route::get('home/user/login','Home\UserController@lindex');

//前台注册页面
Route::get('home/user/register','Home\UserController@rindex');

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



