<?php

return [
    'list' => [
        'field' => [
            'id' => ['text'=>'ID'],
			'theme' => ['text'=>'主题'],
            'type' => ['text'=>'类型'],
            'time' => ['text'=>'活动时间'],
            'address' => ['text'=>'活动地点'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'button' => [
            'add' => '/active/add',
            'update' => '/active/update',
            'see' => '/active/see',
            'delete' => '/active/delete',
        ],
        'data_url' => '/active/list',
    ],
    'add' => [
        'field' => [
			'theme' => ['text'=>'主题','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'封面图','type'=>'img','value'=>'','verify'=>['required']],
            'type' => ['text'=>'类型','type'=>'input','value'=>'','verify'=>['required']],
            'time' => ['text'=>'活动时间','type'=>'input','value'=>'','verify'=>['required']],
            'address' => ['text'=>'活动地点','type'=>'input','value'=>'','verify'=>['required']],
            'content' => ['text'=>'文章详情','type'=>'ueditor','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/active/add',
    ],
    'update' => [
        'field' => [
			'theme' => ['text'=>'主题','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'封面图','type'=>'img','value'=>'','verify'=>['required']],
            'type' => ['text'=>'类型','type'=>'input','value'=>'','verify'=>['required']],
            'time' => ['text'=>'活动时间','type'=>'input','value'=>'','verify'=>['required']],
            'address' => ['text'=>'活动地点','type'=>'input','value'=>'','verify'=>['required']],
            'content' => ['text'=>'文章详情','type'=>'ueditor','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
		],
        'sub_url' => '/active/update'
    ],
    'see' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'theme' => ['text'=>'主题','type'=>'span'],
            'thumb' => ['text'=>'封面图','type'=>'img'],
            'type' => ['text'=>'类型','type'=>'span'],
            'time' => ['text'=>'活动时间','type'=>'span'],
            'address' => ['text'=>'活动地点','type'=>'span'],
            'content' => ['text'=>'文章详情','type'=>'content'],
            'sort'=>['text'=>'排序','type'=>'span','value'=>''],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>