<?php
return [
    'departmentList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'部门名称'],
            'pid' => ['text'=>'上级部门','options'=>[]],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'部门名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/department/addDepartment',
            'update' => '/department/updateDepartment',
            'see' => '/department/seeDepartment',
            'delete' => '/department/deleteDepartment',
        ],
        'data_url' => '/department/departmentList',
    ],
    'addDepartment' => [
        'field' => [
            'name' => ['text'=>'部门名称','type'=>'input','verify'=>['required']],
            'pid' => ['text'=>'上级部门','type'=>'custom','value'=>'admin.authority.departement_ztree','verify'=>['required']],
            'role_ids' => ['text'=>'拥有角色','type'=>'checkbox','value'=>[],'verify'=>['required']],
        ],
        'sub_url' => '/department/addDepartment'
    ],
    'updateDepartment' => [
        'field' => [
            'name' => ['text'=>'部门名称','type'=>'input','verify'=>['required']],
            'pid' => ['text'=>'上级部门','type'=>'custom','value'=>'admin.authority.departement_ztree','verify'=>['required']],
            'role_ids' => ['text'=>'拥有角色','type'=>'checkbox','value'=>[],'verify'=>['required']],
        ],
        'sub_url' => '/department/updateDepartment'
    ],
    'seeDepartment' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'name' => ['text'=>'部门名称','type'=>'span'],
            'pid' => ['text'=>'上级部门','type'=>'span'],
            'role' => ['text'=>'拥有角色','type'=>'span'],
        ],
    ],
];