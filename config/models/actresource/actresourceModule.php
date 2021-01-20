<?php

return [
    'moduleList' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'text'],
            'name' => ['text'=>'活动资源类型名称','type'=>'text'],
            'sort' => ['text'=>'排序','type'=>'text'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['2'=>'禁用','1'=>'启用']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'类型名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/actResourceModule/actResourceModuleAdd',
            'update' => '/actResourceModule/actResourceModuleUpdate',
            'see' => '/actResourceModule/actResourceModuleDetail',
            'delete' => '/actResourceModule/actResourceModuleDel',
        ],
        'data_url' => '/actResourceModule/actResourceModuleList'
    ],
    'moduleAdd' => [
        'field' => [
            'name' => ['text'=>'活动资源类型名称','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'status' => ['text'=>'是否启用','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'desc'=>'','verify'=>['required']],
           
        ],
        'sub_url' => '/actResourceModule/actResourceModuleAdd'
    ],
   'moduleUpdate' => [
         'field' => [
            'name' => ['text'=>'名称','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'status' => ['text'=>'是否启用','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'desc'=>'','verify'=>['required']],
           
        ],
        'sub_url' => '/actResourceModule/actResourceModuleUpdate'
    ],
    'moduleDetail' => [
        'field' => [
            'name' => ['text'=>'名称','type'=>'text'],
            'sort' => ['text'=>'排序','type'=>'text'],
            'status' => ['text'=>'是否启用','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间','type'=>'text'],
            'updated_at' => ['text'=>'更新时间','type'=>'text'],
        ]
    ]
];
?>