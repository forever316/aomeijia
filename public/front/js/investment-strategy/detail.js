window.onload = function () {
  var app = {
    data() {
      return {
        caseSwiper: null,
      }
    },

    mounted () {
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
