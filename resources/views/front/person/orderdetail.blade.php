<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/orderxq.css">
<title>待收货</title>
</head>
<body class="bse">
    @if($datas['order_status'] == '待付款')
    <div class="tishi">温馨提醒: 超过24小时后订单将被取消。<a href="javascript:void(0)" id="gbtishi"></a></div>
    @endif
	<div class="bianhao">
        <span>订单编号：{{$datas['order_sn']}}</span>
        <em>
        @if($datas['order_status'] == '待付款')
        待付款
        @elseif($datas['order_status'] == '待发货')
        待发货
        @elseif($datas['order_status'] == '待收货')
        待收货
        @elseif($datas['order_status'] == '交易成功')
        交易成功
        @elseif($datas['order_status'] == '退货成功')
        退货成功
        @elseif($datas['order_status'] == '退货中')
        退货中
        @elseif($datas['order_status'] == '交易关闭')
        交易关闭
        @endif
        </em>
    </div>
    
    <!--地址-->
    <div class="site"><a href="#">
       <ul>
          <li><span>{{$datas['consignee']}}</span><strong>{{$datas['mobile']}}</strong></li>
          <li class="dizhi">{{$datas['address']}}</li>
       </ul>
    </a></div>
    <!--地址-->
    
    <!--订单商品-->
    @foreach($datas['order_goods'] as $data)
    <div class="ordersp">
       <!--一个商品-->
       <div class="oneor"><a href="#">
           
           <!--商品图片-->
           <div class="orimg"><img src="/{{$data['thumbnail']}}"></div>
           <!--商品图片-->
           <div class="orxq">
           	   <ul>
                   <li class="name">{{$data['goods_name']}}</li>
                   <li class="standard">{{$data['goods_attr']}} </li>
                   <li class="qian"><em>￥{{$data['goods_price']}}</em><span>X{{$data['goods_number']}}</span></li>
               </ul>
           </div>
       </a></div>
       <!--一个商品-->
       <p class="zhifu"><span>支付配送</span><i>在线支付</i></p>
    </div>
    @endforeach
    <!--订单商品-->
    
    <div class="jine">
       <ul>
            <li><span>商品金额</span><em>￥{{$datas['goods_amount']}}</em></li>
            <li><span>运费</span><em>+ ￥0.00</em></li>
       </ul>
    </div>
    <div class="total">
        <ul>
           <li><span>￥{{$datas['goods_amount']}}</span><em>合计：</em></li>
           <li class="time">下单时间：<?php echo  date("Y-m-d H:i:s",$datas['add_time'])?></li>
        </ul>
    </div>
    
    
    <div class="suan">
        @if($datas['order_status'] == '待付款')
        <a href="/web/order/pay?order_sn={{$datas['order_sn']}}" class="lv">付款</a>
        <a href="/web/order/cancelOrder?order_sn={{$datas['order_sn']}}">取消订单</a>
        @elseif($datas['order_status'] == '待发货')
        <a href="/web/order/orderReturn?order_sn={{$data['order_sn']}}">申请退货</a>
        @elseif($datas['order_status'] == '待收货')
        <a href="/web/order/confirmOrder?order_sn={{$data['order_sn']}}" class="lv">确认收货</a>
        @elseif($datas['order_status'] == '交易成功')
        交易成功
        @elseif($datas['order_status'] == '退货成功')
        退货成功
        @elseif($datas['order_status'] == '退货中')
        退货中
        @elseif($datas['order_status'] == '交易关闭')
        <a href="/web/order/delOrder?order_sn={{$data['order_sn']}}">删除订单</a>
        @endif
       
    </div>
</body>
</html>
