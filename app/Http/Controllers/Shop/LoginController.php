<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use Session;

class LoginController extends Controller
{
    //商家店铺登录
   	public function login()
   	{
   		return view('shop.login.login');
   	}

   	//处理登录
   	public function dologin()
   	{
   		$uname = $_POST['uname'];

   		$upass = $_POST['upass'];

   		//验证表单
   		if($uname == ''){
   			echo "<script>alert('请输入用户名');location.href='/shop/login';</script>";   			
      		exit;
   		}

   		if($upass == ''){
   			echo "<script>alert('请输入密码');location.href='/shop/login';</script>";   			
      		exit;
   		}

   		$users = DB::table('users')->where('uname',$uname)->first();

   		if(!$users){
			echo "<script>alert('用户名或者密码错误');location.href='/shop/login';</script>";			
   			exit;
   		}


   		// 验证密码正确
   		if (!Hash::check($upass, $users->upass)) {
   		    echo "<script>alert('用户名或者密码错误');location.href='/shop/login';</script>";   			
      		exit;
   		}

   		//验证身份
   		if($users->auth != '2'){
   			echo "<script>alert('您没有权限访问');location.href='/shop/login';</script>";
   			exit;
   		}

   		//查询用户详情
   		$users_info = DB::table('users_info')->where('uid',$users->id)->first();

   		//查询用户店铺
   		$shop = DB::table('shop')->where('uid',$users->id)->first();

   		//往数组压入信息
   		$users->nickname = $users_info->nickname;

   		$users->profile = $users_info->profile;

   		$users->sname = $shop->sname;

         $users->sid = $shop->id;
   		
   		// 登录成功
   		session(['shop_login'=>true]);
   		session(['shop_userinfo'=>$users]);

   		// 跳转
   		return redirect('shop');
   	}

      //退出登录
      public function outlogin(Request $request)
      {
         Session::forget('shop_login');
         Session::forget('shop_userinfo');

         // 跳转
         return redirect('shop/login');
      }
}
