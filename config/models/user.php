<?php

return [
    'userList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'用户名'],
            'dept_id' => ['text'=>'所属部门'],
            'email' => ['text'=>'邮箱'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'用户名','type'=>'input'],
        ],
        'button' => [
            'add' => '/user/addUser',
            'update' => '/user/updateUser',
            'see' => '/user/seeUser',
            'delete' => '/user/deleteUser',
            'customButton'=>[
                [
                    'url'=>'/user/resetPass',
                    'path' => 'admin.user.resetPasswordBtn'
                ]
            ]
        ],
        'data_url'=>'/user/userList'
    ],
    'addUser' => [
        'field' => [
            'name' => ['text'=>'用户名','type'=>'input','value'=>'','desc'=>'用户名为5-15位字符，不可包含符号','verify'=>['required']],
            'email' => ['text'=>'邮箱','type'=>'input','value'=>'','verify'=>['required','email']],
            'dept_id' => ['text'=>'所属部门','type'=>'custom','value'=>'admin.user.departement_ztree','verify'=>['required']],
            'role_ids' => ['text'=>'私有角色','type'=>'checkbox','value'=>[],'desc'=>'除了部门所拥有的角色外的私有角色'],
        ],
        'sub_url'=>'/user/addUser',
    ],
    'updateUser' => [
        'field' => [
            'dept_id' => ['text'=>'所属部门','type'=>'custom','value'=>'admin.user.departement_ztree','verify'=>['required']],
            'role_ids' => ['text'=>'私有角色','type'=>'checkbox','value'=>[],'desc'=>'除了部门所拥有的角色外的私有角色'],
            'password' => ['text'=>'密码','type'=>'password','value'=>'','desc'=>'密码为6-15位字符','verify'=>['required']],
            'password2' => ['text'=>'确认密码','type'=>'password','value'=>'','desc'=>'请再次填写密码','verify'=>['required']],
        ],
        'sub_url' => '/user/updateUser'
    ],
    'seeUser' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'name' => ['text'=>'账户名','type'=>'span'],
            'email' => ['text'=>'邮箱','type' => 'span'],
            'dept' => ['text'=>'部门','type'=>'span'],
            'role' => ['text'=>'私有角色','type'=>'span'],
        ],
    ],
];
?>