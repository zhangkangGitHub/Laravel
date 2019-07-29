<?php

namespace App\Http\Controllers\Admin;
// namespace App\Http\Models\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStore;
use App\Models\Users;
use App\Models\Userinfo;
use Hash;
use DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{ 
    /**
     * 后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->page);
        $search = $request->input('search','');

        // 获取数据
        $users = Users::where('uname','like','%'.$search.'%')->paginate('5');

        // 获取当前的页数
        $currentPage=$request->page ?? 1;
        // 获取每页显示的条数
        $num=5;
        // 获取数据的总条数 
        $count=DB::table('users')->count();
        
        $id=($currentPage-1)*$num+1;

        //加载摸版
        return view('admin.users.index',['users'=>$users,'requests'=>$request->input(),'id'=>$id]);

    }

    /**
     * 显示添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示页面
        return view('admin.users.create');
        
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersStore $request)
    {
        

        // 检测文件上传
        if ($request->hasFile('profile')) {
            //获取头像
            $path = $request->file('profile')->store(date('Ymd'));
        }else{
            
            return back();
        }
        // 开启事务
        DB::beginTransaction();
        
        // 实例化模型
        $user = new Users;
        $user->uname = $request->input('uname','');
        $user->upass = Hash::make($request->input('upass',''));
        $user->email = $request->input('email','');
        $user->phone = $request->input('phone','');
        $res1 = $user->save();

        // 添加头像
        $userinfo = new Userinfo;
        $userinfo->uid = $user->id;
        $userinfo->profile = $path;
        $res2 = $userinfo->save();

        // dump($res1,$res2);

        // dump($res2,$res1);
        if($res1 && $res2){
            // 提交事务
            DB::commit();
            
            // return redirect('/admin/users')->with(['error','添加成功']);
            return redirect('/admin/users')->with('success','添加成功');
          
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','添加失败');
            
        }

    }

    /**
     * 显示详情页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Users::find($id);
        $userinfo = Userinfo::where('uid',$id)->first();
        // dump($user);
        $user->profile = $userinfo->profile;

        // 加载视图
        return view('admin.users.edit',['user'=>$user]);
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //检测用户是否有文件上传
        if(!$request->hasFile('profile')){
            $user = Users::find($id);
            $user->email = $request->input('email','');
            $user->phone = $request->input('phone','');
           
            if ($user->save()) {
                return redirect('admin/users')->with('succes','修改成功');
            }else{
                 return back()->with('error','修改失败');
            }
        }else{
            // 开启事务
            DB::beginTransaction();

            // 接受文件上传
            $path = $request->file('profile')->store(date('Ymd'));
            $userinfo = Userinfo::where('uid',$id)->first();

            // 删除图片
            Storage::delete([$userinfo->profile]);  
            
            // 给用户设置新的图片
            $userinfo->profile = $path;

            // 执行修改
            $res1 = $userinfo->save();

            // 修改用户的主信息
            $user = Users::find($id);
            $user->email = $request->input('email','');
            $user->phone = $request->input('phone','');
            $res2 = $user->save();

            if ($res1 && $res2) {
                // 提交事务
                DB::commit();
                return redirect('admin/users')->with('succes','修改成功');
            }else{
                // 回滚事务
                DB::rollBack();
                return back()->with('error','修改失败');
            }

        };
    }

    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 开启事务
        DB::beginTransaction();
        
        // 删除主用户信息
        $res1 = Users::destroy($id);

        // 获取用户头像
        $userinfo = Userinfo::where('uid',$id)->first();
        $path = $userinfo->profile;

        // 删除用户详情
        $res2 = Userinfo::where('uid',$id)->delete();

        // 判断
        if($res1 && $res2){
            // 删除图片
            Storage::delete([$path]);
            // 提交事务
            DB::commit();
            return redirect('/admin/users')->with('success','删除成功');
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','删除失败'); 
        }
    }
}
