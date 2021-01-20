<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="/assets/admin/login/css/loginCss.css" />
<script>if(window.top !== window.self){ window.top.location = window.location;}</script>
<title>致富管理后台 - 登录</title>
</head>
<body>
     <form method="post" action="/login2" target="_self">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="kuang">
             <div class="textshu">
                  <div class="formdiv">
                      <ul>
                          <li><label>用户名：</label><span>{{$name}}</span></li>
                          <li><label>密　码：</label><input type="password" id="password" name="password" value="{{ old('password') }}" required=""></li>
                      </ul>
                  </div>
                 <button type="submit" style="border: 0px;outline:none;cursor: pointer;" class="denglu"></button>
             </div>
         </div>
     </form>
     <script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
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
