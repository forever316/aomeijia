<?php
return [
    'cityList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'pid' => ['text'=>'上级城市'],
            'name' => ['text'=>'城市名称'],
            'english_name' => ['text'=>'城市英文名称'],
            'pic' => ['text'=>'城市图片'],
            'hot' => ['text'=>'是否热门','options'=>['1'=>'是','2'=>'否']],
            'updated_at' => ['text'=>'城市更新时间'],
            'created_at' => ['text'=>'城市创建时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'城市名称','type'=>'input'],
            'hot' => ['text'=>'是否热门','type'=>'select','value'=>[0=>'请选择','1'=>'是','2'=>'否']],
        ],
        'button' => [
            'add' => '/city/cityAdd',
            'update' => '/city/cityUpdate',
            'delete' => '/city/cityDelete',
        ],
        'data_url' => '/city/cityList'
    ],
    'cityAdd' => [
        'field' => [
            'pid' => ['text'=>'上级城市','type'=>'custom','value'=>'admin.common.city_ztree','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required','number'],'desc'=>'数值越大越靠前'],
            'name' => ['text'=>'城市名称','type'=>'input','verify'=>['required']],
            'english_name' => ['text'=>'城市英文名称','type'=>'input'],
            'hot' => ['text'=>'是否热门','type'=>'radio','value'=>['1'=>'是','2'=>'否'],'verify'=>['required']],
            'pic' => ['text'=>'城市图片','type'=>'img','limit'=>1,'folder'=>'city'],
        ],
        'sub_url'=>'/city/cityAdd',
    ],
    'cityUpdate' => [
        'field' => [
            'pid' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.city_ztree','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required','number'],'desc'=>'数值越大越靠前'],
            'name' => ['text'=>'城市名称','type'=>'input','verify'=>['required']],
            'english_name' => ['text'=>'城市英文名称','type'=>'input'],
            'hot' => ['text'=>'是否热门','type'=>'radio','value'=>['1'=>'是','2'=>'否'],'verify'=>['required']],
            'pic' => ['text'=>'城市图片','type'=>'img','limit'=>1,'folder'=>'city'],
        ],
        'sub_url'=>'/city/cityUpdate',
    ],
];