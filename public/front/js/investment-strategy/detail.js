window.onload = function () {
  var app = {
    data() {
      return {
        caseSwiper: null,
      }
    },

    mounted () {
      // 导航菜单的二级菜单
      $(".nav-list").mouseenter(function () {
        var el = $(this).find(".sub-nav");
        if (el) {
          el.stop().animate({ height : "show" }, 300);
        }
      });
      $(".nav-list").mouseleave(function() {
        var el = $(this).find(".sub-nav");
        if (el) {
          el.stop().animate({ height : "hide" }, 300);
        }
      });
      // 成功案例轮播
      this.caseSwiper = new Swiper('.case-box', {
        slidesPerView: 3,
        spaceBetween: 22.5,
        autoplay: true,
        loop: true,
      });
    },

    methods: {

      nextCase () {
        this.caseSwiper.slideNext();
      },

      prevCase () {
        this.caseSwiper.slidePrev();
      },

    },
  }
  
  Vue.createApp(app).mount('#investment-strategy-detail-page');
};
