window.onload = function () {
  var app = {
    data() {
      return {
        keywords: '',
        hots: ['云顶1号', '金边', '购房移民'],

        filters: {
          areas: { name: '地区', select: '不限', opts: ['亚洲', '欧洲', '大洋洲', '北美洲'] },
          countrys: { name: '国家', select: '不限', opts: ['马来西亚', '柬埔寨', '泰国', '迪拜', '菲律宾', '日本'] },
          citys: { name: '城市', select: '不限', opts: ['吉隆坡', '新山'] },
          types: { name: '类型', select: '不限', opts: ['公寓', '别墅', '写字楼', '商铺'] },
          prices: { name: '价格', select: '不限', opts: ['50万以下', '50-100万', '100-150万', '150万-200万', '200万-250万', '250-300万', '300-500万', '500-700万', '700-1000万', '1000万以上'] },
          others: { name: '特色', select: '不限', opts: ['学区房', '投资房', '海景房', '河景房', '湖景房', '购房移民', '包租'] },
        },

        lists: [],

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
           
        var self = this;
        this.$nextTick(function () {
            // 成功案例轮播
            this.caseSwiper = new Swiper('.case-box', {
              slidesPerView: 3,
              spaceBetween: 22.5,
              autoplay: true,
              loop: true,
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

      nextCase () {
        this.caseSwiper.slideNext();
      },

      prevCase () {
        this.caseSwiper.slidePrev();
      },

    },
  }
  
  Vue.createApp(app).mount('#overseas-property-page');

  //右边悬浮框的js
  right_js();
};
