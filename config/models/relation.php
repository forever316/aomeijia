<?php

return [
    'RelationsList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'user_name' => ['text'=>'用户名'],
            'recommend_amount' => ['text'=>'推荐人数'],
            'bonus_integral' => ['text'=>'总奖励宝分'],
            'integral' => ['text'=>'总宝分'],
        ],
        'search' => [
            'user_name' => ['text'=>'用户名','type'=>'input'],
        ],
        'button' => [
//            'see' => '/user/seeUser',

        ],
        'data_url'=>'/RelationsList'
    ],
//    'addUser' => [
//        'field' => [
//            'name' => ['text'=>'用户名','type'=>'input','value'=>'','desc'=>'用户名为5-15位字符，不可包含符号','verify'=>['required']],
//            'email' => ['text'=>'邮箱','type'=>'input','value'=>'','verify'=>['required','email']],
//            'password' => ['text'=>'密码','type'=>'password','value'=>'','desc'=>'密码为6-15位字符','verify'=>['required']],
//            'password2' => ['text'=>'确认密码','type'=>'password','value'=>'','desc'=>'请再次填写密码','verify'=>['required']],
//            'dept_id' => ['text'=>'所属部门','type'=>'custom','value'=>'admin.user.departement_ztree','verify'=>['required']],
//            'role_ids' => ['text'=>'私有角色','type'=>'checkbox','value'=>[],'desc'=>'除了部门所拥有的角色外的私有角色'],
//        ],
//        'sub_url'=>'/user/addUser',
//    ],
//    'updateUser' => [
//        'field' => [
//            'dept_id' => ['text'=>'所属部门','type'=>'custom','value'=>'admin.user.departement_ztree','verify'=>['required']],
//            'role_ids' => ['text'=>'私有角色','type'=>'checkbox','value'=>[],'desc'=>'除了部门所拥有的角色外的私有角色'],
//            'password' => ['text'=>'密码','type'=>'password','value'=>'','desc'=>'密码为6-15位字符','verify'=>['required']],
//            'password2' => ['text'=>'确认密码','type'=>'password','value'=>'','desc'=>'请再次填写密码','verify'=>['required']],
//        ],
//        'sub_url' => '/user/updateUser'
//    ],
//    'seeUser' => [
//        'field' => [
//            'id' => ['text'=>'ID','type'=>'span'],
//            'name' => ['text'=>'账户名','type'=>'span'],
//            'email' => ['text'=>'邮箱','type' => 'span'],
//            'dept' => ['text'=>'部门','type'=>'span'],
//            'role' => ['text'=>'私有角色','type'=>'span'],
//        ],
//    ],
];
?>