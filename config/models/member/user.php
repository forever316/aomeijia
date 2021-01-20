<?php
return [
    'userList' => [
        'field' => [
            'id' => ['text'=>'用户编号'],
            'nickname' => ['text'=>'用户昵称'],
            'phone' => ['text'=>'用户手机号码'],
            'channel_status' => ['text'=>'是否为渠道商'],
            'channel_num' => ['text'=>'渠道商编号'],
            'agent_status' => ['text'=>'是否为代理商'],
            'agent_num' => ['text'=>'代理商编号'],
            'business_status' => ['text'=>'是否为商家'],
        ],
        'search' => [
            'type' => ['text'=>'用户类型','type'=>'select','value'=>['0'=>'请选择','1'=>'普通用户','2'=>'代理商','3'=>'渠道商','4'=>'商家'],'verify'=>['required']],
            'id' => ['text'=>'用户编号','type'=>'input'],
            'phone' => ['text'=>'用户手机号码','type'=>'input'],
            'nickname' => ['text'=>'用户昵称','type'=>'input'],
            'number' => ['text'=>'渠道商(代理商)编号','type'=>'input'],
        ],
        'button' => [
            'add' => '/member/userAdd',
            'update' => '/member/userUpdate',
            'see' => '/member/userDetail',
            'delete' => '/member/userDelete',
            'customButton'=>[
                [
                    'url'=>'/member/memberReceiptList',
                    'path' => 'admin.member.memberReceiptListBtn'
                ],
//                [
//                    'url'=>'/member/changeUserDistributor',
//                    'path' => 'admin.member.distributorBtn'
//                ],
//                [
//                    'url'=>'/member/changeUserMaster',
//                    'path' => 'admin.member.masterBtn'
//                ],
                [
                    //修改为渠道商
                    'url'=>'/member/channelUpdate',
                    'path' => 'admin.member.channelUpdate'
                ],
                [
                    //修改为代理商
                    'url'=>'/member/agentUpdate',
                    'path' => 'admin.member.agentUpdate'
                ]
            ]
        ],
        'data_url' => '/member/userList'
    ],
    'userAdd' => [
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
        'sub_url'=>'/member/userAdd',
    ],
    'userUpdate' => [
        'field' => [
            'head_portrait'=> ['text'=>'头像','type'=>'img','limit'=>1,'folder'=>'user'],
            'recommend_id' => ['text'=>'推荐人','type'=>'span'],
            'nickname' => ['text'=>'用户名称','type'=>'input'],
            'phone' => ['text'=>'手机号码','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'radio','value'=>[1=>'男',2=>'女']],
            'birthday' => ['text'=>'出生日期','type'=>'date'],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'password' => ['text'=>'密码','type'=>'password'],
            'password2' => ['text'=>'确认密码','type'=>'password'],
            'cash_password' => ['text'=>'兑换密码','type'=>'password'],
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

            'channel_num'=>['text'=>'渠道商编号','type'=>'span'],
            'agent_num'=>['text'=>'代理商编号','type'=>'span'],

            'balance' => ['text'=>'余额','type'=>'span'],
            'integral' => ['text'=>'宝分','type'=>'span'],
            'treasure_num' => ['text'=>'当前包袋个数','type'=>'span'],
            'bestir_integral' => ['text'=>'已激励宝分','type'=>'span'],
            'un_bestir_integral' => ['text'=>'未激励宝分','type'=>'span'],
            'cash_integral' => ['text'=>'可兑现宝分','type'=>'span'],
            'un_cash_integral' => ['text'=>'不可兑现宝分','type'=>'span'],
            'idcard' => ['text'=>'身份证号','type'=>'span'],
            'idcard_pho' => ['text'=>'身份证照','type'=>'imgs'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'注册时间','type'=>'span'],
        ],
    ],
    'memberReceiptList'=>[
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'收货人姓名'],
            'phone' => ['text'=>'联系人号码'],
            'province' => ['text'=>'收货省份'],
            'city' => ['text'=>'收货城市'],
            'address' => ['text'=>'详细地址'],
            'is_default' => ['text'=>'是否默认','options'=>[1=>'是',2=>'否']],
        ],
        'button' => [
            'add' => '/member/memberReceiptAdd',
            'update' => '/member/upMemberReceipt',
            'delete' => '/member/memberReceiptDelete'
        ],
        'data_url' => '/member/memberReceiptList'
    ],
    'memberReceiptAdd'=>[
        'field' => [
            'name' => ['text'=>'收货姓名','type'=>'input','verify'=>['required']],
            'phone' => ['text'=>'收货手机号码','type'=>'input','verify'=>['required','phone']],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'address' => ['text'=>'详细地址','type'=>'input','verify'=>['required']],
            'is_default' => ['text'=>'是否默认','type'=>'select','value'=>[2=>'否',1=>'是'],'verify'=>['required']],
        ],
        'sub_url' => '/member/memberReceiptAdd'
    ],
    'upMemberReceipt'=>[
        'field' => [
            'name' => ['text'=>'收货姓名','type'=>'input','verify'=>['required']],
            'phone' => ['text'=>'收货手机号码','type'=>'input','verify'=>['required','phone']],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'address' => ['text'=>'详细地址','type'=>'input','verify'=>['required']],
            'is_default' => ['text'=>'是否默认','type'=>'select','value'=>[2=>'否',1=>'是'],'verify'=>['required']],
        ],
        'sub_url' => '/member/upMemberReceipt'
    ],
    'changeUserMaster' => [
        'field' => [
            'nickname' => ['text'=>'师傅名称','type'=>'input'],
            'work_type_id' => ['text'=>'工种类型','type'=>'select','value'=>[]],
            'custom2' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'custom' => ['text'=>'经销商','type'=>'custom','value'=>'admin.member.distributor'],
        ],
        'sub_url'=>'/member/changeUserMaster',
    ],
    'changeUserDistributor' => [
        'field' => [
            'level_id' => ['text'=>'经销商等级','type'=>'select','value'=>[]],
            'nickname' => ['text'=>'名称','type'=>'input'],
            'legal_person' => ['text'=>'法人代表','type'=>'input'],
            //'discount' => ['text'=>'享受折扣','type'=>'input','desc'=>'最低0，最高1，不填为0 (0和1为不打折)'],
            'custom' => ['text'=>'地区','type'=>'custom','value'=>'admin.member.city'],
            'address' => ['text'=>'地址','type'=>'input'],
        ],
        'sub_url'=>'/member/changeUserDistributor',
    ],

//    //渠道商
    'channelUpdate' => [
        'field' => [
            'nickname' => ['text'=>'用户名称','type'=>'span'],
            'channel_status' => ['text'=>'是否升级为渠道商','type'=>'radio','value'=>['0'=>'否','1'=>'是']],
        ],
        'sub_url'=>'/member/channelUpdate',
    ],

    'agentUpdate' => [
        'field' => [
            'nickname' => ['text'=>'用户名称','type'=>'span'],
            'agent_status' => ['text'=>'是否升级为代理商','type'=>'radio','value'=>['0'=>'否','1'=>'是']],
        ],
        'sub_url'=>'/member/agentUpdate',
    ],

];