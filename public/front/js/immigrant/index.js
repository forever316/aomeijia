window.onload = function () {
  var app = {
    data() {
      return {
        filters: {
          areas: { name: '地区', select: '不限', opts: ['亚洲', '欧洲', '北美洲', '南美洲', '大洋洲'] },
          countrys: { name: '国家', select: '不限', opts: ['希腊', '加拿大', '爱尔兰', '葡萄牙', '土耳其'] },
          types: { name: '类型', select: '不限', opts: ['投资创业移民', '购房移民', '护照移民', '技术移民', '各类签证', '家庭团聚移民', '优才移民', '其他'] },
          prices: { name: '投资', select: '不限', opts: ['50万以下', '50-100万', '100-200万', '200-300万', '300-500万', '500万以上'] },
        },

        lists: [],
        isAppointmentShow: false,
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

      // 筛选
      selectFilter (item, el) {
        item.select = el;
      },

    },
  }
  
  Vue.createApp(app).mount('#immigrant-page');

  //右边悬浮框的js
  right_js();

};
