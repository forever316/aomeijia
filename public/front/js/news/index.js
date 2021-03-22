window.onload = function () {
  var app = {
    data() {
      return {
        keywords: '',
        hots: ['房贷', '租金', '加拿大魁省'],

        filters: {
          areas: { name: '地区', select: '不限', opts: ['亚洲', '欧洲', '大洋洲', '北美洲'] },
          countrys: { name: '国家', select: '不限', opts: ['马来西亚', '柬埔寨', '泰国', '迪拜', '菲律宾', '日本'] },
          types: { name: '类型', select: '不限', opts: ['房产', '移民', '教育', '政策', '金融', '社会', '娱乐', '其他'] },
        },

        swiper: null,
      }
    },

    mounted () {
      var self = this;
      this.$nextTick(function () {
        self.swiper = new Swiper('.news-swiper', {
          autoplay: {
            delay: 5000,
          },
          loop: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
              return '<span class="' + className + '">' + (index + 1) + '</span>';
            },
          },
        });
      });
    },

    methods: {

      // 搜索
      search () {
        var words = $('.keywords').val();
        var url = $('.search_words').attr('data-url');
        url = url+'&words='+words;
        window.location.href = url;
        // console.log('搜索关键字:', this.keywords);
        // ...
      },

      // 热门搜索
      chooseHot (item) {
        this.keywords = item;
        this.search();
      },

      // 筛选
      selectFilter (item, el) {
        item.select = el;
      },

    },
  }
  
  Vue.createApp(app).mount('#news-index-page');
};
