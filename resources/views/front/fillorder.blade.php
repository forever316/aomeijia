<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/order.css">
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/orderJs.js"></script>
<title>填写订单</title>
</head>
<body class="bse">

<div id="fillorder" lei="@if($title){{$title}}@endif" attr="@if($attr_ids){{$attr_ids}}@endif">
    <!--地址-->
    <div class="site" adsid="{{$address['ID']}}">
    <!-- <a href="/web/car/choiceAds"> -->
       <ul>
        @if($address!=null)
          <li><span>{{$address['name']}}</span><strong>{{$address['phone']}}</strong>
          @if($address['is_default']==1)<em>默认</em>@endif</li>
          <li class="dizhi"> {{$address['province']}}省{{$address['city']}}市{{$address['area']}}区{{$address['address']}} </li>
        @else
            <a href="/web/addressAdd"></a>
        @endif
       </ul>
    <!-- </a> -->
    </div>
    <!--地址-->
    
    <!--订单商品-->
    <div class="ordersp">
    @foreach($carlist as $list)
       <!--一个商品-->
       <div class="oneor" id="{{$list['id']}}" ><a href="#">
           
           <!--商品图片-->
           <div class="orimg"><img src="/{{$list['thumbnail']}}"></div>
           <!--商品图片-->
           <div class="orxq">
           	   <ul>
                   <li class="name">{{$list['goods_name']}}</li>
                   <li class="standard">{{$list['attr_name']}}</li>
                   <li class="qian"><em>￥{{$list['amount']}}</em><span>X{{$list['goods_number']}}</span></li>
               </ul>
           </div>
       </a></div>
       <!--一个商品-->
    @endforeach
       <p class="zhifu"><span>支付配送</span><i>在线支付</i></p>
    </div>
    <!--订单商品-->
    
    <!--备注-->
    <div class="beizhu"><input type="text" placeholder="备注"></div>
    <!--备注-->
    
    <div class="jine">
       <ul>
            <li><span>商品金额</span><em>￥{{$money}}</em></li>
            <li><span>运费</span><em>+ ￥0.00</em></li>
       </ul>
    </div>
    
    
    <div class="suan">
       <a href="javascript:void(0)" class="tijiao" id="present">提交订单</a>
       <span>实付款：￥<em>{{$money}}</em></span>
    </div>
    
    
    <!--付款方式-->
    <div class="curtain">
         <div class="way">
            <p class="way_title"><span>支付方式</span><a href="javascript:void(0)" id="close"></a></p>
            <ul>
                <li class="yue"><a href="#">余额支付</a></li>
                <!-- <li class="zfb"><a href="#" class="alin">支付宝支付<em>支付宝安全支付</em></a></li> -->
                <li class="wxzf"></li>
            </ul>
         </div>
    </div>
</div>
<!--付款方式-->
<div id="choiceads">
    
</div>
    
    <script type="text/javascript">
    $('.site').click(function(){
        $.ajax({
                type:'get',
                url:'/web/car/choiceAds',
                success:function(data){
                    $('#fillorder').hide();
                    $('#choiceads').html(data);
                }
            });
     })
    //提交订单
    $('.tijiao').click(function(){
        var beizhu = $('.beizhu').find('input').val();
        // var price = parseInt($('.qian').find('em').text().substring(1));
        // console.log(price);
        var ids = '';
        var prices = '';
        $('.oneor').each(function(){  
                var id = $(this).attr('id');
                ids += id+",";
                var price = parseInt($(this).find('em').text().substring(1));
                prices += price+",";     
            });
        var total = $('.suan').find('em').html();
        var adsid = $('.site').attr('adsid');
        var lei = $('#fillorder').attr('lei');
        if(lei=='立即购买'){
            var goods_id = $('.oneor').attr('id');
            var attr_ids = $('#fillorder').attr('attr');
            var num = $('.orxq').find('span').html().replace(/[^0-9]/ig,"");
            $.ajax({
                type:'get',
                url:'/web/order/gobuyOrder?goods_id='+goods_id+'&receipt_id='+adsid+'&postscript='+beizhu+'&attr_ids='+attr_ids+'&num='+num+'',
                success:function(data){
                    // $('.alin').attr(orderid=data);
                    console.log(data);
                    // $('.alin').attr('orderid',data);
                    $('.wxzf').html('<a href="/weiPay?money={{$money}}&orderid='+data+'" class="alin" >微信支付<em>微信安全支付</em></a>');
                }
            });
            
        }else{
            // $.get('/web/order/subOrder?ids='+ids+'&receipt_id='+adsid+'&postscript='+beizhu+'');
            $.ajax({
                type:'get',
                url:'/web/order/subOrder?ids='+ids+'&receipt_id='+adsid+'&postscript='+beizhu+'',
                success:function(data){
                    // $('.alin').attr(orderid=data);
                    console.log(data);
                    // $('.alin').attr('orderid',data);
                    $('.wxzf').html('<a href="/weiPay?money={{$money}}&orderid='+data+'" class="alin" >微信支付<em>微信安全支付</em></a>');
                }
            });
        }
    });
    
    </script>
</body>
</html>
