window.onload = function () {
  var app = {
    data() {
      return {
        gallerySwiper: null,
        caseSwiper: null,
        catalogueStyle: '',
        catalogueSelected: 'basic',
        isCodeShow: false,
        isAppointmentShow: false,
        isShareShow: false,
      }
    },

    mounted () {
      // 初始化分享按钮
      socialShare('#share', {
        sites: ['weibo', 'qq', 'wechat', 'qzone', 'douban'],
        // disabled: ['google', 'facebook', 'twitter'], // 禁用的站点
        // url: '', // 网址，默认使用 window.location.href
        // source: '', // 来源（QQ空间会用到）, 默认读取head标签：<meta name="site" content="http://overtrue" />
        // title: '', // 标题，默认读取 document.title 或者 <meta name="title" content="share.js" />
        // description: '', // 描述, 默认读取head标签：<meta name="description" content="PHP弱类型的实现原理分析" />
        // image: '', // 图片, 默认取网页中第一个img标签
        // wechatQrcodeTitle   : "微信扫一扫：分享", // 微信二维码提示文字
        // wechatQrcodeHelper  : '<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈。</p>',
      });
      
      var self = this;
      this.$nextTick(function () {
        // 轮播
        var galleryThumbs = new Swiper('.gallery-thumbs', {
          spaceBetween: 10,
          slidesPerView: 5,
          loopedSlides: 5,
        });

        var galleryTop = new Swiper('.gallery-top', {
          autoplay: {
            disableOnInteraction: false,
          },
          loop: true,
          loopedSlides: 5,
          // navigation: {
          //   nextEl: '.gallery-button-next',
          //   prevEl: '.gallery-button-prev',
          // },
          thumbs: {
            swiper: galleryThumbs,
          },
        });
        self.gallerySwiper = galleryTop;
  
        // 初始化地图
        var map = new AMap.Map('map', {
          resizeEnable: true,
          center: [101.687, 3.13829],
          lang: "zh_en",
          zoom: 9,
        });
  
        // 成功案例轮播
        self.caseSwiper = new Swiper('.case-box', {
          slidesPerView: 3,
          spaceBetween: 22.5,
          autoplay: true,
          loop: true,
        });

      });

      // 滚动事件
      this.handleScroll();
    },

    methods: {

      slideNext () {
        this.gallerySwiper.slideNext();
      },

      slidePrev () {
        this.gallerySwiper.slidePrev();
      },

      slideToggle (e) {
        var index = [].indexOf.call(e.target.parentElement.children, e.target);
        this.gallerySwiper.slideTo(index);
      },

      nextCase () {
        this.caseSwiper.slideNext();
      },

      prevCase () {
        this.caseSwiper.slidePrev();
      },

      handleScroll () {
        var self = this;
        window.onscroll = function () {
          var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
          var detailTop = self.$refs.detailWrapper.offsetTop;
          if (scrollTop > detailTop + self.$refs.detailWrapper.offsetHeight - self.$refs.catalogueWrapper.offsetHeight - 20) {
            self.catalogueStyle = 'bottom';
          }
          else if (scrollTop > detailTop) {
            self.catalogueStyle = 'fixed';
          }
          else {
            self.catalogueStyle = '';
          }

          var diff = scrollTop - detailTop;
          if (diff >= 0 && diff <= self.$refs.basic.offsetHeight) {
            self.catalogueSelected = 'basic';
          }
          else if (diff > self.$refs.type.offsetTop && diff <= self.$refs.type.offsetTop + self.$refs.type.offsetHeight) {
            self.catalogueSelected = 'type';
          }
          else if (diff > self.$refs.location.offsetTop && diff <= self.$refs.location.offsetTop + self.$refs.location.offsetHeight) {
            self.catalogueSelected = 'location';
          }
          else if (diff > self.$refs.conf.offsetTop && diff <= self.$refs.conf.offsetTop + self.$refs.conf.offsetHeight) {
            self.catalogueSelected = 'conf';
          }
          else if (diff > self.$refs.feature.offsetTop && diff <= self.$refs.feature.offsetTop + self.$refs.feature.offsetHeight) {
            self.catalogueSelected = 'feature';
          }
          else if (diff > self.$refs.pic.offsetTop && diff <= self.$refs.pic.offsetTop + self.$refs.pic.offsetHeight) {
            self.catalogueSelected = 'pic';
          }
          else if (diff > self.$refs.analyse.offsetTop && diff <= self.$refs.analyse.offsetTop + self.$refs.analyse.offsetHeight) {
            self.catalogueSelected = 'analyse';
          }
          else if (diff > self.$refs.news.offsetTop && diff <= self.$refs.news.offsetTop + self.$refs.news.offsetHeight) {
            self.catalogueSelected = 'news';
          }
        }
      },

    },
  }
  
  Vue.createApp(app).mount('#overseas-property-detail-page');
};
