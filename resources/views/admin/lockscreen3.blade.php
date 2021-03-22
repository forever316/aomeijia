<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
    <link href="/assets/admin/login2/css/loginCss.css" rel="stylesheet" />
    <script src="/assets/admin/login2/js/jQuery v1.7.1 .js"></script>
    <script src="/assets/admin/login2/js/loginJs.js"></script>
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <title>澳美家管理后台 - 登录</title>
<title>登录</title>
</head>
<body>
     <header>
         <h1>澳美家 · 管理系统</h1>
     </header>
     <form method="post" action="/login2" target="_self">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <div class="content">
          <div class="login">
          	  <em>{{$name}}</em>
              <input type="password" id="password" class="pwd" placeholder="请输入密码" name="password" value="{{ old('password') }}" required="">
              <input type="submit" value="登录">
          </div>
     </div>
     </form>
     <script src="/assets/admin/js/plugins/layer/new/layer.js"></script>
     <script src="/assets/common/jquery.cookie.js"></script>
     <script src="/assets/common/common.js"></script>
     <script type="text/javascript">
         $(function(){
             <?php
                 if(isset($data)):
              ?>
             var data = jQuery.parseJSON('<?php echo $data ?>');
             $.kh.fromTips(data,4);
             <?php endif;?>
         });
     </script>
</body>
</html>
