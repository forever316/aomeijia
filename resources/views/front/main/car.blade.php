@include('front.main.head')
<script type="text/javascript" src="/js/jquery-2.1.4.js"></script>
<script src="/js/indexJs.js"></script>
<body class="bgcol">
    <div id="car">
	 <div class="header">
          <span>购物车</span>
          <a href="#" class="bianji" title="1">编辑</a>
     </div>
     
     <div class="carlist">

         <!--一个购物车订单-->
        @if($myCar)
        @foreach ($myCar as $car )
         <div class="onecar">
             <div class="xuanzhong "></div>
             <div class="spimg">
            @if($car['thumbnail'])
                <img src="/{{$car['thumbnail']}}">
            @endif
             </div>
             <div class="xq">
                 <ul>
                    <li class="spname"> {{$car['goods_name']}} </li>
                    <li class="guige"> {{$car['attr_name']}} </li>
                    <li class="jiage">￥<font>{{$car['amount']}}</font></li>
                 </ul>
                 <div class="jiejian">
                     <a href="#" class="jian"></a>
                     <input  class="test" id="{{$car['ids']}}" stock="{{$car['stock']}}" value="{{$car['goods_number']}}"><a href="#" class="jia"></a>
                 </div>
             </div>
         </div>
        @endforeach
        @endif
         <!--一个购物车订单--> 
     </div>
     <!--结算-->
     <div class="account" id="jiesuan1">
         <div class="quanxuan" title="1">全选</div>
         <div class="heji">合计:￥<span class="he">0.00</span></div>
         <div class="jiesuan"><a href="#">结算(<em>0</em>)</a></div>
     </div>
     <!--结算-->
     <!--结算-->
     <div class="account adel" style="display:none;" id="jiesuan2">
         <div class="quanxuan" title="1">全选</div>
         <div class="del"><a href="">删除</a></div>
     </div>
     <!--结算-->
     </div>
    <form action="" method="post">
        <div id="ajax_return">
            
        </div>
    </form>
	@include('front.main.foot')
    <script type="text/javascript">
   
    $(document).ready(function(){
        $(".xuanzhong").click(function(){
           $(this).toggleClass("xuanzhong-01");
           totalNum(); //统计总的数量  
           totalMoney();//统计总价格
        })
        $(".quanxuan").click(function(){
           $(this).toggleClass("xuanzhong-01");
           $(this).removeClass('xuanzhong-01');
           totalNum(); //统计总的数量  
           totalMoney();//统计总价格
        })
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
            $.get('/web/car/goodNum?num='+t.val()+'&&id='+id+'');
            if($(".carlist .xuanzhong").hasClass('xuanzhong-01')){  
                totalNum(); //统计总的数量  
                totalMoney();//统计总价格
            }    
        })
        //数量减
        $('.jian').click(function(){
            var t=$(this).siblings('input');
            var id = t.attr('id');
            t.val(parseInt(t.val())-1);
            if(parseInt(t.val())<1){
                t.val(1);
            }
            $.get('/web/car/goodNum?num='+t.val()+'&&id='+id+'');
            if($(".carlist .xuanzhong").hasClass('xuanzhong-01')){  
                totalNum(); //统计总的数量  
                totalMoney();//统计总价格
            } 
        })
        //统计商品总数量
        function totalNum(){
            var num=0;
            $('.xuanzhong').each(function(){
                if($(this).hasClass('xuanzhong-01')){
                    var number = parseInt($(this).parent().find('input').val());
                    num += number;
                };
            });
            $(".jiesuan").find('em').html(num);
        }

        //统计商品总价格
        function totalMoney(){
            var totalMoney=0;
            $('.xuanzhong').each(function(){  
                if ($(this).hasClass('xuanzhong-01')) {  
                    var number = parseInt($(this).parent().find('input').val());
                    var money =  $(this).parent().find('font').html(); 
                    // console.log(number);
                    // console.log(money); 
                    money = parseInt(money)*parseInt(number); 
                    // console.log(money);  
                    totalMoney += money; 
                };
            });
            // $(".heji").empty().html("合计:￥<span>"+totalMoney.toFixed(2)+'<span>'); 
            $(".he").empty().html(""+totalMoney.toFixed(2)+'');
        }
        //点击结算
        $('.jiesuan').click(function(){
            var ids = '';
            var heji = $(".he").html();
            if(heji==0){
                alert('请选择您要购买的商品');
                
            }
            $('.xuanzhong').each(function(){  
                if ($(this).hasClass('xuanzhong-01')) {  
                    var id = $(this).parent().find('input').attr('id');
                    ids += id+",";
                };   
            });
            // console.log(ids);
            $.ajax({
                type:'get',
                url:'/web/car/jieSuan?ids='+ids+'',
                success:function(data){
                    $('#car').hide();
                    $('.footer').hide();
                    $('#ajax_return').html(data);
                }
            });
        });
        //点击删除
        $('.del').click(function(){
            var ids='';
            $('.xuanzhong').each(function(){  
                if ($(this).hasClass('xuanzhong-01')) {  
                    var id = $(this).parent().find('input').attr('id');
                    ids += id+",";
                };   
            });
            $.get('/web/car/delcar?ids='+ids+'');
        })

    });

    </script>
</body>
</html>
