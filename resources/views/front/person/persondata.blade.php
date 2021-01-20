<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0">
<link type="text/css" href="/css/MyCss.css" rel="stylesheet" />
<title>个人资料</title>
</head>
<style type="text/css">
    input[type='file']{
        opacity: 0;
        width:23%;
        position: absolute;
        right: 10%;
    }
    form{
    margin: 0;
    }
    .data li .imgTitle{
        line-height: 5.9rem;
        float: left;
    }
</style>
<body class="bdcolor">
   <div class="data">
       <ul>  
            <li>
            <form method="post" action="/web/my/editImg" enctype="multipart/form-data">
                <span class="imgTitle">头像</span><img src="/{{$data['head_portrait']}}" onclick="document.getElementById('abc').click()">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="file" id="abc"  name="head_portrait" onChange="document.getElementById('c').click()" >
                <input type="text" id="c" name="c" value="c" style="display:none" onclick="document.getElementById('a').click()">
                <input type="submit" id="a" style="display:none" >
            </form>
            </li>        
            <script>
            </script>
           <a href="/web/my/changeName"><li><span>姓名</span><strong>{{$data['nickname']}}</strong></li></a>
           <a href="/web/my/updateRel"><li><span>绑定手机号</span><strong>{{$data['phone']}}</strong></li></a>
       </ul> 
   </div>
   <div class="data">
       <ul>
            <a href="/web/my/worktype"><li><span>工种</span><strong>{{$work_type}}</strong></li></a>
            <a href="/web/my/companyName?id={{$userInfo['user_id']}}"><li><span>公司名称</span><strong>{{$userInfo['company_name']}}</strong></li></a>
       </ul>
   </div>
</body>
</html>
