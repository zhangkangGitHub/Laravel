<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [
            //第一个字段 代表要验证字段名字是什么
            //第二个字段(required) 代表验证的规则 必须填不能为空
            'uname' => 'required|regex:/^[a-zA-Z]{1}[\w]{7,15}$/|unique:users',
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
            'email' => 'required|email',
            'phone' => 'required|regex:/^1[3-9]{1}[\d]{9}$/',
            
        ];
    }

    public function messages()
    {
        return [
            'uname.required'=>'用户名不能为空!',
            'uname.regex'=>'用户名格式错误!',
            'uname.unique'=>'用户名已被注册!',

            'upass.required'=>'密码不能为空!',
            'upass.regex'=>'密码格式错误!',

            'repass.required'=>'确认密码不能为空!',
            'repass.same'=>'两次密码不一致,请重新确认!',

            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式错误!',
            // 'email.unique'=>'邮箱已被注册!',

            'phone.required'=>'手机号不能为空!',
            'phone.regex'=>'手机号格式错误!',
            // 'phone.unique'=>'手机号已注册!',
            
        ];
    }
}
