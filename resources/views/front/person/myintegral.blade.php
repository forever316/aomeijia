<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/integral.css">
<title>我的积分</title>
</head>
<body class="bgcolor">
    <div class="myintegral">
       <!--当前积分-->
       <div class="thisjifen">
           <ul>
               <li class="jifentitle">当前剩余积分<a href="/web/my/jfDetail">明细</a></li>
               <li class="jifenzhi"><em>{{$data['integral']}}</em></li>
           </ul>
       </div>
       <!--当前积分-->
       
       <!--积分菜单-->
       <div class="jifennav">
           <ul>
               <li class="jfdh"><a href="/web/my/cash"><img src="/images/jfdh.png">积分兑现</a></li>
               <li class="jfsc"><a href="/web/my/jfStore"><img src="/images/jfsc.png">积分商城</a></li>
           </ul>
       </div>
       <!--积分菜单-->
    </div>
</body>
</html>
