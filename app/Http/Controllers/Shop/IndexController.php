<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //商家后台
    public function index()
    {
    	return view('shop.index.index',['users'=>session('shop_userinfo')]);
    }
}
