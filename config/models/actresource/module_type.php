<?php

return [
    'moduleTypeList' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'text'],
            'module_id' => ['text'=>'模块名称','type'=>'text'],
            'name' => ['text'=>'模块类别名称','type'=>'text'],
            'sort' => ['text'=>'排序','type'=>'text'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['2'=>'禁用','1'=>'启用']],
            'created_at' => ['text'=>'创建时间','type'=>'text'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'模块名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/moduleType/moduleTypeAdd',
            'update' => '/moduleType/moduleTypeUpdate',
            // 'see' => '/moduleType/moduleTypeDetail',
            'delete' => '/moduleType/moduleTypeDel',
        ],
        'data_url' => '/moduleType/moduleTypeList'
    ],
    'moduleTypeAdd' => [
        'field' => [
            'name' => ['text'=>'模块类别名称','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'module_id' => ['text'=>'所属模块','type'=>'select','value'=>'','desc'=>'','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'status' => ['text'=>'是否启用','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'desc'=>'','verify'=>['required']],
           
        ],
        'sub_url' => '/moduleType/moduleTypeAdd'
    ],
   'moduleTypeUpdate' => [
         'field' => [
            'name' => ['text'=>'名称','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','value'=>'','desc'=>'','verify'=>['required']],
            'status' => ['text'=>'是否启用','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'desc'=>'','verify'=>['required']],
           
        ],
        'sub_url' => '/moduleType/moduleTypeUpdate'
    ],
    'moduleTypeDetail' => [
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