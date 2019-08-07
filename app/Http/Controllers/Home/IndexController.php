<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Userinfo;

class IndexController extends Controller
{
    //前台首页
    public function index()
    {
    	// 显示模板
    	dump($_SESSION);
    	// dump($_SESSION['home_users']->phone);
    	// dump($_SESSION['home_userinfo']->profile);
    	return view('home.index.index');
    }
}
