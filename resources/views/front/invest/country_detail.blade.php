<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投资攻略</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/detail.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    @include('front.common.layout')
</head>

<body>
<main id="investment-strategy-detail-page" v-cloak>
    @include('front.common.header')
    <section class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:420px;">
    </section>

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
        </div>

        <div class="top-wrapper">
            <img src="/{!! $data['data']['thumb'] !!}" alt="">
            <div class="right">
                <div class="name-wrapper">
                    <p class="name">
                        {!! $data['searchInfo']['areaName'] !!}
                    </p>
                    <p class="desc">
                        {!! $data['searchInfo']['english_name'] !!}
                    </p>
                </div>
                <p class="text">
                    {!! $data['data']['describe'] !!}
                </p>

            </div>
        </div>

        <div class="advantage-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}投资优势</p>
                <p><a href="/invest/country/detailInfo?id={{$data['data']['id']}}">查看更多 > > ></a></p>
            </div>
            <div class="box">
{{--                <a href="">--}}
                    <img style="height: 200px;" src="/{!! $data['data']['advantage_img'] !!}" alt="">
{{--                </a>--}}
            </div>
        </div>

        @include('front.common.four_house')
        @include('front.common.four_migrate')

        <div class="answer-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}问答</p>
                <p><a href="#">查看更多 > > ></a></p>
            </div>
            <div class="cont">
                @foreach($data['faqs'] as $key=>$val)
                <div  class="question-box">
                    <div class="question">
                        <span class="tag">问</span>
                        <p>{!! $val['questions'] !!}</p>
                    </div>
                    <div class="answer text-overflow-2">
                        {!! $val['answers'] !!}
                    </div>
                </div>
                @endforeach
            </div>
            <img src="/front/images/investment-strategy/detail/img.jpg" class="img">
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.seven_info')
            @include('front.common.six_case')
        </div>
    </section>
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/detail.js"></script>
</body>
</html>