<?php

return [
    'enumList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'枚举类型','options'=>['1'=>'房产类型','2'=>'房产标签',3=>'房产特色',4=>'移民类型',5=>'移民投资金额']],
            'name' => ['text'=>'枚举名称'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'枚举名称','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
            'type' => ['text'=>'枚举类型','type'=>'select','value'=>[''=>'--请选择--','1'=>'房产类型','2'=>'房产标签',3=>'房产特色',4=>'移民类型',5=>'移民标签']],
        ],
        'button' => [
            'add' => '/enum/addEnum',
            'update' => '/enum/updateEnum',
            'see' => '/enum/seeEnum',
        ],
        'data_url' => '/enum/enumList',
    ],
    'addEnum' => [
        'field' => [
            'name' => ['text'=>'枚举名称','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'枚举类型','type'=>'select','value'=>['1'=>'房产类型','2'=>'房产标签',3=>'房产特色',4=>'移民类型',5=>'移民标签'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/enum/addEnum',
    ],
    'updateEnum' => [
        'field' => [
            'name' => ['text'=>'枚举名称','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'枚举类型','type'=>'select','value'=>['1'=>'房产类型','2'=>'房产标签',3=>'房产特色',4=>'移民类型',5=>'移民标签'],'verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/enum/updateEnum'
    ],
    'seeEnum' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'枚举类型','type'=>'select','value'=>['1'=>'房产类型','2'=>'房产标签',3=>'房产特色',4=>'移民类型',5=>'移民标签']],
            'name' => ['text'=>'枚举名称','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>