window.onload = function () {
  var app = {
    data() {
      return {
        isShareShow: false,
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
      // 初始化分享按钮
      socialShare('#share', {
        sites: ['weibo', 'qq', 'wechat', 'qzone', 'douban'],
        // disabled: ['google', 'facebook', 'twitter'], // 禁用的站点
        // url: '', // 网址，默认使用 window.location.href
        // source: '', // 来源（QQ空间会用到）, 默认读取head标签：<meta name="site" content="http://overtrue" />
        // title: '', // 标题，默认读取 document.title 或者 <meta name="title" content="share.js" />
        // description: '', // 描述, 默认读取head标签：<meta name="description" content="PHP弱类型的实现原理分析" />
        // image: '', // 图片, 默认取网页中第一个img标签
        // wechatQrcodeTitle   : "微信扫一扫：分享", // 微信二维码提示文字
        // wechatQrcodeHelper  : '<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈。</p>',
      });
    },

    methods: {},
  }
  
  Vue.createApp(app).mount('#investment-strategy-case-detail-page');
};
