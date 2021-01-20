<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/integral.css">
<title>积分明细</title>
</head>
<body class="bgcolor">
	<div class="detailList">
        @foreach($datas as $data)
           <div class="detailOne">
                <ul>
                    <li><span>{{$data['remarks']}}</span><em>{{$data['created_at']}}</em></li>
                    <li><b>剩余积分:{{$data['current_blaance']}}</b>
                    <i>
                    @if($data['type']==1)
                    +{{$data['operation_amount']}}
                    @else($data['type']==2)
                    -{{$data['operation_amount']}}
                    @endif
                    </i>
                    </li>
                </ul>
           </div>
        @endforeach  
    </div>
</body>
</html>
