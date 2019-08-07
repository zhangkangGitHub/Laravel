<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //文章列表
    public function alist()
    {
    	return view('shop.article.alist');
    }

    //分类管理
    public function asort()
    {
    	return view('shop.article.asort');
    }
}
