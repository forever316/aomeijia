<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/recharge.css">
<title>我的余额</title>
</head>
<body class="bv">
	 <div class="balance">
           <ul>
               <li><span>账户余额(元)</span><a href="/web/my/balanceDate">明细</a></li>
               <li class="figure">{{$datas['balance']}}</li>
           </ul>
      </div>
      
      <div class="navListCss">
           <ul>
               <li class="recharge"><a href="/web/my/recharge">充值</a></li>
               <li class="withdrawdeposit"><a href="/web/my/withdraw">提现</a></li>
           </ul>
      </div>
</body>
</html>
