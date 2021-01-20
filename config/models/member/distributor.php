<?php
return [
    'distributorList' => [
        'field' => [
            'id' => ['text'=>'经销商编号'],
            'nickname' => ['text'=>'经销商姓名'],
            'phone' => ['text'=>'手机号码'],
        ],
        'search' => [
            'id' => ['text'=>'经销商编号','type'=>'input'],
            'nickname' => ['text'=>'经销商姓名','type'=>'input'],
            'phone' => ['text'=>'经销商手机号码','type'=>'input'],
        ],
        'button' => [
            'add' => '/member/distributorAdd',
            'update' => '/member/distributorUpdate',
            'see' => '/member/distributorDetail',
            'delete' => '/member/distributorDelete',
            'customButton'=>[
                [
                    'url'=>'/member/memberReceiptList',
                    'path' => 'admin.member.memberReceiptListBtn'
                ],
            ]
        ],
        'data_url' => '/member/distributorList'
    ],
    'distributorAdd' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'distributor'],
            'recommend_id' => ['text'=>'推荐人电话','type'=>'input'],
            'level_id' => ['text'=>'经销商等级','type'=>'select','value'=>[]],
            'nickname' => ['text'=>'姓名','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'legal_person' => ['text'=>'法人代表','type'=>'input'],
            //'discount' => ['text'=>'享受折扣','type'=>'input','desc'=>'最低0，最高1，不填为0 (0和1为不打折)'],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'address' => ['text'=>'地址','type'=>'input'],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
        ],
        'sub_url'=>'/member/distributorAdd',
    ],
    'distributorUpdate' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'distributor'],
            'recommend_id' => ['text'=>'推荐人电话','type'=>'input'],
            'level_id' => ['text'=>'经销商等级','type'=>'select','value'=>[]],
            'nickname' => ['text'=>'姓名','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'legal_person' => ['text'=>'法人代表','type'=>'input'],
            //'discount' => ['text'=>'享受折扣','type'=>'input','desc'=>'最低0，最高1，不填为0 (0和1为不打折)'],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'address' => ['text'=>'地址','type'=>'input'],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
        ],
        'sub_url'=>'/member/distributorUpdate',
    ],
    'distributorDetail' => [
        'field' => [
            'id' => ['text'=>'编号','type'=>'span'],
            'head_portrait' => ['text'=>'头像','type'=>'img'],
            'nickname' => ['text'=>'姓名','type'=>'span'],
            'sex' => ['text'=>'性别','type'=>'select','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'span'],
            'phone' => ['text'=>'手机号码','type'=>'span'],
            'recommend' => ['text'=>'推荐人','type'=>'span'],
            'recommend_id' => ['text'=>'推荐人编号','type'=>'span'],
            'legal_person' => ['text'=>'法人代表','type'=>'span'],
            //'discount' => ['text'=>'享受折扣','type'=>'span'],
            'city' => ['text'=>'地区','type'=>'span'],
            'address' => ['text'=>'地址','type'=>'span'],
            'balance' => ['text'=>'余额','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'录入时间','type'=>'span'],
        ],
    ],
];