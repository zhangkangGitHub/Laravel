@extends('admin.layout.index')


@section('content')


<!-- 显示 验证错误  开始 -->
@if (count($errors) > 0)
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 显示 验证错误  结束 -->



<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>用户修改</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
    		{{ csrf_field() }}
            {{ method_field('PUT') }}
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">用户名</label>
    				<div class="mws-form-item">
    					<input type="text" disabled name="uname" value="{{ $user->uname }}" class="small">
    				</div>
    			</div>
    

				<div class="mws-form-row">
    				<label class="mws-form-label">邮箱</label>
    				<div class="mws-form-item">
    					<input type="text" name="email" value="{{ $user->email }}" class="small">
    				</div>
    			</div>
			
				<div class="mws-form-row">
    				<label class="mws-form-label">手机号</label>
    				<div class="mws-form-item">
    					<input type="text" name="phone" value="{{ $user->phone }}" class="small">
    				</div>
    			</div>
                
                <img src="/uploads/{{ $user->profile }}" style="border:1px solid #ccc;border-radius: 10%;width: 110px;">

    			<div class="mws-form-row" style="width: 610px;">
    				<label class="mws-form-label">头像</label>
    				<div class="mws-form-item">
    					<input type="file" name="profile" value="" class="small">
    				</div>
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