<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/recharge.css">
<script type="text/javascript" src="/js/jquery-2.1.4.js"></script>

</head>
<title>提现</title>
<body class="bv">
    <div class="yhk">
    @if(!$data)<a href="/web/my/bankcard">@endif
       <ul>
        
           <li><span>持卡人</span><strong>@if($data){{$data['real_name']}}@endif</strong></li>
           <li><span>到账银行卡</span><em>@if($data){{$data['bank_name']}} ({{$data['bank_card_number']}})@endif</em></li>

       </ul>
    </a></div>
	<div class="cash">
        <h3>提现金额</h3>
        <input id="cash" type="text" placeholder="请输入提现金额" autofocus="autofocus"> 
        <p>可获得金额：<em></em>元</p>
    </div>
    <p class="keti">提现金额最低不能低于300元！</p>
    <a href="#" class="queren">提现</a>
    <script type="text/javascript">
        $('#cash').click(function(){
            var money = $(this).val();
            if(money<300){
                alert('提现金额最低不能低于300元！');
            }
            $('.cash').find('em').html(money);
        })
    </script>
</body>
</html>
