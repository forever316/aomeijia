<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/order.css">
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/orderJs.js"></script>
<title>我的订单</title>
</head>
<body class="bse">
    
    <!--订单菜单-->
	<div class="orderNav">
        <ul>
           <li id="all"><a href="/web/order/orderList" class="@if($status=='全部') tspan @endif">全部</a></li>
           <li id="payment"><a href="/web/order/orderList?order_status=0&pay_status=0" class="@if($status=='待付款') tspan @endif">待付款</a></li>
           <li id="shipments"><a href="/web/order/orderList?order_status=1&pay_status=2&shipping_status=0" class="@if($status=='待发货') tspan @endif">待发货</a></li>
           <li id="delivery"><a href="/web/order/orderList?order_status=1&pay_status=2&shipping_status=1" class="@if($status=='待收货') tspan @endif">待收货</a></li>
           <li id="sales"><a href="/web/order/orderList?order_status=4&pay_status=2" class="@if($status=='退货') tspan @endif">退货</a></li>
        </ul>
    </div>
    <!--订单菜单-->
    
    
    <!--订单内容-->
    <div class="order">
       
         <!--全部订单-->
         <div class="zh_order" id="all_01">
         @if($datas)
         @foreach($datas as $data)
           <!--一个订单-->
           <div class="one_order">
             <p class="or_title">{{$data['order_status']}}</p>
             <div class="orderlist">
                @foreach($data['list'] as $list)
                 <!--一个商品-->
                 <div class="order_yi">
                 <a href="/web/order/orderDetail?order_sn={{$data['order_sn']}}">
                   <!--商品图片-->
                   <div class="order_img"><img src="/{{$list['thumbnail']}}"></div>
                   <!--商品图片-->
                   <div class="order_xq">
                       <ul>
                           <li class="or_name">{{$list['goods_name']}}</li>
                           <li class="order_stan">{{$list['goods_attr']}} </li>
                           <li class="order_qian"><span>X{{$list['goods_number']}}</span></li>
                       </ul>
                   </div>
                 </a></div>
                 <!--一个商品-->
                @endforeach
             </div>
             <p class="heji">共{{$data['good_count']}}件商品 合计:￥{{$data['total_amount']}} (含运费￥0.00）</p>
            @if($data['order_status'] == '待付款')
                <p class="caozuo"><a href="/weiPay?orderid={{$data['order_sn']}}" class="lv">付款</a><a href="/web/order/cancelOrder?order_sn={{$data['order_sn']}}">取消订单</a></p>
            @elseif($data['order_status'] == '待发货')
            <p class="caozuo"><a href="/web/order/orderReturn?order_sn={{$data['order_sn']}}" class="lv">申请退货</a></p>
            @elseif($data['order_status'] == '待收货')
            <p class="caozuo"><a href="/web/order/confirmOrder?order_sn={{$data['order_sn']}}" class="lv">确认收货</a></p>
            @elseif($data['order_status'] == '交易成功')

            @elseif($data['order_status'] == '退货成功')

            @elseif($data['order_status'] == '退货中')

            @elseif($data['order_status'] == '交易关闭')
            <p class="caozuo"><a href="/web/order/delOrder?order_sn={{$data['order_sn']}}">删除订单</a></p>
            @endif
             
           </div>
           <!--一个订单-->
           @endforeach
           @endif
         </div>
         <!--全部订单-->
    </div>
    <!--订单内容-->
    <script type="text/javascript">
        $('#payment').click(function(){
            $.ajax({
                type:"get",
                url:"/web/order/orderList?order_status=0&pay_status=0",
                success:function(data){
                    console.log(data);
                }
            });
        })
    </script>
</body>
</html>
