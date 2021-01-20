<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/commoditydetails.css">
<link type="text/css" rel="stylesheet" href="/css/swiper-3.4.0.min.css">
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/swiper-3.4.0.jquery.min.js"></script>
<script type="text/javascript" src="/js/commodityJs.js"></script>
<title>商品详情</title>
</head>
<body>
<div class="goodsdetail">
      <div class="suspendNav">
          <ul>
              <li class="thisnav" id="spxd">商品</li>
              <li id="spxq">详情</li>
          </ul>
      </div>
      
      <div class="tabOne">

          <!--商品下单-->
          <div class="spxd">
              <!--banner-->
              <?php 
                $pics = explode(';',$goodDetail['banner_pic']);
              ?>
              <div class="swiper-container">
                <div class="swiper-wrapper">
                @foreach($pics as $pic)
                    <div class="swiper-slide"><img src="/{{$pic}}"></div>
                @endforeach   
                </div>
                <!-- 如果需要分页器 -->
                <div class="swiper-pagination"></div>
             </div>
             <!--banner-->
             
             <div class="namePrice" id="{{$goodDetail['id']}}">
                <ul>
                    <li>{{$goodDetail['name']}}</li>
                    <li class="Price"><span>￥{{$goodDetail['dis_amount']}}</span><em class="zk">折扣价</em></li>
                    <li class="ls">零售价：￥{{$goodDetail['amount']}}</li>
                </ul>
             </div>
             
             <div class="option"><input type="text" readonly value="选择 规格分类"></div>
         </div> 
         <!--商品下单-->
         
         
         <!--商品详情-->
         <div class="spxq">
             <div class="xqnav">
                <ul>
                   <li class="dqcd" id="jieshao">商品介绍</li>
                   <li id="canshu">规格参数</li>
                   <li id="bzsh">包装售后</li>
                </ul>
             </div>
             <div class="conter">
                 
                 <!--商品介绍-->
                 <div class="jieshao">               
                   {!!$goodDetail['article']!!}</p>    
                 </div>
                 <!--商品介绍-->
                 
                 
                 <!--规格参数-->
                 <div class="canshu">
                    @if($goodDetail['field'])
                    <ul>
                        @foreach($goodDetail['field'] as $good)
                       <li>
                       <span>{{$good['name']}}</span>
                       <em>{{$good['value']}}</em>
                       </li>
                       @endforeach
                    </ul>
                    @endif
                 </div>
                 <!--规格参数-->
                 
                 
                 <!--包装售后-->
                 <div class="bzsh">
                     <span class="ptitle">服务售后：</span>
                     <p class="pmingcheng">{{$goodDetail['packaging']}}</p>
                 </div>
                 <!--包装售后-->
             </div>
         </div>
         <!--商品详情-->
     </div>
     
     
     <div class="comfooter">
        <ul>
            @if ($goodDetail['is_collect'] == 1)
                <li class="shouchang yisc" title="2"><a href="javascript:void(0)" onclick="collect({{$goodDetail['id']}})">
                <em>已收藏</em>
            @else
            <li class="shouchang" title="1"><a href="javascript:void(0)" onclick="collect({{$goodDetail['id']}})">
            <em>收藏</em>
            @endif
            </a></li>
            <li class="car"><a href="#">加入购物车</a></li>
            <li class="buy"><a href="#">立即购买</a></li>
        </ul>
     </div>
     
     
     <!--弹出层，选择商品规格-->
     <div class="zhezhao">
         <div class="classify">
             <div class="sphead">
                 <div class="topimg"><img src="/{{$goodDetail['thumbnail']}}"></div>
                 <div class="topgui">
                     <ul>
                         <li class="zhekou">￥<span amount="{{$goodDetail['dis_amount']}}">{{$goodDetail['dis_amount']}}</span><em>折扣价</em></li>
                         <li class="lingshou">零售价：￥{{$goodDetail['amount']}}</li>
                         <li class="fenlei">请选择 规格分类</li>
                     </ul>
                 </div>
                 <a href="javascript:void(0)" class="classgb"><img src="/images/guanbi.png"></a>
             </div>
            @if($goodAttr)
            <div id="lei">
                @foreach($goodAttr as $attr )
                 <div class="lei">
                    <p>{{$attr['name']}}</p>
                    <ul>
                       <!-- <li class="xz">5L单桶</li> -->
                       @foreach($attr['list'] as $attrlist)
                       <li ids="{{$attrlist['ids']}}" attrprice="{{$attrlist['attr_price']}}"> {{$attrlist['attr_value']}}</li>
                       @endforeach
                    </ul>
                 </div>
                @endforeach
            </div>
            @endif
             
             <div class="shuliang"><span>数量</span>
             <div class="jiajian">
             <a href="#" class="jian"><img src="/images/jian.png"></a>
             <input type="text" value="1" stock="{{$goodDetail['stock']}}">
             <a href="#" class="jia"><img src="/images/jia.png"></a></div></div>
             
             <div class="classfooter">
                <ul>
                    <li class="car1"><a href="#">加入购物车</a></li>
                    <li class="buy1"><a href="#">立即购买</a></li>
                    <li class="car2"><a href="#">确定</a></li>
                </ul>
             </div>
         </div>
     </div>
     <!--弹出层，选择商品规格-->
</div>
<div id="ajax_return">
    
</div>
</body>
<script>        
  var mySwiper = new Swiper ('.swiper-container', {
    autoplay: 5000,
    loop: true,
	pagination : '.swiper-pagination',
  })
  //收藏处理
  function collect(goods_id){
        $(this).toggleClass("yisc");
        var va=$('.shouchang').attr('title');
        if(va==1){
            $('.shouchang').find('em').html('已收藏');
            $.get('/web/collectAdd?goods_id='+ goods_id+'');  
        }else{
            $('.shouchang').find('em').html('收藏');
            $.get('/web/collectDel?goods_id='+ goods_id+''); 
        }     
  }

  //点击规格时价格随之变化
$(document).ready(function(){
  $('.lei').find('li').click(function(){
    // var amount = $('.zhekou').find('span').html();
    var prices = '';
    $('#lei').find('li').each(function(){
                    if($(this).hasClass('xz')){
                        var price = $(this).attr('attrprice');
                        
                        prices = Number(price)+Number(prices);
                        console.log(prices);
                    }
                });
    // var price = $(this).attr('attrprice');
    var total = $('.zhekou').find('span').html(Number($('.zhekou').find('span').attr('amount'))+Number(prices));
    // console.log(total.html());
  });
});
        //数量加
        $('.jia').click(function(){
            var t=$(this).siblings('input');
            var stock = t.attr('stock');
            var id = t.attr('id');
            // console.log(stock);
            t.val(parseInt(t.val())+1);
            if(parseInt(t.val())>stock){
                t.val(stock);
            }
            
        })
        //数量减
        $('.jian').click(function(){
            var t=$(this).siblings('input');
            t.val(parseInt(t.val())-1);
            if(parseInt(t.val())<1){
                t.val(1);
            }
          
        })
    //立即购买确定按钮
    // $('.car2').click(function(){
    //     var num = $('.jian').siblings('input').val();
    //     var goods_id = $('.namePrice').attr('id');
    //     var attr_ids = '';
    //         $('#lei').find('li').each(function(){
    //             if($(this).hasClass('xz')){
    //                 var attr = $(this).attr('ids');
    //                 attr_ids += attr+",";
    //             }
    //         })
    //     // $.get('/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'');
    //     $.ajax({
    //             type:'get',
    //             url:'/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'',
    //             success:function(data){
    //                 $('.goodsdetail').hide();
    //                 // $('.footer').hide();
    //                 $('#ajax_return').html(data);
    //             }
    //         });
    // });

    //先选规格再立即购买
    $('.buy1').click(function(){
        var num = $('.jian').siblings('input').val();
            var goods_id = $('.namePrice').attr('id');
            var attr_ids = '';
                $('#lei').find('li').each(function(){
                    if($(this).hasClass('xz')){
                        var attr = $(this).attr('ids');
                        attr_ids += attr+",";
                    }
                })
            // $.get('/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'');
            $.ajax({
                    type:'get',
                    url:'/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'',
                    success:function(data){
                        $('.goodsdetail').hide();
                        // $('.footer').hide();
                        $('#ajax_return').html(data);
                    }
                });
    })
    //先选规格再加入购物车
    $('.car1').click(function(){
        var num = $('.jian').siblings('input').val();
            var goods_id = $('.namePrice').attr('id');
            var attr_ids = '';
                $('#lei').find('li').each(function(){
                    if($(this).hasClass('xz')){
                        var attr = $(this).attr('ids');
                        attr_ids += attr+",";
                    }
                })
            $.ajax({
                    type:'get',
                    url:'/web/car/cart?good_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'',
                    success:function(data){
                        console.log('添加购物车成功');
                        $('.zhezhao').hide();
                        // $('.footer').hide();
                        // $('#ajax_return').html(data);
                    }
                });
    })
    //先点立即购买或加入购物车再选规格
    $(".car,.buy").click(function(){
    //判断是立即购买还是加入购物车，分别跳到2个不同的方法
     if ($(this).hasClass('car')) {
            $('.car2').click(function(){
            var num = $('.jian').siblings('input').val();
            var goods_id = $('.namePrice').attr('id');
            var attr_ids = '';
                $('#lei').find('li').each(function(){
                    if($(this).hasClass('xz')){
                        var attr = $(this).attr('ids');
                        attr_ids += attr+",";
                    }
                })
            $.ajax({
                    type:'get',
                    url:'/web/car/cart?good_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'',
                    success:function(data){
                        console.log('添加购物车成功');
                        $('.zhezhao').hide();
                        // $('.footer').hide();
                        // $('#ajax_return').html(data);
                    }
                });
        });
     };
     if ($(this).hasClass('buy')) {
            // console.log('buy');
            $('.car2').click(function(){
            var num = $('.jian').siblings('input').val();
            var goods_id = $('.namePrice').attr('id');
            var attr_ids = '';
                $('#lei').find('li').each(function(){
                    if($(this).hasClass('xz')){
                        var attr = $(this).attr('ids');
                        attr_ids += attr+",";
                    }
                })
            // $.get('/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'');
            $.ajax({
                    type:'get',
                    url:'/web/order/gobuy?goods_id='+goods_id+'&num='+num+'&attr_ids='+attr_ids+'',
                    success:function(data){
                        $('.goodsdetail').hide();
                        // $('.footer').hide();
                        $('#ajax_return').html(data);
                    }
                });
        }); 
     };
     $(".zhezhao").show();
     $(".classify").slideDown("slow");
     $(".car2").show();
     $(".buy1,.car1").hide();
    })
</script>
</html>
