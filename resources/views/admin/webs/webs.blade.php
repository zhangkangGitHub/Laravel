@extends('admin.layout.index')

@section('content')



    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>网站配置</span>
        </div>
        <div class="mws-panel-body no-padding">
        @if($data)
            <form class="mws-form" action="/admin/web/doweb" method="post" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站标题:</label>
                        <div class="mws-form-item">
                            <input type="text" name="title" placeholder="{{ $data->title }}" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站关键字:</label>
                        <div class="mws-form-item">
                            <input type="text" name="keyword" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的版权:</label>
                        <div class="mws-form-item">
                            <input type="text" name="cright" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的开关:</label>
                        <div class="mws-form-item">
                            <input type="text" name="isopen" value="1" {{$data->isopen==1 ? 'checked' : ''}} title="开" checked="" class="small">
                            <input type="text" name="isopen" value="2" {{$data->isopen==2 ? 'checked' : ''}} title="关" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">更换网站logo:</label>
                        <button type="button" class="layui-btn"><input type="file" name='logo'></button>
                        <div class="mws-form-item">
                            <img src="" alt="" id="demo1">
                            <p id="demoText"></p>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的描述:</label>
                        <div class="layui-input-block">
                            <textarea name="description" placeholder="请输入内容" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    
                    
        
                <div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </form>
        </div>    	
    </div>
    @else
            <form class="mws-form" action="/admin/web/doweb" method="post" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站标题:</label>
                        <div class="mws-form-item">
                            <input type="text" name="title" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站关键字:</label>
                        <div class="mws-form-item">
                            <input type="text" name="keyword" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的版权:</label>
                        <div class="mws-form-item">
                            <input type="text" name="cright" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的开关:</label>
                        <div class="mws-form-item">
                        <input type="radio" name="isopen" value="1" title="开" checked=""><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>开</div></div>
                <input type="radio" name="isopen" value="2" title="关"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>关</div></div>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">更换网站logo:</label>
                        <button type="button" class="layui-btn"><input type="file" name='logo'></button>
                        <div class="mws-form-item">
                            <img src="" alt="" id="demo1">
                            <p id="demoText"></p>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">网站的描述:</label>
                        <div class="layui-input-block">
                            <textarea name="description" placeholder="请输入内容" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    
                    
        
                <div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </form>
            @endif
@endsection