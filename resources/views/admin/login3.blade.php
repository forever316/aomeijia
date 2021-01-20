<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="/assets/admin/login/css/loginCss.css" />
<script>if(window.top !== window.self){ window.top.location = window.location;}</script>
<title>致富管理后台 - 登录</title>
</head>
<body>
    <form action="/login" method="post" target="_self">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="kuang">
            <div class="textshu">
                <div class="formdiv">
                    <ul>
                        <li><label>用户名：</label><input id="name" name="name" value="{{ old('name') }}" required type="text"></li>
                        <li><label>密　码：</label><input id="password" name="password" value="{{ old('password') }}" required type="password"></li>
                        <li><label>验证码：</label><input type="text" id="captcha" name="captcha" value="{{ old('captcha') }}" class="yanzheng"><a href="#" class="ma"><img style="display: inline-block; border-radius: 4px;" src="/getCaptcha2" id="getcode_num" title="看不清，点击换一张" align="absmiddle"></a></li>
                    </ul>
                </div>
                <button type="submit" style="border: 0px;outline:none;cursor: pointer;" class="denglu"></button>

            </div>
        </div>
    </form>
    <script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
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
