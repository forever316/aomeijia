<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/myJs.js"></script>
<title>收货地址</title>
</head>
<body class="bdcolor">
     <div class="site">
         <!--一个地址-->
         @foreach($datas as $data)
         <div class="siteOne">
            <ul>
                <li><span>{{$data['name']}}</span><em>{{$data['phone']}}</em></li>
                <li class="kuang"><label>@if($data['city']){{$data['province']}}省{{$data['city']}}市{{$data['area']}}{{$data['address']}}@else {{$data['province']}}市{{$data['area']}}{{$data['address']}}  @endif</label></li>
                <li class="operate">
                @if ($data['is_default'] == 1)
                <a href="javascript:void(0)" class="xz thisxz" >默认地址</a>
                @else
                <a href="javascript:void(0)" class="xz " onclick="changeStatus({{$data['id']}})">设为默认</a>
                @endif
                <a href="/web/addressDel/{{$data['id']}}" class="delpng">删除</a>
                <a href="/web/addressEdit?id={{$data['id']}}" class="bjpng">编辑</a></li>
            </ul>
         </div>
         @endforeach
         <!--一个收货地址-->
     </div>
     <a href="/web/addressAdd" class="additionSite"><label><img src="../images/jia.png">添加地址</label></a>
    <script type="text/javascript">
    function changeStatus(id){
                $.get('/web/changeStatus/'+id+'');

            }
    </script>
</body>
</html>
