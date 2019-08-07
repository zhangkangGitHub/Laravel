<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/s/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/s/css/style.css"/>
        <link rel="stylesheet" href="/s/assets/css/font-awesome.min.css" />
        <link href="/s/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/s/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/s/assets/css/ace-ie.min.css" />
		<![endif]-->
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/s/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/s/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/s/assets/js/ace-extra.min.js"></script>
		<!--[if lt IE 9]>
		<script src="/s/assets/js/html5shiv.js"></script>
		<script src="/s/assets/js/respond.min.js"></script>
		<![endif]-->
        		<!--[if !IE]> -->
		<script src="/s/js/jquery-1.9.1.min.js" type="text/javascript"></script>       
		<!-- <![endif]-->
        <script src="/s/assets/dist/echarts.js"></script>
        <script src="/s/assets/js/bootstrap.min.js"></script>
<title>交易</title>
</head>

<body>
<div class=" page-content clearfix">
 <div class="transaction_style">
   <ul class="state-overview clearfix">
    <li class="Info">
     <span class="symbol red"><i class="fa fa-jpy"></i></span>
     <span class="value"><h4>交易金额</h4><p class="Quantity color_red">34565.68</p></span>
    </li>
     <li class="Info">
     <span class="symbol  blue"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>订单数量</h4><p class="Quantity color_red">5656</p></span>
    </li>
     <li class="Info">
     <span class="symbol terques"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>交易成功</h4><p class="Quantity color_red">34565</p></span>
    </li>
     <li class="Info">
     <span class="symbol yellow"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>交易失败</h4><p class="Quantity color_red">34</p></span>
    </li>
     <li class="Info">
     <span class="symbol darkblue"><i class="fa fa-jpy"></i></span>
     <span class="value"><h4>退款金额</h4><p class="Quantity color_red">3441.68</p></span>
    </li>
   </ul>
 
 </div>
 <div class="t_Record">
               <div id="main" style="height:400px; overflow:hidden; width:100%; overflow:auto" ></div>     
              </div> 
</div>
</body>
</html>
<script type="text/javascript">
     $(document).ready(function(){
		 
		  $(".t_Record").width($(window).width()-60);
		  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
		 $(".t_Record").width($(window).width()-60);
		});
 });
	 
	 
        require.config({
            paths: {
                echarts: '/s/assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/line',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/bar'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('main'),theme);
               option = {
    title : {
        text: '月购买订单交易记录',
        subtext: '实时获取用户订单购买记录'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['所有订单','待付款','代发货','已收货']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'所有订单',
            type:'bar',
            data:[{{ $Morders[0] }},{{ $Morders[1] }},{{ $Morders[2] }}, {{ $Morders[3] }}, {{ $Morders[4] }}, {{ $Morders[5] }}, {{ $Morders[6] }}, {{ $Morders[7] }}, {{ $Morders[8] }}, {{ $Morders[9] }},{{ $Morders[10] }}, {{ $Morders[11] }}],
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            }
        },
        {
            name:'待付款',
            type:'bar',
            data:[{{ $pfo[0] }}, {{ $pfo[1] }}, {{ $pfo[2] }}, {{ $pfo[3] }}, {{ $pfo[4] }}, {{ $pfo[5] }}, {{ $pfo[6] }}, {{ $pfo[7] }}, {{ $pfo[8] }}, {{ $pfo[9] }}, {{ $pfo[10] }}, {{ $pfo[11] }}],
            markPoint : {
                data : [
                    // {name : '年最高', value : {{ $pfo[6] }}, xAxis: 7, yAxis: 1182, symbolSize:18},
                    // {name : '年最低', value : 23, xAxis: 11, yAxis: 3}
                ]
            },
           
			
        }
		, {
            name:'代发货',
            type:'bar',
            data:[{{ $pm[0] }}, {{ $pm[1] }}, {{ $pm[2] }}, {{ $pm[3] }}, {{ $pm[4] }}, {{ $pm[5] }}, {{ $pm[6] }}, {{ $pm[7] }}, {{ $pm[8] }}, {{ $pm[9] }}, {{ $pm[10] }}, {{ $pm[11] }}],
            markPoint : {
                data : [
                    // {name : '年最高', value : {{ $pm[6] }}, xAxis: 7, yAxis: 172, symbolSize:18},
                    // {name : '年最低', value : 23, xAxis: 11, yAxis: 3}
                ]
            },
           
		}
		, {
            name:'已收货',
            type:'bar',
            data:[{{ $sd[0] }}, {{ $sd[1] }}, {{ $sd[2] }}, {{ $sd[3] }}, {{ $sd[4] }}, {{ $sd[5] }}, {{ $sd[6] }}, {{ $sd[7] }}, {{ $sd[8] }}, {{ $sd[9] }}, {{ $sd[10] }}, {{ $sd[11] }}],
            markPoint : {
                data : [
                    // {name : '年最高', value : {{ $sd[6] }}, xAxis: 7, yAxis: 1072, symbolSize:18},
                    // {name : '年最低', value : 22, xAxis: 11, yAxis: 3}
                ]
            },
           
		}
    ]
};
                    
                myChart.setOption(option);
            }
        );
    </script> 