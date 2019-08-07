@extends('admin.layout.index')

@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> Simple Table</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table" style="text-align:center; vertical-align:middle;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>     
                        <th>父级ID</th>
                        <th>分类路径</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                       
                    </tr>
                </thead>
                <tbody>
                @foreach($cates as $k=>$v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->cname }}</td> 
                        <td>{{ $v->pid }}</td>
                        <td>{{ $v->path }}</td>
                        <td>
                        
                            @if($v->status == 1)
                            <!-- <kbd>启用</kbd>  -->
                            <span style="background: #76B249">启用</span>
                            @else
                            <span style="background: red">未启用</span>
                            <!-- <kbd>未启用</kbd> -->
                            @endif

                        </td>
                        <td>{{ $v->created_at }}</td>
                        <td>
                            @if(substr_count($v->path,',') < 2)
                            <a href="/admin/cates/create?id={{ $v->id}}"  class="btn btn-primary">添加子分类</a>
                            @endif
                            <form action="/admin/cates/{{ $v->id }}" method="post" style="display:inline;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }} 
                                @if(!isset($v->xs))
                                <input type="submit" value="删除" class="btn btn-danger">
                                @endif
                            </form>
                          

                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection