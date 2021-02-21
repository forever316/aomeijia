<?php

return [
    'tagList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'标签类型','options'=>['1'=>'房产标签','2'=>'投资标签']],
            'name' => ['text'=>'标签名'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'标签名','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
            'type' => ['text'=>'标签类型','type'=>'select','value'=>[''=>'--请选择--','1'=>'房产标签','2'=>'投资标签']],
        ],
        'button' => [
            'add' => '/tag/addTag',
            'update' => '/tag/updateTag',
            'see' => '/tag/seeTag',
            'delete' => '/tag/deleteTag',
        ],
        'data_url' => '/tag/tagList',
    ],
    'addTag' => [
        'field' => [
            'name' => ['text'=>'标签名','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'标签类型','type'=>'select','value'=>['1'=>'房产标签','2'=>'投资标签'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/tag/addTag',
    ],
    'updateTag' => [
        'field' => [
            'name' => ['text'=>'标签名','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'标签类型','type'=>'select','value'=>['1'=>'房产标签','2'=>'投资标签'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/tag/updateTag'
    ],
    'seeTag' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'标签类型','type'=>'select','value'=>['1'=>'房产标签','2'=>'投资标签']],
            'name' => ['text'=>'标签名','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>