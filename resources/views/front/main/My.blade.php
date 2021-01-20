@include('front.main.head')
<body class="bgcol">
    <div class="mytx">
        <div class="touzs">
            @if($userInfo['head_portrait']=='')
            <em><img src="/images/default.jpg"></em>
            @else

           <img src="/{{$userInfo['head_portrait']}}" class="img">
           @endif
           <span>{{$userInfo['nickname']}}</span>
           @if ($userInfo['user_type']==1)
           <em><img src="/images/User_jingxiaoshang@2x.png"></em>
           @elseif($userInfo['user_type']==2)
            <em><img src="/images/User_shifu@2x.png"></em>
            @else($userInfo['user_type']==3)
            <em><img src="/images/putong@2x.png"></em>
           @endif
           <a href="/web/my/edit" class="xxbj">编辑</a>
        </div>
    </div>
    
    <div class="integral">
        <ul>
           <li><a href="/web/my/myIntegral">
              <span>{{$userInfo['integral']}}</span>
              <em><img src="/images/jj.png"><strong>积分</strong></em>
           </a></li>
           <li><a href="/web/my/rema">
              <span>￥{{$userInfo['balance']}}</span>
              <em><img src="/images/yy.png"><strong>余额</strong></em>
           </a></li>
        </ul>
    </div>
    
    <div class="myorder">
        <a href="/web/order/orderList"><div class="lianjie"><span>我的订单</span><em>查看全部订单</em></div></a>
        <ul>
           <li class="one"><a href="/web/order/orderList?order_status=0&pay_status=0"><img src="/images/icon_obligation.png"><em>待付款</em></a></li>
           <li class="two"><a href="/web/order/orderList?order_status=1&pay_status=2&shipping_status=0
"><img src="/images/icon_fahuo.png"><em>待发货</em></a></li>
           <li class="three"><a href="/web/order/orderList?order_status=1&pay_status=2&shipping_status=1"><img src="/images/icon_shouhuo.png"><em>待收货</em></a></li>
           <li class="four"><a href="/web/order/orderList?order_status=4&pay_status=2"><img src="/images/icon_refund.png"><em>退货</em></a></li>
        </ul>
    </div>
    
    <div class="ljlist">
       <a href="/web/my/jfStore"><div class="lianjie"><span>积分商城</span></div></a>
       <a href="/web/collectList"><div class="lianjie"><span>我的收藏</span></div></a>
    </div>
    
    <div class="ljlist">
        <a href="/web/addressList"><div class="lianjie"><span>收货地址</span></div></a>
    </div>
    
    <div class="ljlist">
        <a href="/web/my/set"><div class="lianjie"><span>系统设置</span></div></a>
        <div class="lianjie lianjie1"><span>客服电话</span><a href="tel:0591-87181333">{{$company['custom_service_phone']}}</a></div>
    </div>
	@include('front.main.foot')
</body>
</html>
