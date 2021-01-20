<?php
return [
    'roleList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'角色名称'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'角色名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/role/addRole',
            'update' => '/role/updateRole',
            'see' => '/role/seeRole',
            'delete' => '/role/deleteRole',
        ],
        'data_url' => '/role/roleList',
    ],
    'addRole' => [
        'field' => [
            'name' => ['text'=>'角色名称','type'=>'input','verify'=>['required']],
            'menu' => ['text'=>'菜单权限配置','type'=>'custom','value'=>'admin.authority.resources'],
        ],
        'sub_url' => '/role/addRole'
    ],
    'updateRole' => [
        'field' => [
            'name' => ['text'=>'角色名称','type'=>'input','verify'=>['required']],
            'menu' => ['text'=>'菜单权限配置','type'=>'custom','value'=>'admin.authority.resources'],
        ],
        'sub_url' => '/role/updateRole'
    ],
    'seeRole' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'name' => ['text'=>'角色名','type'=>'span'],
            'menu' => ['text'=>'拥有菜单','type' => 'span'],
            'resources' => ['text'=>'拥有资源','type'=>'span'],
        ],
    ],
];