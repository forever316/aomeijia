<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<title>修改名字</title>
</head>
<body class="bdcolor">
    <div class="companyName">
    <form action="/web/my/changeName" method="post" name="form">
    <!-- <form > -->
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="text" class="nickname" value="{{$data['nickname']}}" name="nickname">
        <p class="tishi">4-32个字符,可由中文、英文、数字、“_”、“-”组成</p>
        <!-- <button class="companyaffirm" >确认</button> -->
        <input class="companyaffirm" type="submit" value="确认">
    </form>
    </div>
    <script type="text/javascript">
	    $('form').submit(function(){
					var name = $('.nickname').val();
					var preg = /[\u4e00-\u9fa5a-zA-Z0-9_-\-]{4,20}/;
					var p = name.match(preg);
					if (name && p!=null ) {
						return true;
					}else{
						return false
					}
		})
    </script>
</body>
</html>
