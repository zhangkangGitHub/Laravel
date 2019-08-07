<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Userinfo;

class UserController extends Controller
{
    // 显示我的订单页面
    public function oindex()
    {
        return view('home.user.user_order');
    }
    
    //显示个人中心页面
    public function uindex()
    {
        //页面显示
        // dump($_SESSION);
        return view('home.user.userdetail');
    }

    //执行个人信息修改
    public function phone(Request $request)
    {
        dd($request->all());

        // 获取信息
        $users = new Users;
        $uname = $request->input('uname','');
        $upass = $request->input('pass','');
        $phone = $request->input('phone','');
        $email = $request->input('email','');

        $users = DB::table('users')->where('uname',$uname)->first();
        
        // 判断是否修改成功
        if($users->save()){
            echo "<script>alert('修改成功');location.href='/home/user/userdetail';</script>";
        }
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
