<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>全球移民</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/immigrant/appointment.css" />
    <script src="/front/js/immigrant/appointment.js"></script>
    @include('front.common.layout')
</head>

<body>
<main id="immigrant-appointment-page" >
    @include('front.common.header')
    <section class="container-wrapper"><p class="title"> 提交私人定制需求单 </p><p class="desc"> 请认真填写下述选项，澳美家为您定制最适合您的移民方案。 </p><div class="box"><div class="header"><span class="num">NO.1</span><span class="star">*</span><span class="text">您想去的国家？</span><span class="max">（最多可选3个）</span></div><div class="cont"><div class="opt">美国</div><div class="opt">马来西亚</div><div class="opt">柬埔寨</div><div class="opt">泰国</div><div class="opt">迪拜</div><div class="opt">菲律宾</div><div class="opt">日本</div><div class="opt">黑山</div><div class="opt">英国</div></div></div><div class="box"><div class="header"><span class="num">NO.2</span><span class="star">*</span><span class="text">您为什么想移民？</span><span class="max">（最多可选3个）</span></div><div class="cont"><div class="opt">子女教育</div><div class="opt">海外生育</div><div class="opt">养老储备</div><div class="opt">出行便利</div><div class="opt">海外置业</div><div class="opt">躲避雷劈</div><div class="opt">投资理财</div><div class="opt">旅游度假</div><div class="opt">税务筹划</div><div class="opt">其他</div></div></div><div class="box"><div class="header"><span class="num">NO.3</span><span class="star">*</span><span class="text">您的家庭资产？</span><span class="max">（单位人民币 ）</span></div><div class="cont"><div class="opt">50万以内</div><div class="opt">50-100万</div><div class="opt">100-200万</div><div class="opt">200-300万</div><div class="opt">300-400万</div><div class="opt">400-500万</div><div class="opt">500万以上</div></div></div><div class="box"><div class="header"><span class="num">NO.4</span><span class="star">*</span><span class="text">您的最高学历？</span></div><div class="cont"><div class="opt">高中以下</div><div class="opt">高中或中专</div><div class="opt">大专</div><div class="opt">本科或硕士</div><div class="opt">博士</div><div class="opt">其他</div></div></div><div class="box"><div class="header"><span class="num">NO.5</span><span class="star">*</span><span class="text">您希望获得的海外身份是什么？</span></div><div class="cont"><div class="opt">护照</div><div class="opt">永久居民</div><div class="opt">临时居民</div><div class="opt">长期签证</div><div class="opt">短期签证</div><div class="opt">其他</div></div></div><div class="box"><div class="header"><span class="num">NO.6</span><span class="star">*</span><span class="text">您的英语能力为多少级？</span></div><div class="cont"><div class="opt">雅思3分</div><div class="opt">雅思4分</div><div class="opt">雅思5分</div><div class="opt">雅思5.5分</div><div class="opt">雅思6分</div><div class="opt">雅思7分</div><div class="opt">其他</div></div></div><div class="box"><div class="header"><span class="num">NO.7</span><span class="star">*</span><span class="text">您的个人信息</span><span class="max">（所有信息均已进行加密处理）</span></div><div class="message"><div class="inner"><span class="text">姓名：</span><input type="text" placeholder="请输入您的姓名"></div><div class="inner"><span class="text">性别：</span><div class="radio-box"><input type="radio" id="male" value="male"><label for="male">先生</label><input type="radio" id="female" value="female"><label for="female">女士</label></div></div><div class="inner"><span class="text">电话：</span><input type="text" placeholder="请输入您的电话"></div><div class="inner"><span class="text">邮箱：</span><input type="text" placeholder="请输入您的邮箱"></div><div class="btn"> 立即提交 </div></div></div></section>  @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/vue.js"></script>--}}

</body>
</html>