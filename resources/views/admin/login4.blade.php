<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<link href="/assets/admin/login2/css/loginCss.css" rel="stylesheet" />
<script src="/assets/admin/login2/js/jQuery v1.7.1 .js"></script>
<script src="/assets/admin/login2/js/loginJs.js"></script>
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <title>澳美家管理后台 - 登录</title>
</head>
<body>
     <header>
         <h1>澳美家 · 管理系统</h1>
     </header>
     <form action="/login" method="post" target="_self">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <div class="content">
          <div class="login">
              <input id="name" name="name" placeholder="请输入用户名" value="{{ old('name') }}" class="name" required type="text">
              <input id="password" placeholder="请输入密码" name="password" value="{{ old('password') }}" required type="password">
              <input type="text" id="captcha" placeholder="请输入验证码" name="captcha" value="{{ old('captcha') }}" class="yanz">
              <a href="#">
                  <img style="display: inline-block; border-radius: 4px;" src="/getCaptcha2" id="getcode_num" title="看不清，点击换一张" align="absmiddle">
              </a>
              <input type="submit" value="登录">
          </div>
     </div>
     </form>
     <script src="/assets/common/jquery.cookie.js"></script>
     <script src="/assets/admin/js/plugins/layer/new/layer.js"></script>
     <script src="/assets/common/common.js?v=<?php echo time(); ?>"></script>
     <script type="text/javascript">
         $(function(){
             <?php
                 if(isset($data)):
              ?>
             var data = jQuery.parseJSON('<?php echo $data ?>');
             $.kh.fromTips(data,4);
             <?php endif;?>
             //获取验证码
             //$.kh.getCaptcha('120','34','captcha_span');
             $("#getcode_num").click(function(){
                 $(this).attr("src",'/getCaptcha2?' + Math.random());
             });
         });
     </script>
</body>
</html>
