<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jQuery v1.7.1 .js"></script>
<script type="text/javascript" src="/js/myJs.js"></script>
<title>工种</title>
</head>
<body class="bdcolor">
<div class="worktype">
    <div class="profession">
        <ul>   
            @foreach($workdatas as $workdata)
                <li class=" @if($workdata['name'] == $work_type) pitch-on @endif">{{$workdata['name']}}</li>
            @endforeach
        </ul>
    </div>
    <div class="paffirm" onclick="update()">确认</div>
</div>
<div class="show">
    
</div>
    <script type="text/javascript">
        function update()
        {
            var data = ($('.pitch-on').html());
                // $.get('/web/my/worktype?type='+data+'');
                $.ajax({
                    type:'get',
                    url:'/web/my/worktype?type='+data+'',
                    success:function(data){
                        $('.worktype').hide();
                        $('.show').html(data);
                    }
                });
        }
    </script>
</body>
</html>
