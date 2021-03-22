window.onload = function () {
  var app = {
    data() {
      return {
        caseSwiper: null,
        isCodeShow: false,
        isAppointmentShow: false,
        isNavFixed: false,
        navSelected: 'introduce',
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

      // 成功案例轮播
      this.caseSwiper = new Swiper('.case-box', {
        slidesPerView: 3,
        spaceBetween: 22.5,
        autoplay: true,
        loop: true,
      });

      this.handleScroll();
    },

    methods: {

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
          var t = self.$refs.banner.offsetHeight + self.$refs.basic.offsetHeight;
          self.isNavFixed = scrollTop > t && scrollTop < t + self.$refs.content.offsetHeight;

          self.$nextTick(function () {
            var contentTop = self.$refs.content.offsetTop;
            var diff = scrollTop - contentTop + 2;
            if (diff >= 0 && diff <= self.$refs.introduce.offsetHeight) {
              self.navSelected = 'introduce';
            }
            else if (diff > self.$refs.advantage.offsetTop && diff <= self.$refs.advantage.offsetTop + self.$refs.advantage.offsetHeight) {
              self.navSelected = 'advantage';
            }
            else if (diff > self.$refs.conditions.offsetTop && diff <= self.$refs.conditions.offsetTop + self.$refs.conditions.offsetHeight) {
              self.navSelected = 'conditions';
            }
            else if (diff > self.$refs.steps.offsetTop && diff <= self.$refs.steps.offsetTop + self.$refs.steps.offsetHeight) {
              self.navSelected = 'steps';
            }
            else if (diff > self.$refs.house.offsetTop && diff <= self.$refs.house.offsetTop + self.$refs.house.offsetHeight) {
              self.navSelected = 'house';
            }
          });
        };
      },

      toNav (target) {
        this.isNavFixed = true;
        this.$nextTick(function () {
          window.location.href = target;
        });
      },

    },
  }
  
  Vue.createApp(app).mount('#immigrant-detail-page');
};
