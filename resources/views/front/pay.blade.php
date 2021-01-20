<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>微信支付</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        wx.config(<?php echo $js->config(array('chooseWXPay'),false) ?>);
        wx.ready(function(){
            wx.chooseWXPay({
                timestamp: <?= $config['timestamp'] ?>,
                nonceStr: '<?= $config['nonceStr'] ?>',
                package: '<?= $config['package'] ?>',
                signType: '<?= $config['signType'] ?>',
                paySign: '<?= $config['paySign'] ?>', // 支付签名
                success: function (res) {
                    // 支付成功后的回调函数
                    window.location.href="/web/main";
                },
                cancel:function(res){
                    window.history.back();
                }
            });
        });
        wx.error(function(res){
            alert('js参数配置失败');
        });
    </script>
</head>
<body>
    <h1></h1>
</body>
</html>