@extends('admin.layout.index')

@section('content')

<!-- <div class="">
    This is an error message
    <ul>
        <li>You are too fast</li>
        <li>You are too slow</li>
    </ul>
</div> -->


<!-- 显示 验证错误 开始 -->
@if (count($errors) > 0)
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 显示 验证错误 结束 -->

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>添加用户</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/adminuser/" method="post" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">管理员名称</label>
                        <div class="mws-form-item">
                            <input type="text" name="uname" value="{{ old('uname') }}" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width:763px;">
                        <label class="mws-form-label">头像</label>
                        <div class="mws-form-item">
                            <input type="file" name="profile" value="" class="small">
                        </div>
                    </div>
        
                <div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </form>
        </div>    	
    </div>
@endsection