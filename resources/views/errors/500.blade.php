<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?php echo WEBNAME; ?> - 错误</title>

    <link href="/assets/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/assets/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/assets/admin/css/animate.min.css" rel="stylesheet">
    <link href="/assets/admin/css/style.min.css?v=4.0.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">服务器内部错误</h3>
        <div class="error-desc">
            服务器好像出错了...
            {{$exception->getMessage()}}
            <br/><a href="/" class="btn btn-primary m-t">主页</a>
        </div>
    </div>
<script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/admin/js/bootstrap.min.js?v=3.3.5"></script>
</body>
</html>