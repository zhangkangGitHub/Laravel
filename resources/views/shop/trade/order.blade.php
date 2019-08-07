<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title>订单</title>
	<script src="/s/js/jquery-1.9.1.min.js"></script>
    <script src="/s/assets/dist/echarts.js"></script>
</head>

<body>
<div id="map" style="width:100%; overflow:auto; overflow:hidden";></div>
</body>
</html>
<script>
 //初始化宽度、高度
    $("#map").height($(window).height()-20); 
	
    //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$("#map").height($(window).height()-20); 
  });
//统计
	        require.config({
            paths: {
                echarts: '/s/assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/map',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                //'echarts/chart/bar'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('map'),theme);
				
				option = {
    title : {
        text: '订单量',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item'
    },
    legend: {
        orient: 'vertical',
        x:'left',
        data:['订单量']
    },
    dataRange: {
        x: 'left',
        y: 'bottom',
        splitList: [
            {start: 1500},
            {start: 900, end: 1500},
            {start: 310, end: 1000},
            {start: 200, end: 300},
            {start: 10, end: 200, label: '10 到 200'},
            {start: 5, end: 5, label: '5', color: 'black'},
            {end: 10}
        ],
        color: ['#E0022B', '#E09107', '#A3E00B']
    },
    toolbox: {
        show: true,
        orient : 'vertical',
        x: 'right',
        y: 'center',
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    roamController: {
        show: true,
        x: 'right',
        mapTypeControl: {
            'china': true
        }
    },
    series : [
        {
            name: '订单量',
            type: 'map',
            mapType: 'china',
            roam: false,
            itemStyle:{
                normal:{
                    label:{
                        show:true,
                        textStyle: {
                           color: "rgb(249, 249, 249)"
                        }
                    }
                },
                emphasis:{label:{show:true}}
            },
            data:[
                {name: '北京',value: {{$country['beijing']}}},
                {name: '天津',value: {{$country['tianjin']}}},
                {name: '上海',value: {{$country['shanghai']}}},
                {name: '重庆',value: {{$country['chongqing']}}},
                {name: '河北',value: {{$country['hebei']}}},
                {name: '河南',value: {{$country['henan']}}},
                {name: '云南',value: {{$country['yunnan']}}},
                {name: '辽宁',value: {{$country['liaoning']}}},
                {name: '黑龙江',value: {{$country['heilongjiang']}}},
                {name: '湖南',value: {{$country['hunan']}}},
                {name: '安徽',value: {{$country['anhui']}}},
                {name: '山东',value: {{$country['shandong']}}},
                {name: '新疆',value: {{$country['xinjiang']}}},
                {name: '江苏',value: {{$country['jiangsu']}}},
                {name: '浙江',value: {{$country['zhejiang']}}},
                {name: '江西',value: {{$country['jiangxi']}}},
                {name: '湖北',value: {{$country['hubei']}}},
                {name: '广西',value: {{$country['guangxi']}}},
                {name: '甘肃',value: {{$country['gansu']}}},
                {name: '山西',value: {{$country['shanxi']}}},
                {name: '内蒙古',value: {{$country['neimeng']}}},
                {name: '陕西',value: {{$country['shanxis']}}},
                {name: '吉林',value: {{$country['jilin']}}},
                {name: '福建',value: {{$country['fujian']}}},
                {name: '贵州',value: {{$country['guizhou']}}},
                {name: '广东',value: {{$country['guangdong']}}},
                {name: '青海',value: {{$country['qinghai']}}},
                {name: '西藏',value: {{$country['xizang']}}},
                {name: '四川',value: {{$country['sichuan']}}},
                {name: '宁夏',value: {{$country['ningxia']}}},
                {name: '海南',value: {{$country['hainan']}}},
                {name: '台湾',value: {{$country['taiwan']}}},
                {name: '香港',value: {{$country['xianggang']}}},
                {name: '澳门',value: {{$country['aomen']}}}
            ]
        }
    ]
};
				
				
				
					 myChart.setOption(option);
			})
</script>
