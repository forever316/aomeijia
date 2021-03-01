<?php

return [
    'faqsList' => [
        'field' => [
            'id' => ['text'=>'ID'],
			'city_id' => ['text'=>'城市'],
            'questions' => ['text'=>'问题'],
            'answers' => ['text'=>'答案'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'questions' => ['text'=>'问题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/faqs/addFaqs',
            'update' => '/faqs/updateFaqs',
            'see' => '/faqs/seeFaqs',
            'delete' => '/faqs/deleteFaqs',
        ],
        'data_url' => '/faqs/faqsList',
    ],
    'addFaqs' => [
        'field' => [
			'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'questions' => ['text'=>'问题','type'=>'input','value'=>'','verify'=>['required']],
            'answers' => ['text'=>'答案','type'=>'textarea','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],

        ],
        'sub_url'=>'/faqs/addFaqs',
    ],
    'updateFaqs' => [
        'field' => [
			'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
			'questions' => ['text'=>'问题','type'=>'input','value'=>'','verify'=>['required']],
			'answers' => ['text'=>'答案','type'=>'textarea','value'=>'','verify'=>['required']],
			'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
			'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],

		],
        'sub_url' => '/faqs/updateFaqs'
    ],
    'seeFaqs' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
			'city_id' => ['text'=>'城市','type'=>'span'],
            'questions' => ['text'=>'问题','type'=>'span'],
            'answers' => ['text'=>'答案','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>