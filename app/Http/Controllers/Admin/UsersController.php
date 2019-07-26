<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStore;
use APP\Models\users;

class UsersController extends Controller
{ 
    /**
     * 后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "用户的首页";
    }

    /**
     * 显示添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示页面
        return view('admin.users.create');
        
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersStore $request)
    {
        //
        // $this->validate($request, [
        //     //第一个字段 代表要验证字段名字是什么
        //     //第二个字段(required) 代表验证的规则 必须填不能为空
        //     'username' => 'required|regex:/^[a-zA-Z]{1}[\w]{7,15}$/',
        //     'pass' => 'required|regex:/^[\w]{6,18}$/',
        //     'repass' => 'required|same:pass',
        //     'email' => 'required|email',
        //     'phone' => 'required|regex:/^1[3-9]{1}[\d]{9}$/',
            
        // ],[
        //     'username.required'=>'用户名不能为空!',
        //     'username.regex'=>'用户名格式错误!',

        //     'pass.required'=>'密码不能为空!',
        //     'pass.regex'=>'密码格式错误!',

        //     'repass.required'=>'确认密码不能为空!',
        //     'repass.same'=>'两次密码不一致,请重新确认!',

        //     'email.required'=>'邮箱不能为空!',
        //     'email.email'=>'邮箱格式错误!',

        //     'phone.required'=>'手机号不能为空!',
        //     'phone.regex'=>'手机号格式错误!',
        // ]);

        dump($request->input());
        
        $user = new Users;

    }

    /**
     * 显示详情页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 执行修改操作
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
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
