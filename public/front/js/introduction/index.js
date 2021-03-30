window.onload = function () {
  var app = {
    data() {
      return {
        isNavFixed: false,
        navSelected: 'introduce',
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

      this.handleScroll();
      if (window.location.search) {
        var key = '';
        window.location.search.replace(/key=(.*)/, (a, b) => {
          key = b;
        });
        this.navSelected = key;
      }
    },

    methods: {

      handleScroll () {
        var self = this;
        window.onscroll = function () {
          var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
          var t = document.querySelector('.header-wrapper').offsetHeight + self.$refs.banner.offsetHeight;
          self.isNavFixed = scrollTop > t && scrollTop < t + self.$refs.content.offsetHeight;
        };
      },

      selectNav (key) {
        window.location.replace('?key=' + key);
        var self = this;
        this.$nextTick(function () {
          window.scrollTo(0, self.$refs.content.offsetTop - self.$refs.nav.offsetHeight);
        });
      },

    },
  }

  Vue.createApp(app).mount('#introduction-index-page');
};
