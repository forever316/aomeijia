window.onload = function () {
  var app = {
    data() {
      return {
        country: ['美国', '马来西亚', '柬埔寨', '泰国', '迪拜', '菲律宾', '日本', '黑山', '英国'],
        countrySelected: [],
        reasons: ['子女教育', '海外生育', '养老储备', '出行便利', '海外置业', '躲避雷劈', '投资理财', '旅游度假', '税务筹划', '其他'],
        reasonSelected: [],
        property: ['50万以内', '50-100万', '100-200万', '200-300万', '300-400万', '400-500万', '500万以上'],
        propertySelected: '',
        education: ['高中以下', '高中或中专', '大专', '本科或硕士', '博士', '其他'],
        educationSelected: '',
        expect: ['护照', '永久居民', '临时居民', '长期签证', '短期签证', '其他'],
        expectSelected: '',
        language: ['雅思3分', '雅思4分', '雅思5分', '雅思5.5分', '雅思6分', '雅思7分', '其他'],
        languageSelected: '',

        name: '',
        sex: 'male',
        phone: '',
        email: '',
      }
    },

    mounted () {},

    methods: {

      selectCountry (item) {
        var index = this.countrySelected.indexOf(item);
        if (index > -1) {
          this.countrySelected.splice(index, 1);
        }
        else {
          if (this.countrySelected.length < 3) {
            this.countrySelected.push(item);
          }
        }
      },

      selectReason (item) {
        var index = this.reasonSelected.indexOf(item);
        if (index > -1) {
          this.reasonSelected.splice(index, 1);
        }
        else {
          if (this.reasonSelected.length < 3) {
            this.reasonSelected.push(item);
          }
        }
      },

      // 提交
      submitData () {
        console.log('国家：', this.countrySelected.join('、'));
        console.log('为什么移民：', this.reasonSelected.join('、'));
        console.log('家庭资产：', this.propertySelected);
        console.log('学历：', this.educationSelected);
        console.log('海外身份：', this.expectSelected);
        console.log('英语能力：', this.languageSelected);
        console.log('姓名：', this.name);
        console.log('性别：', this.sex);
        console.log('电话：', this.phone);
        console.log('邮箱：', this.email);
      },

    },
  }
  
  Vue.createApp(app).mount('#immigrant-appointment-page');
};
