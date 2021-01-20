<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/integral.css">
<title>积分商城</title>
</head>
<body class="bgcolor"> 
 	<div class="dateil">
         <div class="suspension"><b>积分兑换专区</b><span>当前剩余积分：<em>{{$datas['integral']}}</em></span></div>
         <div class="splist">
         @foreach($datas['data'] as $data)
             <!--一个商品-->
             <div class="onesp">
                <a href="/web/my/spDetails/{{$data['ids']}}">
                <ul>
                    <li class="spname">{{$data['name']}}</li>
                    <li class="gg">规格：{{$data['shuxing']}}</li>
                </ul>
                <div class="spimg"><img src="/{{$data['thumbnail']}}"></div>
                <div class="jiage">
                   <ul>
                       <li class="jifen"><em>{{$data['integral']}}</em><img src="../images/money-01.png"></li>
                       <li class="jiaqian">￥{{$data['amount']}}</li>
                   </ul>
                </div>
                </a>
             </div>
             <!--一个商品-->
        @endforeach
         </div>
    </div>
</body>
</html>
