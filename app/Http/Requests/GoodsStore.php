<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsStore extends FormRequest
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
            'goods' => 'required',
            'gnum'  => 'required',
            'company' => 'required',
            'cid' => 'required',
            'bid' => 'required',
            'weight' => 'required',
            'unit' => 'required',
            'original' => 'required',
            'price' => 'required',
            'specification1' => 'required',
            'specification2' => 'required',
            'specification3' => 'required',
            'color1' => 'required',
            'color2' => 'required',
            'color3' => 'required',
            'antistop' => 'required',
            'descr' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'goods.required'=>'商品名必填',
            'gnum'  => '商品编号必填',
            'company' => '产地必填',
            'cid' => '类型必选',
            'bid' => '品牌比选',
            'weight' => '重量必填',
            'unit' => '单位必填',
            'original' => '原价必填',
            'price' => '售价必填',
            'specification1' => '规格1必填',
            'specification2' => '规格2必填',
            'specification3' => '规格3必填',
            'color1' => '型号1必填',
            'color2' => '型号2必填',
            'color3' => '型号3必填',
            'antistop' => '关键词必填',
            'descr' => '简介必填'
        ];
    }
}