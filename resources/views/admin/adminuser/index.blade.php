@extends('admin.layout.index')

@section('content')

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>管理员列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table" style="text-align:center; vertical-align:middle;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>管理员名称</th>
                        <th>管理员头像</th>
                        <th>操作</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($adminuser as $k=>$v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->uname }}</td>
                        <td>
                        
                            <img src="/uploads/{{ $v->profile }}" alt="" style="width:70px;height:50px;border-radius:8px;">
                        
                        </td>
                        <td>
                        
                            <a href="#">修改角色</a>
                        
                        </td>
                     
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
