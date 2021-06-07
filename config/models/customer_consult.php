<?php

return [
    'customerConsultList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'客户咨询类型','options'=>['1'=>'预约看房','2'=>'预约移民',4=>'预约展会',5=>'客户咨询问答',6=>'客户咨询成功案例',7=>'客户咨询主题',8=>'右侧悬浮框留言',9=>'预约活动',10=>'预约考察']],
            'name' => ['text'=>'客户名字'],
            'phone' => ['text'=>'电话号码'],
            'email' => ['text'=>'邮箱'],
            'wechat' => ['text'=>'微信号'],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'客户名字','type'=>'input'],
            'type' => ['text'=>'客户咨询类型','type'=>'select','value'=>[''=>'--请选择--','1'=>'预约看房','2'=>'预约移民',4=>'预约展会',5=>'客户咨询问答',6=>'客户咨询成功案例',7=>'客户咨询主题',8=>'右侧悬浮框留言',9=>'预约活动',10=>'预约考察']],
        ],
        'button' => [
            'see' => '/customerConsult/seeCustomerConsult',
        ],
        'data_url' => '/customerConsult/customerConsultList',
    ],
    'seeCustomerConsult' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'客户咨询类型','type'=>'select','value'=>['1'=>'预约看房','2'=>'预约移民',4=>'预约展会',5=>'客户咨询问答',6=>'客户咨询成功案例',7=>'客户咨询主题',8=>'右侧悬浮框留言',9=>'预约活动',10=>'预约考察']],
            'name' => ['text'=>'客户名字','type'=>'span'],
            'phone'=>['text'=>'电话号码','type'=>'span'],
            'email' => ['text'=>'邮箱','type'=>'span'],
            'wechat' => ['text'=>'微信号','type'=>'span'],
            'content' => ['text'=>'咨询内容','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>