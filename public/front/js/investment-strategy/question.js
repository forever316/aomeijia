window.onload = function () {
  var app = {
    data() {
      return {
        filters: {
          areas: { name: '地区', select: '不限', opts: ['亚洲', '欧洲', '北美洲', '南美洲', '大洋洲'] },
          countrys: { name: '国家', select: '不限', opts: ['希腊', '加拿大', '爱尔兰', '葡萄牙', '土耳其'] },
        },
      }
    },

    mounted () {},

    methods: {

      // 筛选
      selectFilter (item, el) {
        item.select = el;
      },

    },
  }
  
  Vue.createApp(app).mount('#investment-strategy-question-page');
};
