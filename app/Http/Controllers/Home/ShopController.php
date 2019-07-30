<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * 显示商品详情页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function pindex()
    {
        //页面显示
        return view('home.shop.shopproduct');
    }

    //查看购物车页面
    public function c1index() 
    {
        //页面显示
        return view('home.shop.shopbuycar');
    }

    //查看购物车确认结算页面
    public function c2index() 
    {
        //页面显示
        return view('home.shop.shopbuycar_two');
    }

    //查看成功提交订单页面
    public function c3index()
    {
        //页面显示
        return view('home.shop.shopbuycar_three');
    }

    /**
     * 显示添加页面.
     *i
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
