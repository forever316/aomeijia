<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" rel="stylesheet" href="/css/recharge.css">
<title>银行卡信息</title>
</head>
<body class="bv">
	 <div class="address">
	 <form method="post" action="/web/my/bankcard" >
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <ul>
             <li><span>持卡人：</span><input type="text" placeholder="请输入持卡人姓名" name="name"></li>
             <li><span>身份证号：</span><input type="text" placeholder="请输入您的身份证号码" name="idcard"></li>
             <li><span>银行卡号：</span><input type="text" placeholder="请输入银行卡号" name="bankcard"></li>
             <li><span>银行名称：</span><input type="text" placeholder="请输入银行名称" name="bankname"></li>
         </ul>
         <!-- <a href="#" class="save">保存</a> -->
         <button class="save">保存</button>
      </form>
     </div>
</body>
</html>
