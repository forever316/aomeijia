<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/order.css">
<title>收货地址</title>
</head>
<body class="bse">
    
    <!--选择收货地址-->
    <div class="electdizhi">
    @foreach($datas as $data)   
       <!--一个收货地址-->
        <div class="oneelect" adsid="{{$data['id']}}">
        
          <ul >
            <li><span>{{$data['name']}}</span><em>{{$data['phone']}}</em></li>
            <li>
            <div class="b">
            @if($data['is_default']==1)<b class="show">默认@endif</b>
            </div>
            <strong>{{$data['province']}}省{{$data['city']}}市{{$data['area']}}区{{$data['address']}}</strong></li>
          </ul>
      
       </div>
       <!--一个收货地址-->
    @endforeach
    </div>
    <div id="fillorder">
        
    </div>
    <!--选择收货地址-->
     <script type="text/javascript">
        var adsid = $('.oneelect').attr('adsid');
        $('.oneelect').click(function(){
            var adsid = $(this).attr('adsid');
            // console.log(adsid);
            $('.electdizhi').hide();
            $('#fillorder').show();
            $('.site').find('span').html($(this).find('span').html());
            $('.site').find('strong').html($(this).find('em').html());

            $('.site').attr('adsid',$(this).attr('adsid'));
            
            if($('.site').find('em').html()!=$(this).find('b').html()){
                $('.site').find('em').remove();

            }
            $('.dizhi').html($(this).find('strong').html());
            $('.dizhi').attr('address_id',adsid);
            });
                
     </script>
</body>
</html>
