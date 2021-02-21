<?php

return [
    'linkList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'链接类型','options'=>[]],
            'title' => ['text'=>'链接名称'],
            'url' => ['text'=>'链接的url链接'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'链接名称','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/link/addLink',
            'update' => '/link/updateLink',
            'see' => '/link/seeLink',
            'delete' => '/link/deleteLink',
        ],
        'data_url' => '/link/linkList',
    ],
    'addLink' => [
        'field' => [
            'title' => ['text'=>'链接名称','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属类型','type'=>'select','value'=>[],'verify'=>['required']],
            'url' => ['text'=>'链接的url链接','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/link/addLink',
    ],
    'updateLink' => [
        'field' => [
            'title' => ['text'=>'链接名称','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属类型','type'=>'select','value'=>[],'verify'=>['required']],
            'url' => ['text'=>'链接的url链接','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/link/updateLink'
    ],
    'seeLink' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'所属类型','type'=>'span'],
            'title' => ['text'=>'链接名称','type'=>'span'],
            'url' => ['text'=>'链接的url链接','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],


    'linkTypeList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'名称'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'名称','type'=>'input'],
        ],
        'data_url' => '/link/linkTypeList',
    ],
];
?>