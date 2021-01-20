@include('front.main.head')
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/indexJs.js"></script>

<body>
     <div class="sousuo">
        <form method="post" action="/web/goodsList">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a href="#" class="sao"></a>
            <input type="text" placeholder="请输入商品关键字" name="search">
        </form>
     </div>
     
     <div class="sort">
     
         <div class="sort-left">
            <ul>
                @foreach ($typeList as $list)
                @if($typeList[0]['name'] == $list['name'])
                    <li  class="dqsort" id="{{$list['name']}}"><a href="#">{{$list['name']}}</a></li>
                @else
                <li  id="{{$list['name']}}"><a href="#">{{$list['name']}}</a></li>
                @endif
                @endforeach
            </ul>
         </div>
         <div class="sort-right">    
             <!--一个分类-->
            @foreach ($typeList as $list)
                @if($list['childs'])
                    @foreach ($list['childs'] as $list1)
                    @if($typeList[0]['name'] == $list['name'])
                    <div class="oneli" id="{{$list['name']}}_01">
                    @else
                    <div class="oneli yin" id="{{$list['name']}}_01">
                    @endif
                         <h2>{{$list1['name']}}</h2>
                         <div class="cnei">
                            <ul>
                            @if($list1['childs'])
                            @foreach ($list1['childs'] as $list2)
                                <a href="/web/goodsList?goods_type_id={{$list2['id']}}"><li><img src="/{{$list2['pic']}}"><span>{{$list2['name']}}</span></li></a>       
                            @endforeach
                            @endif
                            </ul>
                         </div>  
                     </div>
                     @endforeach
                 @endif
             @endforeach
             <!--一个分类-->
         </div>
     </div>
    @include('front.main.foot')
</body>
<script type="text/javascript">
	var pheight=$(window).height();
	$(".sort").css({"height":(pheight-48-53)+"px"});
</script>
</html>
