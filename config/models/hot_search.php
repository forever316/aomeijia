<?php

return [
    'hotsearchList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'搜索词类型','options'=>['1'=>'投资主题','2'=>'海外房产',3=>'成功案例',4=>'百科资讯']],
            'words' => ['text'=>'搜索词'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'words' => ['text'=>'搜索词','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
            'type' => ['text'=>'搜索词类型','type'=>'select','value'=>[''=>'--请选择--','1'=>'投资主题','2'=>'海外房产',3=>'成功案例',4=>'百科资讯']],
        ],
        'button' => [
            'add' => '/hotsearch/addHotsearch',
            'update' => '/hotsearch/updateHotsearch',
            'see' => '/hotsearch/seeHotsearch',
            'delete' => '/hotsearch/deleteHotsearch',
        ],
        'data_url' => '/hotsearch/hotsearchList',
    ],
    'addHotsearch' => [
        'field' => [
            'words' => ['text'=>'搜索词','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'搜索词类型','type'=>'select','value'=>['1'=>'投资主题','2'=>'海外房产',3=>'成功案例',4=>'百科资讯'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/hotsearch/addHotsearch',
    ],
    'updateHotsearch' => [
        'field' => [
            'words' => ['text'=>'搜索词','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'搜索词类型','type'=>'select','value'=>['1'=>'投资主题','2'=>'海外房产',3=>'成功案例',4=>'百科资讯'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/hotsearch/updateHotsearch'
    ],
    'seeHotsearch' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'搜索词类型','type'=>'select','value'=>['1'=>'投资主题','2'=>'海外房产',3=>'成功案例',4=>'百科资讯']],
            'words' => ['text'=>'搜索词','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>