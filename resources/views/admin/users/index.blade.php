@extends('admin.layout.index')

@section('content')
@if (count($errors) > 0)
    <div class="mws-form-message success">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   
<form action="/admin/users" method="get">
	搜索
	<input type="text" name="search" placeholder="关键字" value="{{ $requests['search'] ?? '' }}">
	<input type="submit"class="btn btn-danger"  value="搜索">
</form>
  
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 用户列表 </span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table"  style="text-align:center; vertical-align:middle;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>手机号</th>
                        <th>头像</th>
                        <th>操作</th>
                       
                    </tr>
                </thead>
                <tbody>
                
                @foreach($users as $k=>$v)
                    <tr>
                        
                        <td>{{ $id }}</td>
                        <td>{{ $v->uname }}</td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->phone }}</td>
                        <td>
                            <img src="/uploads/{{ $v->userinfo->profile }}" style="width:70px;height:50px;border-radius:8px;">
                        </td>
                        <td>
                            <form action="/admin/users/{{ $v->id }}" method="post" style="display:inline;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" value="删除" class="btn btn-danger">
                                <a href="/admin/users/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                            </form>
                            <!-- <a href="" class="btn btn-info">删除</a> -->
                           
                            
                        </td>
                    </tr>
                    <!-- {{$id++}} -->
                @endforeach
                </tbody>
            </table>
            <div id="page_page">
                {{ $users->appends($requests)->links() }}
            </div>
        </div>
    </div>


@endsection