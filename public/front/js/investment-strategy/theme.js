window.onload = function () {
  var app = {
    data() {
      return {
        keywords: '',
        hots: ['云顶1号', '金边', '购房移民'],
      }
    },

    mounted () {},

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
