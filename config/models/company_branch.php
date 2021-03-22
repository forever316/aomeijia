<?php

return [
    'list' => [
        'field' => [
            'id' => ['text'=>'ID'],
			'company_name' => ['text'=>'分公司名称'],
            'company_address' => ['text'=>'分公司地址'],
            'sort' => ['text'=>'排序'],
        ],
        'button' => [
            'add' => '/companyBranch/add',
            'update' => '/companyBranch/update',
            'delete' => '/companyBranch/delete',
        ],
        'data_url' => '/companyBranch/list',
    ],
    'add' => [
        'field' => [
			'company_name' => ['text'=>'分公司名称','type'=>'input','value'=>'','verify'=>['required']],
            'company_address' => ['text'=>'分公司地址','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
        ],
        'sub_url'=>'/companyBranch/add',
    ],
    'update' => [
        'field' => [
			'company_name' => ['text'=>'分公司名称','type'=>'input','value'=>'','verify'=>['required']],
            'company_address' => ['text'=>'分公司地址','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],

		],
        'sub_url' => '/companyBranch/update'
    ],
];
?>