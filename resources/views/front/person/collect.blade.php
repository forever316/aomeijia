@include('front.main.head')
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<body class="bdcolor">
    <div class="collect">
        <!--一个收藏-->
        @foreach ($collectList as $collect)
        <a href="#"><div class="oneCollect">
             <div class="img"><img src="/{{$collect['thumbnail']}}"></div>
             <div class="xq">
                 <ul>
                    <li class="spname">{{$collect['goods_name']}}</li>
                    <li class="guige">规格1:白色   规格2:18L</li>
                    <li class="jiage">￥{{$collect['amount']}}</li>
                    <a href="/web/collectDel?goods_id={{$collect['goods_id']}}" class="xqdel"><img src="/images/del.png"></a>
                 </ul>
             </div>
        </div></a>
        @endforeach
        <!--一个收藏-->
       </div>
</body>
</html>
