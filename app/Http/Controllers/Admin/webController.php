<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebRequest;
use App\Models\Web;
use Illuminate\Support\Facades\Storage;

class webController extends Controller
{
   
    // 网站配置 页面
    public function web()
    {
        // 查找数据
        $data=Web::get();
        // 判断数据库中是否有数据
        if(isset($data[0])){
            $data=$data[0];
        }else{
            $data=null;
        }
        
        return view('admin.webs.webs')->with(['data'=>$data]);
    }

    public function doweb(WebRequest $request){
        // 查找数据
        $data=Web::find(1);
       
        // 判断数据库中是否有数据
        if(isset($data)){
            
             // 修改操作
             //  判断是否有文件上传
            if ($request->hasFile('logo')) {
                // 获取网站的logo
                $path = $request->file('logo')->store(date('Ymd').'logo');
                // 删除原来的网站logo
                Storage::delete([$data->logo]);
            }else{
                $path=$data->logo;
            }
            // 去除token字段
            $data = $request->except('_token');

            $data['logo']=$path;
          
            // 执行修改
            Web::where('id',1)->update($data);

            return back()->with('success','修改成功');
        }else{
            // 添加操作
            //文件上传
            $path = $request->file('logo')->store(date('Ymd').'logo');
            // 去除token字段
            $data = $request->except('_token');
            $data['logo']=$path;
            // 添加操作
            Web::Create($data);
            
            // DB::tables('webs')->insert([]);
            return back()->with('success','添加成功');
        }
       
    }


    
}
