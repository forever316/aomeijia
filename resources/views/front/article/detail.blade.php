<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="styleSheet" href="/front/css/introduction/detail.css" />
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="introduction-detail-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            {!! $data['header_route'] !!}
        </div>

        <div class="news-wrapper">
            @if($data['data'])
                <p class="title">
                    {!! $data['data']['title'] !!}
                </p>
                <div class="info-box">
                    <div class="info">
                        <span>时间：{!! $data['data']['publish_date'] !!}</span>
                        <span>阅读量：{!! $data['data']['read'] !!} 次</span>
                    </div>
                    <div class="share-btn" @click="isShareShow = !isShareShow">
                        <img src="/front/images/overseas-property/detail/share.png" alt="">
                        <span>分享</span>
                        <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                            <div id="share"></div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    {!! $data['data']['content'] !!}
                </div>
            @endif

            <div class="about-wrapper">
                <div class="next-box">
                    @if($data['last_article'])
                        <div class="inner">
                            <span class="tag">上一篇</span>
                            <span class="title text-overflow-1"><a target="_blank" href="/article?id={{$data['last_article']['id']}}">{!!  $data['last_article']['title'] !!}</a></span>
                        </div>
                    @endif
                    @if($data['next_article'])
                        <div class="inner">
                            <span class="tag">下一篇</span>
                            <span class="title text-overflow-1"><a target="_blank" href="/article?id={{$data['next_article']['id']}}">{!! $data['next_article']['title'] !!}</a></span>
                        </div>
                    @endif
                </div>
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
<script src="/front/js/introduction/detail.js"></script>
</body>
</html>