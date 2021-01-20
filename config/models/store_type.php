<?php
return [
    'storeTypeList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'pid' => ['text'=>'商家上级类型'],
            'name' => ['text'=>'商家类型名称'],
            'pic' => ['text'=>'商家类型图片'],
            'updated_at' => ['text'=>'商家类型更新时间'],
            'created_at' => ['text'=>'商家类型创建时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'商家类型名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/storeType/storeTypeAdd',
            'update' => '/storeType/storeTypeUpdate',
            'delete' => '/storeType/storeTypeDelete',
        ],
        'data_url' => '/storeType/storeTypeList'
    ],
    'storeTypeAdd' => [
        'field' => [
            'pid' => ['text'=>'上级类型','type'=>'custom','value'=>'admin.goods.goodsType_ztree','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required','number'],'desc'=>'数值越小越靠前'],
            'name' => ['text'=>'商家类型名称','type'=>'input','verify'=>['required']],
            'is_show' => ['text'=>'是否在首页显示','type'=>'radio','verify'=>['required'],'value'=>['-1'=>'否','1'=>'是']],
            'pic' => ['text'=>'商家类型图片','type'=>'img','limit'=>1,'folder'=>'storeType'],

        ],
        'sub_url'=>'/storeType/storeTypeAdd',
    ],
    'storeTypeUpdate' => [
        'field' => [
            'pid' => ['text'=>'上级类型','type'=>'custom','value'=>'admin.goods.goodsType_ztree','verify'=>['required']],
            'sort' => ['text'=>'排序','type'=>'input','verify'=>['required','number'],'desc'=>'数值越小越靠前'],
            'name' => ['text'=>'商家类型名称','type'=>'input','verify'=>['required']],
            'is_show' => ['text'=>'是否在首页显示','type'=>'radio','verify'=>['required'],'value'=>['-1'=>'否','1'=>'是']],
            'pic' => ['text'=>'商家类型图片','type'=>'img','limit'=>1,'folder'=>'storeType'],

        ],
        'sub_url'=>'/storeType/storeTypeUpdate',
    ],
];