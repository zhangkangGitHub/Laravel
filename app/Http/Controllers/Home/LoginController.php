<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class LoginController extends Controller
{
    //
    public function login()
    {
        // 加载登录页面
        return view('admin.login.login');
    }

    public function dologin(Request $request)
    {
        // dump($request->all());

        // $arr = [
        //     ['uname'=>'zhangkang','upass'=>Hash::make('123333')],
        //     ['uname'=>'lisi','upass'=>Hash::make('1233331')],
        //     ['uname'=>'admin','upass'=>Hash::make('1233313')],
        // ];

        // // dd($arr);
        
        // foreach ($arr as $key => $value) {
        //     DB::table('admin_users')->insert($value);
        //     // dd(DB::table('admin_users')->insert($value));
        // }

        // 获取用户名
        $uname = $request->input('uname','');
        $upass = $request->input('upass','');
        
        $userinfo = DB::table('admin_users')->where('uname',$uname)->first();
        // dump($userinfo);
        if (!$userinfo) {
            echo "<script>alert('用户名或者密码错误');location.href='/admin/login';</script>";
            exit;
        }

        // 验证密码
        if (!Hash::check($upass, $userinfo->upass)) {
            echo "<script>alert('用户名或者密码错误');location.href='/admin/login';</script>";
            exit;
        }

        // 登录成功
        session(['admin_login'=>true]);
        session(['admin_userinfo'=>$userinfo]);

        // 跳转
        return redirect('admin');
    }
} 
