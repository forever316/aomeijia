<?php

return [

    'enable_mock' => env('WECHAT_ENABLE_MOCK', true),
     'mock_user' => [
          "openid" =>"owgxkwOTTX-L0cXhI1P8gkgaMWaw",
          // 以下字段为 scope 为 snsapi_userinfo 时需要
          "nickname" => "overtrue",
          "sex" =>"1",
          "language" =>"zh_CN",
          "province" =>"北京",
          "city" =>"北京",
          "country" =>"中国",
          "headimgurl" => "http://wx.qlogo.cn/mmopen/C2rEUskXQiblFYMUl9O0G05Q6pKibg7V1WpHX6CIQaic824apriabJw4r6EWxziaSt5BATrlbx1GVzwW2qjUCqtYpDvIJLjKgP1ug/0",
     ],


];
