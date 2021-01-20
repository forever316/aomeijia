@include('front.main.head')
<link type="text/css" rel="stylesheet" href="/css/swiper-3.4.0.min.css">
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/swiper-3.4.0.jquery.min.js"></script>
<script type="text/javascript" src="/js/indexJs.js"></script>

<body class="bgcol">
     
     <!--banner 搜索框-->
	 <div class="swiper-container">
        <div class="swiper-wrapper">
        @foreach ($items as $item)
          <div class="swiper-slide">
          <a href="{{$item->link}}">
          <img src="/{{$item->img_url}}">
          </a>
          </div>
        @endforeach 
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
        <!--搜索框-->
        <div class="sousuo sousuo1">
            <a href="#" class="sao sao1"></a>
            <a href=""><input type="text" placeholder="请输入商品关键字"></a>
            <a href="/web/messList" class="@if($mess) xiaowei @else xiaoxi @endif"></a>
        </div>
        <!--搜索框-->
     </div>
     <!--banner 搜索框-->
     
     <!--菜单，涂料头条-->
     <div class="fourNav">
         <ul>
            @foreach ($apimodulars as $apimodular)
                @if($apimodular->id == 1)
                <a href="/web/goodsList">
                @elseif($apimodular->id == 2)
                <a href="/web/order/orderList">
                @elseif($apimodular->id == 3)
                <a href="/web/my/myIntegral">
                @elseif($apimodular->id == 4)
                <a href="/web/my/jfStore">
                @endif
                <li><img src="/{{$apimodular->thumb}}"><em>{{$apimodular->name}}</em></li></a>
            @endforeach
         </ul>
     </div>
     <div class="zixun">
         <span><img src="/images/zixun.png"></span>
         <ul id="wufeng">
            @foreach ($articles as $article)
                <li style="display:block"><a href="http://tl.youyu333.com/information.html?id={{$article->id}}&access_key=1C694C95">{{$article->title}}</a></li>
            @endforeach
         </ul>
         <a href="javascript:void(0)" id="next" style="display:none"></a>
     </div>
     <!--菜单，涂料头条-->
     
     <!--新品展示-->
     <div class="xin">
         
        <!--一个展示模块-->
        <div class="zhanshi">
        @foreach ($datas as $data)
            <div class="zhansp">
                 <p class="title">{{$data['modular_name']}}</p>
                 <ul>
                @if($data['length'] == 5)
                    <a href="/web/goodsList?goods_type_id={{$data['content'][0]['goods_type_id']}}"><li>
                       <div class="zsleft">
                          <span>{{$data['content'][0]['title']}}</span>
                          <em>{{$data['content'][0]['desc']}}</em>
                       </div>
                       <div class="zsimg"><img style="width:78px;height:92px;" src="/{{$data['content'][0]['img']}}"></div>
                    </li></a>
                    <a href="/web/goodsList?goods_type_id={{$data['content'][0]['goods_type_id']}}"><li class="duan">
                       <div class="zstop">
                          <span>{{$data['content'][1]['title']}}</span>
                          <em>{{$data['content'][1]['desc']}}</em>
                       </div>
                       <div class="zsbottom"><img style="width:52px;height:61px;" src="/{{$data['content'][1]['img']}}"></div>
                    </li></a>
                    <a href="/web/goodsList?goods_type_id={{$data['content'][0]['goods_type_id']}}"><li class="duan duan1">
                       <div class="zstop">
                          <span>{{$data['content'][2]['title']}}</span>
                          <em>{{$data['content'][2]['desc']}}</em>
                       </div>
                       <div class="zsbottom"><img style="width:52px;height:61px;" src="/{{$data['content'][2]['img']}}"></div>
                    </li></a>
                    <a href="/web/goodsList?goods_type_id={{$data['content'][0]['goods_type_id']}}"><li>
                       <div class="zsleft">
                          <span>{{$data['content'][3]['title']}}</span>
                          <em>{{$data['content'][3]['desc']}}</em>
                       </div>
                       <div class="zsimg"><img style="width:78px;height:92px;" src="/{{$data['content'][3]['img']}}"></div>
                    </li></a>
                    <a href="/web/goodsList?goods_type_id={{$data['content'][0]['goods_type_id']}}"><li class="duan1">
                       <div class="zsleft">
                          <span>{{$data['content'][4]['title']}}</span>
                          <em>{{$data['content'][4]['desc']}}</em>
                       </div>
                       <div class="zsimg"><img style="width:78px;height:92px;" src="/{{$data['content'][4]['img']}}"></div>
                    </li></a>
                @elseif($data['length'] == 4)
                    <a href="/web/goodsDetail?id={{$data['content'][0]['goods_id']}}"><li class="duan4">
                        <img src="/{{$data['content'][0]['img']}}">
                    </li></a>
                    <a href="/web/goodsDetail?id={{$data['content'][1]['goods_id']}}"><li class="duan4">
                        <img src="/{{$data['content'][1]['img']}}">
                    </li></a>
                    <a href="/web/goodsDetail?id={{$data['content'][2]['goods_id']}}"><li class="duan4">
                        <img src="/{{$data['content'][2]['img']}}">
                    </li></a>
                    <a href="/web/goodsDetail?id={{$data['content'][3]['goods_id']}}"><li class="duan4">
                        <img src="/{{$data['content'][3]['img']}}">
                    </li></a>
                @elseif($data['length'] == 2)
                    <a href="/web/goodsDetail?id={{$data['content'][0]['goods_id']}}"><li class="duan5">
                        <img src="/{{$data['content'][0]['img']}}">
                    </li></a>
                    <a href="/web/goodsDetail?id={{$data['content'][1]['goods_id']}}"><li class="duan5">
                        <img src="/{{$data['content'][1]['img']}}">
                    </li></a>
                @endif
                 </ul>
            </div>
            <div class="daohang">
                <img style="width:379px;height:79px;" src="/{{$data['modular_img']}}">
            </div>
        @endforeach
        </div>
        <!--一个展示模块-->
         
        
     </div>
     <!--新品展示-->
     
     <!--商品推荐-->
     <div class="tuijian">
        <div class="tuititle"></div>
        <!--推荐列表-->
        <div class="tuilist">
           <!--一个推荐-->
           @foreach ($items1 as $item1)
           <div class="onetui">
           <a href="/web/goodsDetail?id={{$item1->id}}">
              <img src="/{{$item1->thumbnail}}">
              <span>{{$item1->name}}</span>
              <em>￥{{$item1->amount}}</em>
           </a>
           </div>
           @endforeach
           <!--一个推荐-->
        </div>
        <!--推荐列表-->
     </div>
     <!--商品推荐-->
     
	@include('front.main.foot')
</body>
<script>        
  var mySwiper = new Swiper ('.swiper-container', {
    autoplay: 5000,
    loop: true,
	pagination : '.swiper-pagination',
  })
</script>
</html>
