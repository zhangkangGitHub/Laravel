<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //评论列表
    public function clist()
    {
    	return view('shop.comment.clist');
    }

    //意见反馈
    public function feedback()
    {
    	return view('shop.comment.feedback');
    }
}
