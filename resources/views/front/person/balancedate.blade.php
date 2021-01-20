<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/recharge.css">
<title>致富</title>
</head>
<body class="bv">
	<div class="detailList">
        @foreach($datas as $data)
           <div class="detailOne">
                <ul>
                    <li>
                        <span>
                        @if($data['type']==1)
                            充值
                        @elseif($data['type']==2)
                            提现
                        @elseif($data['type']==3)
                            平台修改
                        @elseif($data['type']==4)
                            在线支付
                        @elseif($data['type']==5)
                            平台消费
                        @else
                            平账专用
                        @endif
                        </span>
                        <em>{{$data['created_at']}}</em>
                    </li>
                    <li>
                        <b>余额:{{$data['current_blaance']}}</b>
                        @if($data['type']==1)
                        <i>+{{$data['operation_amount']}}</i>
                        @else
                        <i>-{{$data['operation_amount']}}</i>
                        @endif
                    </li>
                </ul>
           </div>
        @endforeach
    </div>
</body>
</html>
