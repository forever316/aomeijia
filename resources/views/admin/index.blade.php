<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    {{--<meta http-equiv="Cache-Control" content="no-siteapp" />--}}
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="0">
    <title><?php echo WEBNAME; ?> - 首页</title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link href="/assets/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/assets/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/assets/admin/css/animate.min.css" rel="stylesheet">
    <link href="/assets/admin/css/style.min.css?v=4.0.0" rel="stylesheet">

    <script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/assets/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/assets/admin/js/plugins/layer/new/layer.js"></script>
    <script src="/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/admin/js/hplus.min.js?v=4.0.0"></script>
    <script src="/assets/admin/js/contabs.min.js"></script>
    <script src="/assets/admin/js/plugins/pace/pace.min.js"></script>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        @include('admin.menu')
        @include('admin.top')
    </div>
</body>
</html>