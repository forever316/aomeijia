<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投资攻略</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/news.css" />
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="investment-strategy-news-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>国家攻略</span>
            <i>></i>
            <span>{!! $data['searchInfo']['regionName'] !!}</span>
            <i>></i>
            <span>{!! $data['searchInfo']['areaName'] !!}</span>
            <i>></i>
            <span>{!! $data['searchInfo']['areaName'] !!}投资优势</span>
        </div>

        <div class="news-wrapper">
            <div class="info-box">
                <p class="title">
                    {!! $data['data']['title'] !!}
                </p>
                <div class="share-btn" @click="isShareShow = !isShareShow">
                    <img src="../../images/overseas-property/detail/share.png" alt="">
                    <span>分享</span>
                    <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                        <div id="share"></div>
                    </div>
                </div>
            </div>
            <div class="detail">
                {!! $data['data']['content'] !!}
            </div>
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.four_house')
            @include('front.common.four_migrate')
        </div>
    </section>
    @include('front.common.footer')
</main>

<script src="/front/utils/sharejs/js/qrcode.js"></script>
<script src="/front/utils/sharejs/js/social-share.js"></script>
<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/news.js"></script>
</body>
</html>