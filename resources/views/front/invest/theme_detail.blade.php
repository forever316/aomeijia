<!DOCTYPE html>
<html lang="en">
<head>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/theme-detail.css" />
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="investment-strategy-theme-detail-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>投资主题</span>
            <i>></i>
            <span>{!! $data['data']['title'] !!}</span>
        </div>

        <div class="detail-wrapper">
            <div class="detail-left-wrapper">
                <div class="news-wrapper">
                    <div class="info-box">
                        <img src="/{!! $data['data']['thumb'] !!}" alt="">
                        <div class="info-right">
                            <p class="title">
                                {!! $data['data']['title'] !!}
                            </p>
                            <p class="desc">
                                {!! $data['data']['describe'] !!}
                            </p>
                        </div>
                    </div>
                    <div class="share-box">
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
{{--                    <div class="more-case">--}}
{{--                        更多热门成功案例：<span>柬埔寨</span><span>迪拜</span><span>希腊</span>--}}
{{--                    </div>--}}
                </div>
            </div>

            <div class="detail-right-wrapper">
                @include('front.common.right_five_info')
                @include('front.common.right_four_faqs')
            </div>
        </div>

        @include('front.common.contact')
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
<script src="/front/js/investment-strategy/theme-detail.js"></script>
</body>
</html>
<script>
    function consult(){
        $('#form_consult').find("input[name='type']").val(7);
        submitConsultData();
    }
</script>