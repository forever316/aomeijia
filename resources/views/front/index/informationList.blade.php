<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/searchCss.css" />
<title>消息</title>
</head>
<body class="bgco">
    <div class="xxlist">
       <!--一条系统消息-->
       @if($datas)
       @foreach($datas as $data)
       <a href="http://tl.youyu333.com/system.html?id={{$data['id']}}&access_token={{$access_token}}&access_key={{$access_key}}"><div class="onexiaoxi">
        @if($data['status']==-1)
           <div class="img"><img src="/images/new.png"></div>
        @else
            <div class="img"><img src="/images/yidu.png"></div>
        @endif
           <div class="text">
               <ul>
                  <li><span>消息标题</span><em><?php echo date('Y-m-d ',$data['add_time']); ?></em></li>
                  <li><strong>{{$data['content']}}</strong></li>
               </ul>
           </div>
       </div></a>
       @endforeach
       @endif
       <!--一条系统消息-->
    </div>
</body>
</html>
