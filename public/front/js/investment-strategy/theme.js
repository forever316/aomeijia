window.onload = function () {
  var app = {
    data() {
      return {
        keywords: '',
        hots: ['云顶1号', '金边', '购房移民'],
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
    },

    methods: {

      // 搜索
      search () {
        console.log('搜索关键字:', this.keywords);
        var words = $('.keywords').val();
        url = '/invest/theme?words='+words;
        window.location.href = url;
        // ...
      },

      // 热门搜索
      chooseHot (item) {
        this.keywords = item;
        this.search();
      },

    },
  }
  
  Vue.createApp(app).mount('#investment-strategy-theme-page');
};
