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
		<script src="/s/js/H-ui.js" type="text/javascript"></script>  
        <script src="/s/assets/js/bootstrap.min.js"></script>
		<script src="/s/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/s/assets/js/jquery.dataTables.min.js"></script>
		<script src="/s/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/s/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/s/assets/laydate/laydate.js" type="text/javascript"></script>
          
        <script src="/s/js/lrtk.js" type="text/javascript" ></script>
<title>退款管理</title>
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
 <div id="refund_style">
   <div class="search_style">
     
      <ul class="search_content clearfix">
      <form action="/shop/refund" method="get">
       <li><label class="l_f">产品名称</label><input name="goods" type="text" class="text_add" placeholder="输入产品名称" style=" width:250px"></li>
       <li style="display:none"><label class="l_f">退款时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><input type="submit" value="查询" class="btn_search"></li>
       </form>
      </ul>
    </div>
 <div class="border clearfix">
       <span class="l_f">
        <a href="/shop/refund?status=6" class="btn btn-success Order_form"><i class="fa fa-check-square-o"></i>&nbsp;已退款订单</a>
        <a href="/shop/refund?status=5" class="btn btn-warning Order_form"><i class="fa fa-close"></i>&nbsp;未退款订单</a>
        <a style="display:none;" href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
       </span>
       <span class="r_f">共：<b>{{$count}}</b>笔</span>
     </div>
     <!--退款列表-->
     <div class="refund_list">
        <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
    
		 <tr>
				<th width="25px" style="display:none;"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="120px">订单编号</th>
				<th width="250px">产品名称</th>
				<th width="100px">交易金额</th>				
                <th width="100px">交易时间</th>				
				<th width="100px">退款金额</th>
                <th width="80px" style="display:none;">退款数量</th>
				<th width="70px">状态</th>
                <th style="display:none;" width="200px">说明</th>                
				<th width="200px">操作</th>
			</tr>
      
		</thead>
        <tbody>
        @foreach($order as $k=>$v)
         <tr>
           <td style="display:none;"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
     <td>{{$v->code}}</td>
     <td class="order_product_name">
      <a href="#">{{$v->goods}}</a>
     </td>
     <td>{{$v->total}}</td>    
     <td>{{$v->created_at}}</td>
     <td>{{$v->total}}</td>
     <td style="display:none;">1</td>
      <td class="td-status"><span class="label label-success radius">{{$v->status}}</span></td>
      <td style="display:none;">重复购买商品需退款一件</td>
     <td class="td-manage">
     @if($v->status == '待退款')
     <a onClick="Delivery_Refund(this,'10001')" name="{{$v->id}}" href="javascript:;" title="退款"  class="btn btn-xs btn-success">退款</a>
     @endif
     @if($v->status == '已退款')
     <a title="删除" href="/shop/trade/delorder?id={{$v->id}}"  onclick="Order_form_del(this,'1')" class="btn btn-xs btn-warning" >删除</a>   
     @endif 
     </td>
         </tr>
           @endforeach
        </tbody>
    </table> 
     <div id="page_page" style="float:left;">
        {{ $order->appends($requests)->links() }}
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
    if($($($('.td-status')[i].children)[0]).html() == '已退款'){
      $($($('.td-status')[i].children)[0]).attr('class','label label-error radius');
      // $($($('.td-manage')[i].children)[0]).attr('class','btn btn-xs btn-error');
      // $($($('.td-manage')[i].children)[0]).attr('href','#');
      // $($($('.td-manage')[i].children)[0]).attr('onClick','');
    }else{
      $($($('.td-status')[i].children)[0]).attr('class','label label-success radius');
      $($($('.td-manage')[i].children)[0]).attr('class','btn btn-xs btn-success');
    }
  }
}

 //订单列表
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6,8,9]}// 制定列不参与排序
		] } );
                 //全选操作
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			});
function Delivery_Refund(obj,id){
			
			 layer.confirm('是否退款当前商品价格！',function(index){
    		$(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已退款">退款</a>');
    		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt  radius">已退款</span>');
    		$(obj).remove();
        $.ajax("{{url('shop/trade/status')}}",{
          data:{id:obj.name},
          dataType:'json',
          type:'GET',
          success:function(data){
            console.log(data);
          },
          timeout:0,
          async:false
        });
    		layer.msg('已退款!',{icon: 6,time:1000});
			});  
			  
		  
};
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Refund_detailed').on('click', function(){
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
</script>