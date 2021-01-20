<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/integral.css">
<title>商品详情</title>
</head>
<body>
     <div class="datu"><img src="/{{$data['banner_pic']}}"></div>
     <div class="canshu">
        <ul>
            <li class="xqjiege">{{$data['integral']}}<img src="/images/money-01.png"></li>
            <li class="zsjiege">￥{{$data['amount']}}</li>
            <a href="#" class="duihuan">兑换商品</a>
        </ul>
     </div>
     <div class="particulars">
         <span class="ptitle">商品名称</span>
         <p class="pmingcheng">{{$data['name']}} </p>
         <span class="ptitle">商品介绍</span>
         <p class="ms ">{!! $data['article'] !!}</p>
         
     </div>
</body>
</html>
