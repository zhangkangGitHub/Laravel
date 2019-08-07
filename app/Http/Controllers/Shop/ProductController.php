<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsStore;
use App\Http\Requests\BrandStore;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Details;
use App\Models\Brand;
use DB;

class ProductController extends Controller
{
    //产品类表
    public function plist(Request $request)
    {
        $gname = $request->input('goods','');

        //获取店铺id
        $sid = session('shop_userinfo')->sid;

        //获得店铺商品
        // $goods = DB::select('select * from brand b,goods g where g.sid = '.$sid.' and b.id=g.bid limit 0,5');

        $goods = DB::table('brand')
            ->join('goods', 'goods.bid', '=','brand.id')
            ->where('goods.sid', '=', $sid)
            ->where('goods.goods','like','%'.$gname.'%')
            ->select('brand.*','goods.*')
            ->paginate(5);

        $count = DB::table('goods')->count();

        foreach($goods as $k=>$v){

            if($v->state == '1'){
                $v->state = '在售';
            }else{
                $v->state = '下架';
            }

        }

        //获取全部分类
        $cates = DB::select("select *,concat(path,',',id) as paths from cates order by paths asc");

    	return view('shop.product.plist',['cates'=>$cates,'goods'=>$goods,'requests'=>$request->input(),'count'=>$count]);
    }

    //品牌管理
    public function brand(Request $request)
    {
        //获取搜索名称
        $bname = $request->input('bname','');
        //查询数据库
        $brand = DB::table('brand')->where('bname','like','%'.$bname.'%')->paginate(3);
        //查询品牌数量
        $count = DB::table('brand')->count();
        //查询全部品牌
        $brands = DB::table('brand')->get();
        //设置国内品牌数量
        $cnum = 0;
        //设置国外品牌数量
        $cnums = 0;
        //遍历查询数据
        foreach($brand as $k=>$v){

            if($v->state == '1'){
                $v->state = '已启用';
            }else{
                $v->state = '已停用';
            }

            $del = DB::table('goods')->where('bid',$v->id)->count();

            if($del == 0){
                $v->del = '显示';
            }else{
                $v->del = '不显示';
            }
      
        }

        //遍历国外品牌数量和国内品牌数量
        foreach($brands as $k=>$v){

            if($v->country == '中国'){
                $cnum++;
            }else{
                $cnums++;
            }

        }

    	return view('shop.product.brand',['brand'=>$brand,'count'=>$count,'requests'=>$request->input(),'cnum'=>$cnum,'cnums'=>$cnums]);
    }

    //添加品牌页面
    public function addbrand()
    {
        //获取所有类型
        $cates = DB::select("select *,concat(path,',',id) as paths from cates order by paths asc");

        $num = 0;

        $cate = [];

        //遍历三级分类
        foreach($cates as $k=>$v){

            if(substr_count($cates[$k]->path,',') == 2){

                $cate[$num]['id'] = $cates[$k]->id;

                $cate[$num]['cname'] = $cates[$k]->cname;

                $num++;
            }

        }

        return view('shop.product.addbrand',['cate'=>$cate]);
    }

    //处理品牌添加
    public function doaddbrand(Request $request)
    {
        // 检查文件上传
        if ($request->hasFile('blogo')) {

            $paths = $request->file('blogo');

            $path = $paths->store('blogo');
            
        }else{
            return back()->with('error','请上传品牌logo');
        }

        $brand = new Brand;

        $brand->sid = session('shop_userinfo')->sid;

        $brand->cid = $request->input('cid');

        $brand->bname = $request->input('bname');

        $brand->blogo = $path;

        $brand->country = $request->input('country');

        $brand->describe = $request->input('describe');

        $res = $brand->save();

        if($res){
            return redirect('shop/brand')->with('success', '添加成功');
        }
    }

    //添加商品页面
    public function addgoods()
    {
        $cates = DB::select("select *,concat(path,',',id) as paths from cates order by paths asc");

        $sid = session('shop_userinfo')->sid;

        $brand = DB::table('brand')->where('sid',$sid)->get();

        $num = 0;

        $cate = [];

        //遍历三级分类
        foreach($cates as $k=>$v){

            if(substr_count($cates[$k]->path,',') == 2){

                $cate[$num]['id'] = $cates[$k]->id;

                $cate[$num]['cname'] = $cates[$k]->cname;

                $num++;
            }

        }
        
        return view('shop.product.addgoods',['cates'=>$cates,'cate'=>$cate,'brand'=>$brand]);
    }

    //商品状态修改
    public function state(Request $request)
    {
        //获取参数
        $id = $_GET['id'];

        //获取id为$id的商品信息
        $goods = Goods::find($id);

        //判断商品的状态
        if($goods->state == '1'){
            $goods->state = '2';
        }else{
            $goods->state = '1';
        }

        $res1 = $goods->save();

        return back()->with('success','修改成功');
    
    }

    //品牌状态修改
    public function bstate()
    {

        //获取参数
        $id = $_GET['bid'];

        //获取id为$id的商品信息
        $brand = Brand::find($id);

        //判断商品的状态
        if($brand->state == '1'){
            $brand->state = '2';
        }else{
            $brand->state = '1';
        }

        $res1 = $brand->save();

        return back()->with('success','修改成功');
    }

    //品牌删除
    public function delbrand(Request $request)
    {
        $id = $request->input('id');

        $res = Brand::where('id',$id)->delete();

        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    //商品删除
    public function delgoods(Request $request)
    {
        // 开启事务
        DB::beginTransaction();

        $id = $request->input('id');

        $res = Goods::where('id',$id)->delete();

        $result = Details::where('gid',$id)->delete();

        if($res && $result){
            // 提交事务
            DB::commit();

            return 1;
        }else{
            // 回滚事务
            DB::rollBack();

            return 2;
        }
    }

    //添加商品
    public function doaddGoods(GoodsStore $request)
    {
        // 开启事务
        DB::beginTransaction();

        // 检查文件上传
        if ($request->hasFile('picname')) {

            $data = $request->file('picname');

            //遍历上传文件
            foreach($data as $k => $v)
            {
                $arr[$k] = $v->store('pictures');
            }

            $picname = '';

            //遍历文件名
            foreach($arr as $k=>$v){
                $picname .= $v.',';
            }

            //去除字符串末尾逗号
            $picname = rtrim($picname,',');
            
        }else{
            return back();
        }

        //实例化模型
        $goods = new Goods;

        $goods->goods = $request->input('goods');

        $goods->gnum = $request->input('gnum');

        $goods->antistop = $request->input('antistop');

        $goods->cid = $request->input('cid');

        $goods->bid = $request->input('bid');

        $goods->sid = session('shop_userinfo')->sid;

        $goods->unit = $request->input('unit');

        $goods->original = $request->input('original');

        $goods->price = $request->input('price');

        $goods->picname = $picname;

        $goods->store = $request->input('store');

        $res1 = $goods->save();

        $details = new Details;

        $details->gid = $goods->id;

        $details->company = $request->input('company');

        $details->descr = $request->input('descr');

        $details->specification = $request->input('specification1').','.$request->input('specification2').','.$request->input('specification3');

        $details->color = $request->input('color1').','.$request->input('color2').','.$request->input('color3');

        $details->weight = $request->input('weight');

        $res2 = $details->save();

        if($res1 && $res2){
            DB::commit();
            return redirect('shop/plist')->with('success', '添加成功');
        }else{
            DB::rollBack();
            return back()->with('error', '添加失败');
        }

    }
}
