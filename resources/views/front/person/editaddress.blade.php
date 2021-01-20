<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<link type="text/css" href="/css/LArea.css" rel="stylesheet">
<script src="/js/LAreaData2.js"></script>
<script src="/js/LArea.js"></script>
<title>编辑地址</title>
</head>
<body>
     <div class="address">
        <form method="post" action="/web/addressEdit?id={{$datas['id']}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <ul>
            <input type="hidden" value="{{$datas['id']}} " name="id">
             <li><span>收货人：</span><input type="text" value="{{$datas['name']}}" name="name"></li>
             <li><span>联系电话：</span><input type="text" value="{{$datas['phone']}}" name="phone"></li>
             <li class="xz"><span>所在地区：</span><input type="text"  value="{{$datas['province']}}省{{$datas['city']}}市{{$datas['area']}}" id="demo2"  readonly>
             <input type="hidden" id="value2" name="province"></li>
             <li><span>详细地址：</span><input type="text" value="{{$datas['address']}}" name="address"></li>
         </ul>
         <button class="save">保存</button>
         <!-- <a href="#" class="save">保存</a> -->
        </form>
     </div>
</body>
<script>
    var area2 = new LArea();
    area2.init({
        'trigger': '#demo2',
        'valueTo': '#value2',
        'keys': {
            id: 'value',
            name: 'text'
        },
        'type': 2,
        'data': [provs_data, citys_data, dists_data]
    });
</script>
</html>
