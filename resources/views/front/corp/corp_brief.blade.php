<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>澳美家</title>
    <link type="text/css" rel="styleSheet" href="/front/css/introduction/index.css" />
    <script src="/front/js/introduction/index.js"></script>
    @include('front.common.layout')
</head>
<body>
  <main id="introduction-index-page" v-cloak>
  @include('front.common.header')
    <section ref="banner" class="banner">
      <img src="/{{$data['topBanner']['img_url']}}" alt="">
    </section>

    <section ref="nav" :class="['page-nav-wrapper', { fixed: isNavFixed }]">
      <div class="nav-box">
        <div :class="{ on: navSelected == 'introduce' }" @click="selectNav('introduce')">澳美家简介</div>
        <div :class="{ on: navSelected == 'news' }" @click="selectNav('news')">集团动态</div>
        <div :class="{ on: navSelected == 'contact' }" @click="selectNav('contact')">联系我们</div>
        <div :class="{ on: navSelected == 'join' }" @click="selectNav('join')">加入我们</div>
      </div>
    </section>

    <section ref="content" class="container-wrapper">
      <div v-if="navSelected == 'introduce'" class="inner-wrapper">
        <div class="box">
          <div class="header">
            <p>关于我们</p>
            <p>About Us</p>
          </div>
          {!!$data['brief']['content']!!}
        </div>
      </div>

      <div v-else-if="navSelected == 'news'" class="news-wrapper">
        <div class="news-list">
        @foreach($data['dynamic'] as $key=>$val)
          <!-- <a v-for="(item, index) in 10" :key="index" href="./detail.html"> -->
          <a href="/article?id={{$val['id']}}">
            <img src="/{!!$val['thumb']!!}" alt="">
            <div class="right">
              <p class="title text-overflow-2">
                {!!$val['title']!!}
              </p>
              <p class="text text-overflow-2">
                {!!$val['describe']!!}
              </p>
              <div class="time">
                <span>{!!$val['publish_date']!!}</span>
                <span>{!!$val['read']!!}次阅读</span>
              </div>
            </div>
          </a>
        @endforeach
        </div>
        <div class="page-wrapper">
          {{ $data['dynamic']->links() }}
        </div>
        
        <!-- <div class="page-wrapper">
          <div class="page-box">
            <span>《</span>
            <span class="on">1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
            <span>》</span>
          </div>
        </div> -->
      </div>

      <div v-else-if="navSelected == 'contact'" class="inner-wrapper">
        <div class="box">
          <div class="header">
            <p>运营网络</p>
            <p>Operating Network</p>
          </div>
          {!!$data['contact']['content']!!}
        </div>
        <div class="box">
          <div class="header">
            <p>联系我们</p>
            <p>Contact us</p>
          </div>
          <div class="cont">
            <div class="contact-wrapper">
              <div class="left-box">
                <img src="/front/images/introduction/index/contact.jpg" class="bg">
                <div class="layer"></div>
                <div class="tel">
                  <img src="/front/images/common/tel.png" alt="">
                  <span>24小时咨询热线</span>
                </div>
                <p class="number">
                  {{$data['company']['custom_service_phone']}}
                </p>
                <div class="time">
                  <img src="/front/images/common/chat.png" alt="">
                  <span>在线咨询，周一至周五，9:00 - 18:00</span>
                </div>
                <div class="btn">
                  在线咨询
                </div>
              </div>
              <div class="right-box">
                @foreach($data['contact_branch'] as $key=>$val)
                    <div class="inner">
                    <img src="/front/images/common/location.png" alt="">
                    <span class="company">{!!$val['company_name']!!}：</span>
                    <span class="pos">{!!$val['company_address']!!}</span>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-else-if="navSelected == 'join'" class="join-wrapper">
        {!!$data['join']['content']!!}
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
</body>
</html>