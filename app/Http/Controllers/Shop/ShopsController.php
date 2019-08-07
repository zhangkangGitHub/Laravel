<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    //店铺列表
    public function slist()
    {
    	return view('shop.shops.slist');
    }

    //店铺审核
    public function audit()
    {
    	return view('shop.shops.audit');
    }
}
