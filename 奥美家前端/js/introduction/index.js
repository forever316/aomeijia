window.onload = function () {
  var app = {
    data() {
      return {
        isNavFixed: false,
        navSelected: 'introduce',
      }
    },

    mounted () {
      this.handleScroll();
    },

    watch: {
      navSelected () {
        var self = this;
        this.$nextTick(function () {
          window.scrollTo(0, self.$refs.content.offsetTop - self.$refs.nav.offsetHeight);
        });
      },
    },

    methods: {

      handleScroll () {
        var self = this;
        window.onscroll = function () {
          var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
          var t = self.$refs.banner.offsetHeight;
          self.isNavFixed = scrollTop > t && scrollTop < t + self.$refs.content.offsetHeight;
        };
      },

    },
  }
  
  Vue.createApp(app).mount('#introduction-index-page');
};
