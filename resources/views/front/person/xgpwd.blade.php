<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<title>修改密码</title>
</head>
<body class="bdcolor">
<form method="post" action="editPwd">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="companyName">
        <input type="password" class="pwd" placeholder="请输入旧密码" name="old_password">
    </div>
    <div class="companyName">
        <input type="password" class="newpwd" placeholder="请输入新的密码" name="password">
    </div>
    <div class="companyName">
        <input type="password" class="twopwd" placeholder="请再次输入新的密码" name="varify_password">
        <input class="companyaffirm" type="submit" value="确认">
        <!-- <a href="#" class="companyaffirm">确认</a> -->
    </div>
</form>
<script type="text/javascript">
        $('form').submit(function(){
                    var pwd = $('.pwd').val();
                    var newpwd = $('.newpwd').val();
                    var twopwd = $('.twopwd').val();
                    if (pwd && pwd!=null ) {
                        if(newpwd && newpwd!=null && newpwd==twopwd){
                            return true;
                        }else{
                           return false 
                        }   
                    }
        })
</script>
</body>
</html>
