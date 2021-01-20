<?php
return [
    'distributorList' => [
        'field' => [
            'id' => ['text'=>'用户编号'],
            'nickname' => ['text'=>'用户昵称'],
            'phone' => ['text'=>'用户手机号码'],
            'work_type_id' => ['text'=>'用户类型'],
//            'created_at' => ['text'=>'注册时间'],
        ],
        'search' => [
            'type' => ['text'=>'用户类型','type'=>'select','value'=>['0'=>'请选择','1'=>'普通用户','2'=>'代理商','3'=>'渠道商','4'=>'商家'],'verify'=>['required']],
            'id' => ['text'=>'用户编号','type'=>'input'],
            'phone' => ['text'=>'用户手机号码','type'=>'input'],
            'nickname' => ['text'=>'用户昵称','type'=>'input'],
        ],
        'button' => [
            'update' => '/member/distributorUpdate',
            'see' => '/member/distributorDetail',
            'delete' => '/member/distributorDelete',
        ],
        'data_url' => '/member/distributorList'
    ],
    'userUpdate' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'user'],
            'recommend_id' => ['text'=>'推荐人','type'=>'input'],
            'nickname' => ['text'=>'用户名称','type'=>'input'],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
        ],
        'sub_url'=>'/member/userUpdate',
    ],
    'userDetail' => [
        'field' => [
            'id' => ['text'=>'编号','type'=>'span'],
            'head_portrait' => ['text'=>'头像','type'=>'img'],
            'nickname' => ['text'=>'名称','type'=>'span'],
            'phone' => ['text'=>'手机号码','type'=>'span'],
            'sex' => ['text'=>'性别','type'=>'select','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'span'],
            'recommend' => ['text'=>'推荐人','type'=>'span'],
            'recommend_id' => ['text'=>'推荐人编号','type'=>'span'],

            'channel_num'=>['text'=>'渠道商编号','type'=>'span'],
            'agent_num'=>['text'=>'代理商编号','type'=>'span'],

            'balance' => ['text'=>'余额','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],

];