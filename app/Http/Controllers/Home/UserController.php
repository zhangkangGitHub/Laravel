<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Users;

class UserController extends Controller
{
    /**
     * 显示登录页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function lindex()
    {
        //加载登录页面
        return view('home.user.login');
    }

    /**
     * 操作登录数据.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            echo "<script>alert('用户名错误');location.href='/home/user/login';</script>";
            exit;
        }

        // 判断密码是否输入正确
        if(!Hash::check($upass, $users->upass)){
            echo "<script>alert('密码错误');location.href='/home/user/login';</script>";
            exit;
        }


        //登录成功
        session(['home_login'=>true]);
        session(['home_users'=>$users]);

        //跳转
        return redirect('/');
        
    }

    //显示个人中心页面
    public function uindex()
    {
        //页面显示
        return view('home.user.userdetail');
    }

    //显示账户安全页面
    public function sindex()
    {
        //页面显示
        return view('home.user.usersecurity');
    }

    //显示收藏夹页面
    public function cindex()
    {
        //页面显示
        return view('home.user.usercollection');
    }

    //显示收货地址页面
    public function aindex()
    {
        //显示页面
        return view('home.user.user_addres');
    }

    /**
     * 显示添加页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
 
    /**
     * 显示详情.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 执行修改操作.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
