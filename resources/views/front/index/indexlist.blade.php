<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/listCss.css">
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/indexlistJs.js"></script>
<title>新品上市</title>
</head>
<body>
    
    <div class="search">
        <form method="post" action="/web/goodsList">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="searchDiv">
                <input type="text" placeholder="请输入商品关键字" name="search">
            </div>
        </form>
        <div class="screen">
             <ul>
                <a href="#"><li class="onesc">综合</li></a>
                <div class="zzc">
                   <ul>
                      <li class="xzthis"><a href="#">综合排序</a></li>
                      <li><a href="#">新品优先</a></li>
                   </ul>
                </div>
                <a href="#"><li class="twosc"><a href="/web/goodsList?salls=salls">销量</a></li></a>
                <a href="#">
                    <li class="threesc" value="1" onclick="jiage()">价格
                        <em class="shang"></em>
                        <em class="xia"></em>
                    </li>
                </a>
             </ul>
         </div>
    </div>
    
     
    <div class="collect">
    @foreach($datas as $data)
        <!--一个收藏-->
        <a href="#"><div class="oneCollect">
             <div class="img"><img src="/{{$data['thumbnail']}}"></div>
             <div class="xq">
                 <ul>
                    <li class="spname">{{$data['name']}}</li>
                    <li class="guige">{{$data['describe']}}</li>
                    <li class="jiage">￥{{$data['amount']}}</li>
                 </ul>
             </div>
        </div></a>
        <!--一个收藏-->
    @endforeach
    </div>
    <script type="text/javascript">
    function jiage(){
        $(".threesc").click(function(){
        $(this).addClass("threesc-01");
        var vajia=$(this).attr('value');
        if(vajia==1){
            $(".shang").addClass("shang-01");
            $(".xia").removeClass("xia-01");
            $(this).attr('value','2');
            // $.get("/web/goodsList?jiage=1");
            $.ajax({
                type:'post',
                url:'/web/goodsList?jiage=1',
                success:function(obj){
                    console.log('shang');
                }
            })
        }else{
            $(".shang").removeClass("shang-01");
            $(".xia").addClass("xia-01");
            $(this).attr('value','1');
            // $.get("/web/goodsList?jiage=2");
            $.ajax({
                type:'post',
                url:'/web/goodsList?jiage=1',
                success:function(obj){
                    console.log('xia');
                }
            })
        }
    })
    }
    </script>
</body>
</html>
