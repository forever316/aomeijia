<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/orderxq.css">
<title>申请退货</title>
</head>
<body>
    <form method="post" action="/web/order/orderReturn">
      <div class="refund">
         <ul>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="order_sn" value="{{$order_sn}}">
             <li class="ttle" >退货原因</li>
             <li><input type="text" placeholder="请输入退货原因" name="ruturn_reason"></li>
             <li class="ttle">申请人</li>
             <li><input type="text" placeholder="请输入申请人姓名" name="return_user"></li>
             <li class="ttle">联系方式</li>
             <li><input type="text" placeholder="请输入申请人联系方式" name="return_phone"></li>
         </ul>
      </div>
      <button class="shenqing">提交申请</button>
      <!-- <a href="#" class="shenqing">提交申请</a> -->
    </form>
</body>
</html>
