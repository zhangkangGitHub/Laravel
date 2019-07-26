@extends('admin.layout.index')


@section('content')

<form action="/admin/users" method="get">
	关键字
	<input type="text" name="search" placeholder="用户名" value="{{ $requests['search'] or '' }}">
	<input type="submit"class="btn btn-danger"  value="搜索">
</form>



<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 用户列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
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
                    <td class="table">{{ $v->id }}</td>
                    <td class="table">{{ $v->uname }}</td>
                    <td class="table">{{ $v->email }}</td>
                    <td class="table">{{ $v->phone }}</td>
                    <td class="table">
                    	<img src="/uploads/{{ $v->userinfo->profile }}" style="width: 70px;height:70px;border-radius: 8px;">
                    </td>
                    <td class="table">
						<form action="/admin/users/{{ $v->id }}" method="post" style="display: inline;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input type="submit" value='删除' class="btn btn-danger">
						</form>
						
						<a href="/admin/users/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
			
		<div id="page_page" style="float:right;">
			{{ $users->appends($requests)->links() }}
		</div>

    </div>
</div>


@endsection