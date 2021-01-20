<?php
return [
    'masterList' => [
        'field' => [
            'id' => ['text'=>'师傅编号'],
            'nickname' => ['text'=>'师傅名称'],
            'phone' => ['text'=>'师傅手机号码'],
            'distributor_id' => ['text'=>'经销商'],
            'work_type_id' => ['text'=>'工种'],
            'created_at' => ['text'=>'注册时间'],
        ],
        'search' => [
            'id' => ['text'=>'用户编号','type'=>'input'],
            'phone' => ['text'=>'师傅手机号码','type'=>'input'],
            'nickname' => ['text'=>'用户昵称','type'=>'input'],
            'distributor_id' => ['text'=>'经销商编号','type'=>'input'],
        ],
        'button' => [
            'add' => '/member/masterAdd',
            'update' => '/member/masterUpdate',
            'see' => '/member/masterDetail',
            'delete' => '/member/masterDelete',
            'customButton'=>[
                [
                    'url'=>'/member/memberReceiptList',
                    'path' => 'admin.member.memberReceiptListBtn'
                ],
            ]
        ],
        'data_url' => '/member/masterList'
    ],
    'masterAdd' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'master'],
            'recommend_id' => ['text'=>'推荐人','type'=>'input'],
            'nickname' => ['text'=>'师傅名称','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'work_type_id' => ['text'=>'工种类型','type'=>'select','value'=>[]],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'custom2' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'custom' => ['text'=>'经销商','type'=>'custom','value'=>'admin.member.distributor'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
        ],
        'sub_url'=>'/member/masterAdd',
    ],
    'masterUpdate' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'master'],
            'recommend_id' => ['text'=>'推荐人','type'=>'input'],
            'nickname' => ['text'=>'师傅名称','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'work_type_id' => ['text'=>'工种类型','type'=>'select','value'=>[]],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'custom2' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'custom' => ['text'=>'经销商','type'=>'custom','value'=>'admin.member.distributor'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
        ],
        'sub_url'=>'/member/masterUpdate',
    ],
    'masterDetail' => [
        'field' => [
            'id' => ['text'=>'编号','type'=>'span'],
            'head_portrait' => ['text'=>'头像','type'=>'img'],
            'nickname' => ['text'=>'名称','type'=>'span'],
            'phone' => ['text'=>'手机号码','type'=>'span'],
            'sex' => ['text'=>'性别','type'=>'select','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'span'],
            'distributor' => ['text'=>'经销商','type'=>'span'],
            'distributor_id' => ['text'=>'经销商编号','type'=>'span'],
            'recommend' => ['text'=>'推荐人','type'=>'span'],
            'recommend_id' => ['text'=>'推荐人编号','type'=>'span'],
            'balance' => ['text'=>'余额','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];