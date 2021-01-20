<?php
return [
    'modularList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'modular_name' => ['text'=>'模块名称'],
            'modular_img' => ['text'=>'模块图片'],
            'sort' => ['text'=>'排序'],
            'updated_at' => ['text'=>'模块更新时间'],
            'created_at' => ['text'=>'模块创建时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'modular_name' => ['text'=>'模块名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/shoppingHome/modularAdd',
            'update' => '/shoppingHome/modularUpdate',
            'delete' => '/shoppingHome/modularDelete',
        ],
        'data_url' => '/shoppingHome/modularList'
    ],
    'modularAdd' => [
        'field' => [
            'modular_name' => ['text'=>'模块名称','type'=>'input','verify'=>['required']],
            'modular_img' => ['text'=>'模块图片','type'=>'img','limit'=>1,'folder'=>'homeModular'],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required'],'desc'=>'数值越大越靠前'],
            'modular_type' => ['text'=>'模块类型','type'=>'custom','value'=>'admin.home.home_modular_change'],
            //'modular' => ['text'=>'模块','type'=>'custom','value'=>'admin.home.home_modular'],
        ],
        'sub_url'=>'/shoppingHome/modularAdd',
    ],
    'modularUpdate' => [
        'field' => [
            'modular_name' => ['text'=>'模块名称','type'=>'input','verify'=>['required']],
            'modular_img' => ['text'=>'模块图片','type'=>'img','limit'=>1,'folder'=>'homeModular'],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required'],'desc'=>'数值越大越靠前'],
            'modular' => ['text'=>'模块','type'=>'custom','value'=>'admin.home.home_modular_up'],
        ],
        'sub_url'=>'/shoppingHome/modularUpdate',
    ],
];