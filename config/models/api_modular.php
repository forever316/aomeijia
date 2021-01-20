<?php

return [
    'apiList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'标题'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'标题','type'=>'input'],
        ],
        'button' => [
            'add' => '/addApi',
            'update' => '/updateApi',
            'see' => '/seeApi',
            'delete' => '/deleteApi',
        ],
        'data_url' => '/apiList',
    ],
    'addApi' => [
        'field' => [
            'thumb' => ['text'=>'缩略图','type'=>'img','value'=>'','verify'=>['required']],
            'name' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required']],
            'status' => ['text'=>'是否发布','type'=>'select','value'=>['1'=>'发布','2'=>'不发布']],
        ],
        'sub_url'=>'/addApi',
    ],
    'updateApi' => [
        'field' => [
            'thumb' => ['text'=>'缩略图','type'=>'img','value'=>'','verify'=>['required']],
            'name' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required']],
            'status' => ['text'=>'是否发布','type'=>'select','value'=>['1'=>'发布','2'=>'不发布']],
        ],
        'sub_url' => '/updateApi'
    ],
];
?>