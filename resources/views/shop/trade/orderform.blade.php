<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/s/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/s/css/style.css"/>       
        <link href="/s/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/s/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/s/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/s/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/s/js/jquery-1.9.1.min.js"></script>
        <script src="/s/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/s/js/H-ui.js"></script>     
		<script src="/s/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/s/assets/js/jquery.dataTables.min.js"></script>
		<script src="/s/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/s/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/s/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="/s/assets/js/jquery.easy-pie-chart.min.js"></script>
        <script src="/s/js/lrtk.js" type="text/javascript" ></script>
<title>订单管理</title>
<style>
  #sample-table_filter{
    display:none;
  }
  #sample-table_paginate{
    display:none;
  }
  #sample-table_length{
    display:none;
  }
</style>
</head>

<body>
<div class="margin clearfix">
 <div class="cover_style" id="cover_style">
    <div class="top_style Order_form" id="Order_form_style">
      <div class="type_title">购物产品比例
      <div class="btn_style">  
      <a href="javascript:ovid()"  class="xianshi_btn Statistic_btn">显示</a> 
      <a href="javascript:ovid()"  class="yingchan_btn Statistic_btn b_n_btn">隐藏</a>
      </div>
      </div>
        <div class="hide_style clearfix">
        <div style="display:none">{{$count = count($color)}}</div>
        @foreach($cate as $k=>$v)
        <div style="display:none">{{$rand = rand(0,$count-1)}}</div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="{{$cates[$k]}}" data-color="{{$color[$rand]}}"><span class="percent">{{$portion[$k]}}</span>%</div><span class="name">{{$v}}</span></div>		
       @endforeach
    </div>
    </div>
    <!--内容-->
   <div class="centent_style" id="centent_style">
     <div id="covar_list" class="order_list">
       <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">订单类型分类</h4></div>
         <div class="widget-body">         
         <ul class="b_P_Sort_list">
             <li><i class="orange  fa fa-reorder"></i><a href="/shop/orderform/">全部订单</a></li>
             @foreach($cate as $k=>$v)   
             <li><i class="fa fa-sticky-note pink "></i> <a href="{{route('cid',array('cid'=>$v))}}">{{$v}}({{$cates[$k]}})</a></li>
             @endforeach
            </ul>
       </div>
      </div>  
     </div>
     </div>
     <!--左侧样式-->
     <div class="list_right_style">
     <div class="search_style">
     
      <ul class="search_content clearfix">
      <form action="/shop/orderform" method="get">
       <li><label class="l_f">订单编号</label><input name="code" type="text" class="text_add" placeholder="订单订单编号" style=" width:250px"></li>
       <li style="display:none"><label class="l_f">时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><input type="submit" value="查询" class="btn_search"></li>
       </form>
      </ul>
    </div>
      <!--订单列表展示-->
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="120px">订单编号</th>
				<th width="250px">产品图片</th>
        <th width="100px">产品名称</th>
				<th width="100px">总价</th>
                <th width="100px">订单时间</th>				
				<th width="180px">所属类型</th>
                <th width="80px">数量</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
  @foreach($result as $k=>$v)
     <tr>
     <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
     <td>{{$v->code}}</td>
     <td class="order_product_name">
      <a href="#"><img src="/uploads/{{$v->picname}}"  title="产品名称"/></a>
     </td>
     <td>{{$v->goods}}</td>
     <td>{{$v->total}}</td>
     <td>{{$v->created_at}}</td>
     <td>{{$v->cname}}</td>
     <td>{{$v->onum}}</td>
      <td class="td-status"><span class="label label-success radius">{{$v->status}}</span></td>
     <td class="td-manage">
     <a onClick="Delivery_stop(this,'10001')" name="{{$v->id}}"  href="{{route('oid',array('oid'=>$v->id))}}" title="{{$v->status}}"  class="btn btn-xs btn-success"><i class="fa fa-cubes bigger-120"></i></a>
     @if($v->status == '已发货')
     <a title="删除" href="javascript:;" name="{{ $v->id }}"  onclick="Order_form_del(this,'1')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
     @endif
     </td>
     </tr>
  @endforeach
     </tbody>
    
     </table>
      <div id="page_page" style="float:left;">
        {{ $result->appends($requests)->links() }}
      </div>
     </div>
   </div>
 </div>
</div>
</div>
</body>
</html>
<script>
state();
function state(){
  console.log($($($('.td-manage')[0].children)[0]));
  for(var i=0;i<=$('.td-status').length-1;i++){
    if($($($('.td-status')[i].children)[0]).html() == '已发货'){
      $($($('.td-status')[i].children)[0]).attr('class','label label-error radius');
      $($($('.td-manage')[i].children)[0]).attr('class','btn btn-xs btn-error');
      $($($('.td-manage')[i].children)[0]).attr('href','#');
    }else{
      $($($('.td-status')[i].children)[0]).attr('class','label label-success radius');
      $($($('.td-manage')[i].children)[0]).attr('class','btn btn-xs btn-success');
    }
  }
}

 $(function() { 
	$("#cover_style").fix({
		float : 'top',
		minStatue : false,
		skin : 'green',	
		durationTime :false,
		window_height:30,//设置浏览器与div的高度值差
		spacingw:0,//
		spacingh:0,//
		close_btn:'.yingchan_btn',
		show_btn:'.xianshi_btn',
		side_list:'.hide_style',
		widgetbox:'.top_style',
		close_btn_width:60,	
		da_height:'#centent_style,.left_Treeview,.list_right_style',	
		side_title:'.b_n_btn',		
		content:null,
		left_css:'.left_Treeview,.list_right_style'
		
		
	});
});
//左侧显示隐藏
$(function() { 
	$("#covar_list").fix({
		float : 'left',
		minStatue : false,
		skin:false,	
		//durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
		stylewidth:'220',
		close_btn:'.close_btn',
		show_btn:'.show_btn',
		side_list:'.side_list',
		content:'.side_content',
		widgetbox:'.widget-box',
		da_height:null,
		table_menu:'.list_right_style'
	});
});
//时间选择
 laydate({
    elem: '#start',
    event: 'focus' 
});
/*订单-删除*/
function Order_form_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
    $.ajax("{{url('shop/trade/ostatus')}}",{
      data:{id:obj.name},
      dataType:'json',
      type:'GET',
      success:function(data){
        if(data == 1){
          alert('删除成功');
        }else{
          alert('删除失败');
        }
      },
      timeout:0,
      async:false
    });
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
/**发货**/
function Delivery_stop(obj,id){
      $.ajax("{{url('shop/trade/ostatus')}}",{
        data:{id:obj.name},
        dataType:'json',
        type:'GET',
        success:function(data){
          if(data == 1){
            alert('发货成功');
          }else{
            alert('发货失败');
          }
        },
        timeout:0,
        async:false
      });
};
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form,.order_detailed').on('click', function(){
	var cname = $(this).attr("title");
	var chref = $(this).attr("href");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe').html(cname);
    parent.$('#iframe').attr("src",chref).ready();;
	parent.$('#parentIframe').css("display","inline-block");
	parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);
	
});

//初始化宽度、高度  
  var heights=$(".top_style").outerHeight()+47; 
 $(".centent_style").height($(window).height()-heights); 
 $(".page_right_style").width($(window).width()-220);
 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2); 
 $(".list_right_style").width($(window).width()-250);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".centent_style").height($(window).height()-heights); 
	 $(".page_right_style").width($(window).width()-220);
	 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2);  
	 $(".list_right_style").width($(window).width()-250);
	}) 
//比例
var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
			$('.easy-pie-chart.percentage').each(function(){
				$(this).easyPieChart({
					barColor: $(this).data('color'),
					trackColor: '#EEEEEE',
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: 10,
					animate: oldie ? false : 1000,
					size:103
				}).css('color', $(this).data('color'));
			});
		
			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});
</script>
<script>
//订单列表
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,1,2,3,4,5,6,7,8,9]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
			
			});
</script>