<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Item;
use DB;

class InpicController extends Controller
{
    //引入信息柱形图
   	public function inpic()
    {
    	$sid = session('shop_userinfo')->sid;

    	//查询订单表
    	$orders = DB::select('select * from orders where sid = '.$sid);

    	//获取当前年份
    	$time = date('Y',time());
    	
    	//设置每月中全部订单数组
    	$Morders = [
    		0 => 0,
    		1 => 0,
    		2 => 0,
    		3 => 0,
    		4 => 0,
    		5 => 0,
    		6 => 0,
    		7 => 0,
    		8 => 0,
    		9 => 0,
    		10 => 0,
    		11 => 0,
    		12 => 0
    	];

    	//设置每月中代付款订单数组
    	$pfo = [
    		0 => 0,
    		1 => 0,
    		2 => 0,
    		3 => 0,
    		4 => 0,
    		5 => 0,
    		6 => 0,
    		7 => 0,
    		8 => 0,
    		9 => 0,
    		10 => 0,
    		11 => 0,
    		12 => 0
    	];

    	//设置每月中代发货订单数组
    	$pm = [
    		0 => 0,
    		1 => 0,
    		2 => 0,
    		3 => 0,
    		4 => 0,
    		5 => 0,
    		6 => 0,
    		7 => 0,
    		8 => 0,
    		9 => 0,
    		10 => 0,
    		11 => 0,
    		12 => 0
    	];

    	//设置每月中已收货订单数组
    	$sd = [
    		0 => 0,
    		1 => 0,
    		2 => 0,
    		3 => 0,
    		4 => 0,
    		5 => 0,
    		6 => 0,
    		7 => 0,
    		8 => 0,
    		9 => 0,
    		10 => 0,
    		11 => 0,
    		12 => 0
    	];

    	foreach($orders as $k=>$v){
    		//判断是否为当前年份
    		if(date('Y',strtotime($orders[$k]->created_at))){
    			//计算出当前年份中每个月份的订单量
	    		if(date('m',strtotime($orders[$k]->created_at)) == '01'){
	    			$Morders[0]++;
	    			//计算出当前月份中代付款 已付款 和已发货订单
	    			if($orders[$k]->status == '1'){
	    				$pfo[0]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[0]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[0]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '02'){
	    			$Morders[1]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[1]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[1]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[1]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '03'){
	    			$Morders[2]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[2]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[2]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[2]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '04'){
	    			$Morders[3]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[3]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[3]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[3]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '05'){
	    			$Morders[4]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[4]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[4]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[4]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '06'){
	    			$Morders[5]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[5]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[5]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[5]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '07'){
	    			$Morders[6]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[6]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[6]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[6]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '08'){
	    			$Morders[7]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[7]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[7]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[7]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '09'){
	    			$Morders[8]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[8]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[8]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[8]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '10'){
	    			$Morders[9]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[9]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[9]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[9]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '11'){
	    			$Morders[10]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[10]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[10]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[10]++;
	    			}
	    		}else if(date('m',strtotime($orders[$k]->created_at)) == '12'){
	    			$Morders[11]++;
	    			if($orders[$k]->status == '1'){
	    				$pfo[11]++;
	    			}else if($orders[$k]->status == '2'){
	    				$pm[11]++;
	    			}else if($orders[$k]->status == '4'){
	    				$sd[11]++;
	    			}
	    		}
	    	}
    	}

    	//加载视图
    	return view('shop.inpic.inpic',['Morders'=>$Morders,'pfo'=>$pfo,'pm'=>$pm,'sd'=>$sd]);
    }
}
