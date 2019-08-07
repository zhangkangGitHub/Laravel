<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebRequest extends FormRequest
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

    // 自定义验证规则
    public function rules()
    {
        return [
            'title'=>'required | min:2 | max:100',
            'keyword'=>'required | min:2 | max:250',
            'cright'=>'required',
            'description'=>'required | min:2',
            
        ];
    }

    // 自定义错误删输出
    public function messages()
    {
        return [
            'title.required' => '网站标题的必填的',
            'description.required'  => '网站描述是必填的',
            'description.min'  => '网站描述最少是2个词',
            'title.min'=>'网站的标题最少是2个词',
            'title.max'=>'网站的标题最大是2个词',
            'keyword.required'=>'网站关键字是必填的',
            'keyword.min'=>'网站关键字最少是2个词',
            'keyword.max'=>'网站关键字最多是250个词',
            'cright.required'=>'网站的版权是必填的',
            
        ];
    }
}
