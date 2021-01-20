<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<title>公司名称</title>
</head>
<body class="bdcolor">
    <div class="companyName">
    <form action="/web/my/companyName" method="post" name="form">
    <!-- <form > -->
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{$userInfo['user_id']}}">
        <input type="text" class="nickname" value="{{$userInfo['company_name']}}" name="companyname">
        
        <!-- <button class="companyaffirm" >确认</button> -->
        <input class="companyaffirm" type="submit" value="确认">
    </form>
    </div>
    <script type="text/javascript">
    </script>
</body>
</html>
