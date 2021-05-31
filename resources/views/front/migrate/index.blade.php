<!DOCTYPE html>
<html lang="en">
<style>
    .filter-wrapper > ul > li .val > span.on a {
        color: #fff !important;
    }
</style>
<head>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/immigrant/index.css" />
    @include('front.common.layout')
</head>

<body>
<main id="immigrant-page" v-cloak>
    @include('front.common.header')
    <section class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:420px;">
    </section>

    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>全球移民</span>
        </div>

        <div class="filter-wrapper">
            <ul>
                <li>
                    <span class="text">地区：</span>
                    <div class="val">
                        @foreach($data['region'] as $key=>$val)
                            <span class="@if($data['searchInfo']['region']==$key) on @endif"><a href="{{$data['url']}}&region={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">国家：</span>
                    <div class="val">
                        @foreach($data['country'] as $key=>$val)
                            <span class="@if($data['searchInfo']['country']==$key) on @endif"><a href="{{$data['url']}}&country={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">类型：</span>
                    <div class="val">
                        @foreach($data['type'] as $key=>$val)
                            <span class="@if($data['searchInfo']['type']==$key) on @endif"><a href="{{$data['url']}}&type={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">投资：</span>
                    <div class="val">
                        @foreach($data['type_invest'] as $key=>$val)
                            <span class="@if($data['searchInfo']['type_invest']==$key) on @endif"><a href="{{$data['url']}}&type_invest={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>

        <div class="list-wrapper">
            <ul class="items">
{{--                <template v-for="(item, index) in 3" :key="index">--}}
                @foreach($data['data'] as $key=>$val)
                    <li class="item">
                        <div class="img-box">
                            <img src="/{!! $val['img'] !!}" alt="">
                            <p>{!! $val['title'] !!}</p>
                        </div>
                        <div class="detail-box">
                            <p class="desc" style="height:16px;">
                                @if($val['face'])面向人群：{{$val['face']}}@endif
                            </p>
                            <div class="box">
                                <span class="tag">项目特点</span>
                                <span class="val">{!! $val['project_charac'] !!}</span>
                            </div>
                            <div class="box">
                                <span class="tag">办理周期</span>
                                <span class="val">{!! $val['transact_period'] !!}</span>
                                <div class="price">
                                    ￥<span>{!! $val['total_price'] !!}万</span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrapper">
                            <a target="_blank" href="/migrate/detail?id={{$val['id']}}" class="btn">
                                点击查看详情
                            </a>
                            <div class="btn appointment" @click="isAppointmentShow = true">
                                立即预约
                            </div>
                        </div>
                    </li>
                @endforeach

{{--                </template>--}}
            </ul>
        </div>

        <div class="test">
            @if($data['test_img'])<img style="height:150px;" onclick="javascript:window.open('/migrate/test')" src="/{{$data['test_img']['img_url']}}" alt="">@endif
        </div>
    </section>

    @include('front.common.consult')
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/immigrant/index.js"></script>
<script>
    // window.onload=function() {
        // 导航
        $(".nav-list").mouseenter(function () {
            var el = $(this).find(".sub-nav");
            if (el) {
                el.stop().animate({height: "show"}, 300);
            }
        });
        $(".nav-list").mouseleave(function () {
            var el = $(this).find(".sub-nav");
            if (el) {
                el.stop().animate({height: "hide"}, 300);
            }
        });

    // }

    function consult(){
        $('#form_consult').find("input[name='type']").val(2);
        submitConsultData();
    }

</script>
</body>
</html>