<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Users;
use App\Models\Userinfo;

class LoginController extends Controller
{
	//显示登录页面
	public function index()
	{
		return view('home.login.login');

	}

	//操作登录数据
	 public function store(Request $request)
    {
        // dd($request->all());
        $users = new Users;
        //获取信息
        $name = $request->input('user');
        $upass = $request->input('upass');

        $users = DB::table('users')->where('uname',$name)->first();
        // dd($upass,$users,$users->upass);
        // dd(Hash::make($upass));
        // 判断用户名是否存在
        if(!$users){
            echo "<script>alert('用户名错误');location.href='/home/login';</script>";
            exit;
        }

        // 判断密码是否输入正确
        if(!Hash::check($upass, $users->upass)){
            echo "<script>alert('密码错误,请重新输入');location.href='/home/login';</script>";
            exit;
        }

        $uinfo = new Userinfo;
        $id = $users->id;
        $userinfo = DB::table('users_info')->where('uid',$id)->first();

        //登录成功
        $_SESSION["home_login"] = true;
        $_SESSION["home_users"] = $users;
        $_SESSION["home_userinfo"] = $userinfo;

        // dd($_SESSION);

        //跳转
        return redirect('/');
    }

    //注销 
    public function laout() 
    {
    	// dd($_SESSION);
    	session_unset();
    	// echo "退出成功";
    	return redirect('/');
    }
}