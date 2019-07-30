<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 显示登录页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function lindex()
    {
        //页面显示
        return view('home.user.login');
    }

    //显示注册页面
    public function rindex()
    {
        //页面显示
        return view('home.user.register');
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
     * 执行添加操作.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
