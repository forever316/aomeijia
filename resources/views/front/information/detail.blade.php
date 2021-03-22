<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>百科资讯</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/news/detail.css" />
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="news-detail-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>百科咨询</span>
            <i>></i>
            <span>{!! $data['data']['title'] !!}</span>
        </div>

        <div class="detail-wrapper">
            <div class="detail-left-wrapper">
                <div class="news-wrapper">
                    <p class="title">
                        {!! $data['data']['publish_date'] !!}
                    </p>
                    <div class="info-box">
                        <div class="info">
                            <span>时间：{!! $data['data']['title'] !!}</span>
                            <span>阅读量：{!! $data['data']['read'] !!} 次</span>
                        </div>
                        <div class="share-btn" @click="isShareShow = !isShareShow">
                            <img src="/images/overseas-property/detail/share.png" alt="">
                            <span>分享</span>
                            <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                                <div id="share"></div>
                            </div>
                        </div>
                    </div>
                    <div class="detail">
                        {!! $data['data']['content'] !!}
                    </div>

                    <div class="about-wrapper">
{{--                        <div class="header">--}}
{{--                            <span>相关内容：</span>--}}
{{--                            <span class="text">柬埔寨经济</span>--}}
{{--                            <span class="text">石油</span>--}}
{{--                            <span class="text">泰国湾</span>--}}
{{--                        </div>--}}
                        <div class="next-box">
                            <div class="inner">
                                @if($data['last_article'])
                                <span class="tag">上一篇</span>
                                <span class="title text-overflow-1"><a href="/information/detail?id={{$data['last_article']['id']}}">{!! $data['last_article']['title'] !!}</a></span>
                                @endif
                            </div>
                            <div class="inner">
                                @if($data['next_article'])
                                <span class="tag">下一篇</span>
                                <span class="title text-overflow-1"><a href="/information/detail?id={{$data['next_article']['id']}}">{!! $data['next_article']['title'] !!}</a></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('front.information.right_theme_faq_ad')
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
<script src="/front/utils/vue.js"></script>
<script src="/front/js/news/detail.js"></script>
</body>
</html>