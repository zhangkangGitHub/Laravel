<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Brand extends FormRequest
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
            'bname' => 'required',
            'country' => 'required',
            'describe' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'bname' => '品牌名不能为空',
            'country' => '所属国家不能为空',
            'describe' => '简介不能为空'
        ];
    }
}