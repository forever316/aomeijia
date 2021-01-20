<div class="footer">
         <ul>
            <a href="/web/main"><li class=" @if($title=='首页') {{$active}} @else index @endif" ><em>首页</em></li></a>
            <a href="/web/itemize"><li class=" @if($title=='分类') {{$active}} @else fenlei @endif"><em>分类</em></li></a>
            <a href="/web/car"><li class=" @if($title=='购物车') {{$active}} @else car @endif"><em>购物车</em></li></a>
            <a href="/web/my"><li class=" @if($title=='我的') {{$active}} @else my @endif"><em>我的</em></li></a>
         </ul>
</div>