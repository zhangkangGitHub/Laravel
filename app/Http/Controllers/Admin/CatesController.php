<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class CatesController extends Controller
{

    public static function getCates()
    {
        $cates = DB::select("select * ,concat(path,',',id) as paths from cates order by paths asc");

        $xs = [];

        foreach ($cates as $key => $value) {
            //统计,出现次数
            $n = substr_count($value->path,',');
            
            // 重复使用字符串
            $cates[$key]->cname = str_repeat("|---",$n).$value->cname;

            if($value->pid != 0){
                array_push($xs,$value->pid);
            }
        }

        $xs = array_unique($xs);
        
        foreach($xs as $k=>$v){
            foreach($cates as $key=>$value){
                if($v == $value->id){
                    $value->xs = '1';
                }
            }
        }
        // dump($xs);
        // dump($cates);
        return $cates;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        
        // 加载摸版
        return view('admin.cates.index',['cates'=>self::getCates()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id',0);

        // 加载添加试图
        return view('admin.cates.create',['id'=>$id,'cates'=>self::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dump($request->input());
        // exit;
        // 获取pid
        $pid = $request->input('pid');
        
        if ($pid == 0) {
           $path = 0;
        }else{
            // 获取父级数据
            $parent_data = Cates::find($pid);
            $path = $parent_data->path.','.$parent_data->id;
            // dd($parent_data->id);
        }

        // 添加
        $cate = new Cates;
        
        $cate->cname = $request->input('cname','');
        $cate->pid = $pid;
        $cate->path = $path;
        
        if ($cate->save()) {
            return redirect('admin/cates')->with('success','添加成功');
        }else{   
            return back()->with('error','添加失败');
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo $id;

         // 开启事务
         DB::beginTransaction();
         
        // 删除用户详情
        $res = cates::where('id',$id)->delete();
       
        // 判断
        if($res){
          
            // 提交事务
            DB::commit();
            return redirect('/admin/cates')->with('success','删除成功');
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','删除失败'); 
        }
    }
}
