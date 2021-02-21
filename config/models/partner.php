<?php

return [
    'partnerList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type' => ['text'=>'所属类型','options'=>[]],
            'title' => ['text'=>'合作伙伴标题'],
            'logo' => ['text'=>'合作伙伴logo'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'sort'=>['text'=>'排序'],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'合作伙伴标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/partner/addPartner',
            'update' => '/partner/updatePartner',
            'see' => '/partner/seePartner',
            'delete' => '/partner/deletePartner',
        ],
        'data_url' => '/partner/partnerList',
    ],
    'addPartner' => [
        'field' => [
            'title' => ['text'=>'合作伙伴标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属类型','type'=>'select','value'=>[],'verify'=>['required']],
            'logo' => ['text'=>'合作伙伴logo','type'=>'img','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/partner/addPartner',
    ],
    'updatePartner' => [
        'field' => [
            'title' => ['text'=>'合作伙伴标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属类型','type'=>'select','value'=>[],'verify'=>['required']],
            'logo' => ['text'=>'合作伙伴logo','type'=>'img','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/partner/updatePartner'
    ],
    'seePartner' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'type' => ['text'=>'所属类型','type'=>'span'],
            'title' => ['text'=>'合作伙伴标题','type'=>'span'],
            'logo' => ['text'=>'合作伙伴logo','type'=>'img'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'是否发布','type'=>'span','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],

    'partnerTypeList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'名称'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'sort' => ['text'=>'排序'],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'名称','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/partner/addPartnerType',
            'update' => '/partner/updatePartnerType',
        ],
        'data_url' => '/partner/partnerTypeList',
    ],
    'addPartnerType' => [
        'field' => [
            'name' => ['text'=>'名称','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/partner/addPartnerType',
    ],
    'updatePartnerType' => [
        'field' => [
            'name' => ['text'=>'名称','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/partner/updatePartnerType'
    ],
];
?>