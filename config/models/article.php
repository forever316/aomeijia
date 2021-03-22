<?php
$type = isset($_GET['type']) && $_GET['type'] ? $_GET['type'] : 0;
//$typeArr = ['1'=>'公司简介','2'=>'加入我们',3=>'联系我们',4=>'集团动态',5=>'项目动态',6=>'投资主题'];
return [
    'articleList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'title' => ['text'=>'标题'],
            'describe' => ['text'=>'描述'],
            'sort' => ['text'=>'排序'],
            'read'=>['text'=>'阅读量'],
//            'real_read' =>['text'=>'真实阅读量'],
            'publish_date' =>['text'=>'发布时间'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'type' => ['text'=>'标题','type'=>'hidden','value'=>$type],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/article/addArticle?type='.$type,
            'update' => '/article/updateArticle',
            'see' => '/article/seeArticle',
            'delete' => '/article/deleteArticle',
        ],
        'data_url' => '/article/articleList?type='.$type,
    ],
    'addArticle' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属模块','type'=>'hidden','value'=>$type,'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url'=>'/article/addArticle?type='.$type,
    ],
    'updateArticle' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            // 'type' => ['text'=>'所属模块','type'=>'span','value'=>'','verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>''],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/article/updateArticle',
    ],
    'seeArticle' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            // 'type' => ['text'=>'所属模块','type'=>'span'],
            'title' => ['text'=>'标题','type'=>'span'],
            'describe' => ['text'=>'描述','type'=>'span'],
            'thumb' => ['text'=>'图片','type'=>'img'],
            'content' => ['text'=>'内容','type'=>'content'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'read' => ['text'=>'阅读量','type'=>'span'],
//            'real_read' => ['text'=>'真实阅读量','type'=>'span'],
            'publish_date' => ['text'=>'发布时间','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>