<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RolesController extends Controller
{
    public static function controllernames()
    {
        return [
            'usersController'=>'用户管理',
            'catesController'=>'商品管理',

        ];
    }

    public static function nodes()
    {
        $nodes = DB::table('nodes')->get();
        $arr = [];
        $temp = [];
        foreach ($nodes as $key => $value) {

            $temp['id'] = $value->id;
            $temp['desc'] = $value->desc;
            $temp['aname'] = $value->aname;

            $arr[$value->cname][] = $temp;
        }
        // dump($arr);
        return $arr;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nodes = self::nodes();
        $controllernames = self::controllernames();
        // dump($nodes);
        // dd($controllernames);
        // 加载页面
        return view('admin.roles.create',['nodes'=>$nodes,'controllernames'=>$controllernames]);
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
        dump($request->all());
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
    }
}
