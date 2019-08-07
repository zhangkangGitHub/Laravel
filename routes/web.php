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

Route::group(['middleware'=>'alogin'],function(){

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

// //前台首页
// Route::get('/','Home\IndexController@index');

// //前台登录页面
// Route::get('home/user/login','Home\UserController@lindex');
// //执行前台登录
// Route::post('home/user/login','Home\UserController@store');

// //前台注册页面 邮箱 手机号
// Route::get('home/register','Home\RegisterController@index');
// //执行前台邮箱注册
// Route::post('home/register','Home\RegisterController@store');
// //执行前台邮箱注册激活
// Route::get('home/register/changestatus','Home\RegisterController@changestatus');
// //前台手机验证码
// Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
// //处理前台手机号注册数据
// Route::post('home/register/insert','Home\RegisterController@insert');

// //前台个人中心页面
// Route::get('home/user/userdetail','Home\UserController@uindex');

// //前台账户安全页面
// Route::get('home/user/usersecurity','Home\UserController@sindex');

// //前台收藏夹页面
// Route::get('home/user/usercollection','Home\UserController@cindex');

// //前台收货地址页面
// Route::get('home/user/user_addres','Home\UserController@aindex');

// //前台商品详情页面
// Route::get('home/shop/shopproduct','Home\ShopController@pindex');

// //前台查看购物车页面
// Route::get('home/shop/shopbuycar','Home\ShopController@c1index');

// //前台购物车确认结算页面
// Route::get('home/shop/shopbuycar_two','Home\ShopController@c2index');

// //前台成功提交订单页面
// Route::get('home/shop/shopbuycar_three','Home\ShopController@c3index');


//商家 登录 路由
Route::get('shop/login','Shop\LoginController@login');

//商家 处理登录 路由
Route::post('shop/login/dologin','Shop\LoginController@dologin');

//权限验证中间件
Route::group(['middleware'=>['login']],function(){

	//商家 首页路由
	Route::get('shop','Shop\IndexController@index');

	//商家 首页 柱形图页面路由
	Route::get('shop/inpic','Shop\InpicController@inpic');

	//商家 产品 产品管理 路由
	Route::get('shop/plist','Shop\ProductController@plist');

	//商家 产品 产品状态修改 路由
	Route::get('shop/product/state','Shop\ProductController@state')->name('id');

	//商家 产品 产品删除 路由
	Route::get('shop/product/delgoods','Shop\ProductController@delgoods');

	//商家 产品 添加商品 路由
	Route::get('shop/addgoods','Shop\ProductController@addgoods');

	//商家 产品 处理商品添加 路由
	Route::post('shop/prodcut/doaddGoods','Shop\ProductController@doaddGoods');

	//商家 产品 品牌管理 路由
	Route::get('shop/brand','Shop\ProductController@brand');

	//商家 产品 品牌状态修改 路由
	Route::get('shop/product/bstate','Shop\ProductController@bstate')->name('bid');

	//商家 产品 品牌删除 路由
	Route::get('shop/product/delbrand','Shop\ProductController@delbrand');

	//商家 产品 添加品牌 路由
	Route::get('shop/addbrand','Shop\ProductController@addbrand');

	//商家 产品 处理品牌添加 路由
	Route::post('shop/doaddbrand','Shop\ProductController@doaddbrand');

	//商家 交易 交易订单(图) 路由
	Route::get('shop/order','Shop\TradeController@order');

	//商家 交易 交易管理 路由
	Route::get('shop/orderform','Shop\TradeController@orderform');

	//商家 交易 订单类型选择 路由
	Route::get('shop/orderform','Shop\TradeController@orderform')->name('cid');

	//商家 交易 交易状态修改 路由
	Route::get('shop/trade/ostatus','Shop\TradeController@ostatus')->name('oid');

	//商家 交易 删除订单 路由
	Route::get('shop/trade/delorders','Shop\TradeController@delorders');

	//商家 交易 交易金额 路由
	Route::get('shop/amount','Shop\TradeController@amount');

	//商家 交易 退款管理 路由
	Route::get('shop/refund','Shop\TradeController@refund');

	//商家 交易 退款状态修改 路由
	Route::get('shop/trade/status','Shop\TradeController@status');

	//商家 交易 删除已退款订单 路由
	Route::get('shop/trade/delorder','Shop\TradeController@delorder');

	//店铺 店铺列表 路由
	Route::get('shop/slist','Shop\ShopsController@slist');

	//店铺 店铺审核 路由
	Route::get('shop/audit','Shop\ShopsController@audit');

	//评论 评论列表 路由
	Route::get('shop/comment','Shop\CommentController@clist');

	//评论 意见反馈 路由
	Route::get('shop/feedback','Shop\CommentController@feedback');

	//文章 文章列表 路由
	Route::get('shop/alist','Shop\ArticleController@alist');

	//文章 分类管理 路由
	Route::get('shop/asort','Shop\ArticleController@asort');

	//商家 退出登录 路由
	Route::get('shop/outlogin','Shop\LoginController@outlogin');
});
