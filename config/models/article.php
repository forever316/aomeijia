<?php

return [
    'articleList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'所属模块','options'=>[]],
            'title' => ['text'=>'标题'],
            'describe' => ['text'=>'描述'],
            'sort' => ['text'=>'排序'],
            'read'=>['text'=>'阅读量'],
            'real_read' =>['text'=>'真实阅读量'],
            'publish_date' =>['text'=>'发布时间'],
            'status' => ['text'=>'状态','options'=>['1'=>'发布','2'=>'不发布']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'发布','2'=>'不发布']],
        ],
        'button' => [
            'add' => '/article/addArticle',
            'update' => '/article/updateArticle',
            'see' => '/article/seeArticle',
            'delete' => '/article/deleteArticle',
        ],
        'data_url' => '/article/articleList',
    ],
    'addArticle' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'是否发布','type'=>'radio','value'=>['1'=>'发布','2'=>'不发布'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url'=>'/article/addArticle',
    ],
    'updateArticle' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>''],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'是否发布','type'=>'radio','value'=>['1'=>'发布','2'=>'不发布'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/article/updateArticle'
    ],
    'seeArticle' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'所属模块','type'=>'span'],
            'title' => ['text'=>'标题','type'=>'span'],
            'describe' => ['text'=>'描述','type'=>'span'],
            'thumb' => ['text'=>'图片','type'=>'img'],
            'content' => ['text'=>'内容','type'=>'content'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'是否发布','type'=>'select','value'=>['1'=>'发布','2'=>'不发布']],
            'read' => ['text'=>'阅读量','type'=>'span'],
            'real_read' => ['text'=>'真实阅读量','type'=>'span'],
            'publish_date' => ['text'=>'发布时间','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],


    'articleTypeList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'名称'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'名称','type'=>'input'],
        ],
        'data_url' => '/article/articleTypeList',
    ],
];
?>