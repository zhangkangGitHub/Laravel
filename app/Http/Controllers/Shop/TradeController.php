<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use DB;

class TradeController extends Controller
{
    //交易订单(图)
    public function order()
    {
        //获取店铺id
        $sid = session('shop_userinfo')->sid;

        //查询数据库
        $orders = DB::table('orders')
            ->join('shipping', 'orders.shid', '=','shipping.id')
            ->where('orders.sid', '=', $sid)
            ->where('orders.status','=','4')
            ->select('shipping.*','orders.*')
            ->get();

        //设置各地区订单数量数组
        $country = array(
            'hebei' => 0,
            'beijing' => 0,
            'tianjin' => 0,
            'shanghai' => 0,
            'chongqing' => 0,
            'henan' => 0,
            'yunnan' => 0,
            'liaoning' => 0,
            'heilongjiang' => 0,
            'hunan' => 0,
            'anhui' => 0,
            'shandong' => 0,
            'xinjiang' => 0,
            'jiangsu' => 0,
            'zhejiang' => 0,
            'jiangxi' => 0,
            'hubei' => 0,
            'guangxi' => 0,
            'gansu' => 0,
            'shanxi' => 0,
            'neimeng' => 0,
            'shanxis' => 0,
            'jilin' => 0,
            'fujian' => 0,
            'guizhou' => 0,
            'guangdong' => 0,
            'qinghai' => 0,
            'xizang' => 0,
            'sichuan' => 0,
            'ningxia' => 0,
            'hainan' => 0,
            'taiwan' => 0,
            'xianggang' => 0,
            'aomen' => 0,
        );

        foreach($orders as $k=>$v){
            //计算每个省的订单数量
            if(strstr($v->acode,'河北') != false){
                $country['hebei']++;
            }
            if(strstr($v->acode,'北京') != false){
                $country['beijing']++;
            }
            if(strstr($v->acode,'天津') != false){
                $country['tianjin']++;
            }
            if(strstr($v->acode,'上海') != false){
                $country['shanghai']++;
            }
            if(strstr($v->acode,'重庆') != false){
                $country['chongqing']++;
            }
            if(strstr($v->acode,'河南') != false){
                $country['henan']++;
            }
            if(strstr($v->acode,'云南') != false){
                $country['yunnan']++;
            }
            if(strstr($v->acode,'辽宁') != false){
                $country['liaoning']++;
            }
            if(strstr($v->acode,'黑龙江') != false){
                $country['heilongjiang']++;
            }
            if(strstr($v->acode,'湖南') != false){
                $country['hunan']++;
            }
            if(strstr($v->acode,'安徽') != false){
                $country['anhui']++;
            }
            if(strstr($v->acode,'山东') != false){
                $country['shandong']++;
            }
            if(strstr($v->acode,'新疆') != false){
                $country['xinjiang']++;
            }
            if(strstr($v->acode,'江苏') != false){
                $country['jiangsu']++;
            }
            if(strstr($v->acode,'浙江') != false){
                $country['zhejiang']++;
            }
            if(strstr($v->acode,'江西') != false){
                $country['jiangxi']++;
            }
            if(strstr($v->acode,'湖北') != false){
                $country['hubei']++;
            }
            if(strstr($v->acode,'广西') != false){
                $country['guangxi']++;
            }
            if(strstr($v->acode,'甘肃') != false){
                $country['gansu']++;
            }
            if(strstr($v->acode,'山西') != false){
                $country['shanxi']++;
            }
            if(strstr($v->acode,'内蒙古') != false){
                $country['neimenggu']++;
            }
            if(strstr($v->acode,'陕西') != false){
                $country['shanxi']++;
            }
            if(strstr($v->acode,'吉林') != false){
                $country['jilin']++;
            }
            if(strstr($v->acode,'福建') != false){
                $country['fujian']++;
            }
            if(strstr($v->acode,'贵州') != false){
                $country['guizhou']++;
            }
            if(strstr($v->acode,'广东') != false){
                $country['guangdong']++;
            }
            if(strstr($v->acode,'青海') != false){
                $country['qinghai']++;
            }
            if(strstr($v->acode,'西藏') != false){
                $country['xizang']++;
            }
            if(strstr($v->acode,'四川') != false){
                $country['sichuan']++;
            }
            if(strstr($v->acode,'宁夏') != false){
                $country['ningxia']++;
            }
            if(strstr($v->acode,'海南') != false){
                $country['hainan']++;
            }
            if(strstr($v->acode,'台湾') != false){
                $country['taiwan']++;
            }
            if(strstr($v->acode,'香港') != false){
                $country['xianggang']++;
            }
            if(strstr($v->acode,'澳门') != false){
                $country['aomen']++;
            }
        }

    	return view('shop.trade.order',['country'=>$country]);
    }

    //交易管理
    public function orderform(Request $request)
    {
        $code = $request->input('code','');

        $cid = $request->input('cid','');

        //获取店铺id
        $sid = session('shop_userinfo')->sid;

        //查询订单所属分类
        if($cid == ''){
            $result = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->join('cates', 'goods.cid', '=','cates.id')
                ->where('orders.sid', '=', $sid)
                ->where('orders.code','like','%'.$code.'%')
                ->select('goods.*','cates.cname','orders.*')
                ->paginate(5);
        }else{
            $result = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->join('cates', 'goods.cid', '=','cates.id')
                ->where('cates.cname','=',$cid)
                ->where('orders.sid', '=', $sid)
                ->where('orders.code','like','%'.$code.'%')
                ->select('goods.*','cates.cname','orders.*')
                ->paginate(5);
        }

        $results = DB::table('orders')
            ->join('goods', 'goods.id', '=','orders.gid')
            ->join('cates', 'goods.cid', '=','cates.id')
            ->where('orders.sid', '=', $sid)
            ->select('orders.*','goods.*','cates.cname')
            ->get();

        //遍历图片路径
        foreach($result as $k=>$v){

            $v->picname = explode(',',$v->picname)[0];

            if($v->status == '2'){
                $v->status = '发货';
            }else if($v->status == '3'){
                $v->status = '已发货';
            }else if($v->status == '4'){
                $v->status = '已收货';
            }else if($v->status == '1'){
                $v->status = '新订单';
            }

        }

        $cate = [];

        $cates = [];
        //遍历出全部订单的类型
        foreach($results as $k=>$v){
            $cate[$k] = $v->cname;
           
        }

        //去除数组中重复的值
        $cate = array_unique($cate);
        //遍历出每个类型的订单数
        foreach($cate as $k=>$v){
            $cates[$k] = 0;
            foreach($results as $key=>$value){
                if($v == $value->cname){
                    $cates[$k]++;
                }
            }
        }

        //计算出全部订单数
        $all = count($results);

        //设置全部类型订单百分比变量
        $portion = [];

        foreach($cates as $k=>$v){
            $portion[$k] = ceil($v/$all*100);
        }

        //设置颜色数组
        $color = ['#D15B47','#87CEEB','#87B87F','#d63116','#ff6600','#2ab023','#1e3ae6','#c316a9','#13a9e1'];

    	return view('shop.trade.orderform',['cate'=>$cate,'cates'=>$cates,'all'=>$all,'portion'=>$portion,'color'=>$color,'result'=>$result,'requests'=>$request->input()]);
    }

    //订单状态修改
    public function ostatus()
    {
        $id = $_GET['oid'];

        //获取id为$id的商品信息
        $orders = Orders::find($id);

        //判断商品的状态
        $orders->status = '3';

        $res1 = $orders->save();

        return back()->with('success','修改成功');
    }

    //删除订单
    public function delorders(Request $request)
    {
        $id = $request->input('id');

        $res = Orders::where('id',$id)->delete();

        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    //交易金额
    public function amount(Request $request)
    {
        //获取参数
        $all = isset($_GET['all'])?$_GET['all']:'';

        //获取店铺id
        $sid = session('shop_userinfo')->sid;

        //查询店铺已成交订单
        $orders = DB::table('orders')->where('sid',$sid)->where('status','4')->get();

        $order = '';

        if($all == 1){
            $tm = date('Y-m-d',time());
            $order = DB::table('orders')->where('sid',$sid)->where('status','4')->where('updated_at','like','%'.$tm.'%')->paginate(5);
        }else if($all == 2){
            $tm = date('Y-m',time());
            $order = DB::table('orders')->where('sid',$sid)->where('status','4')->where('updated_at','like','%'.$tm.'%')->paginate(5);
        }else if($all == ''){
            //查询店铺已成交订单加分页
            $order = DB::table('orders')->where('sid',$sid)->where('status','4')->paginate(5);
        }

        $total = 0;

        $totals = 0;

        $num = 0;

        $time = date('Y-m-d',time());

        foreach($orders as $k=>$v){

            $total += $v->total;

            if(explode(' ',$v->updated_at)[0] == $time){
                $totals += $v->total;
            }
            $num++;
        }
        // dd($order);
    	return view('shop.trade.amount',['all'=>$all,'total'=>$total,'totals'=>$totals,'num'=>$num,'time'=>$time,'order'=>$order,'requests'=>$request->input()]);
    }

    //退款管理
    public function refund(Request $request)
    {
        $goods = $request->input('goods','');

        $status = $request->input('status','');

        //获取店铺id
        $sid = session('shop_userinfo')->sid;

        //查询全部退款订单
        if($goods != ''){
            $order = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->where('goods.goods','=',$goods)
                ->where('orders.sid',$sid)->where('orders.status','=','5')->orwhere('orders.status','=','6')
                ->paginate(5);
        }else{
            $order = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->where('orders.sid',$sid)->where('orders.status','=','5')->orwhere('orders.status','=','6')
                ->paginate(5);
        }

        if($status == 6){
            $order = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->where('orders.sid',$sid)->where('orders.status','=','6')
                ->paginate(5);
        }else if($status == 5){
            $order = DB::table('orders')
                ->join('goods', 'goods.id', '=','orders.gid')
                ->where('orders.sid',$sid)->where('orders.status','=','5')
                ->paginate(5);
        }

        foreach($order as $k=>$v){
            if($v->status == '5'){
                $v->status = '待退款';
            }if($v->status == '6'){
                $v->status = '已退款';
            }
        }

        //退款订单数量
        $count = count($order);

    	return view('shop.trade.refund',['count'=>$count,'order'=>$order,'requests'=>$request->input()]);
    }

    //退款状态修改
    public function status()
    {
        $id = $_GET['id'];

        //获取id为$id的订单信息
        $orders = Orders::find($id);

        //判断商品的状态
        $orders->status = '6';

        $res1 = $orders->save();

        return 1;
    }

    //删除已退款订单
    public function delorder(Request $request)
    {
        $id = $request->input('id');

        $res = Orders::where('id',$id)->delete();

        return back()->with('success','删除成功');
    }
}
