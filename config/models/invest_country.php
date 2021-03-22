<?php
return [
    'investCountryList' => [
        'field' => [
            'id' => ['text'=>'ID'],
			'city_id' => ['text'=>'城市'],
            'title' => ['text'=>'标题'],
            'hot' => ['text'=>'投资热度'],
            'sort' => ['text'=>'排序'],
            'read'=>['text'=>'阅读量'],
//            'real_read' =>['text'=>'真实阅读量'],
            'publish_date' =>['text'=>'发布时间'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/investCountry/addInvestCountry',
            'update' => '/investCountry/updateInvestCountry',
            'see' => '/investCountry/seeInvestCountry',
            'delete' => '/investCountry/deleteInvestCountry',
        ],
        'data_url' => '/investCountry/investCountryList',
    ],
    'addInvestCountry' => [
        'field' => [
			'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'tag_id' => ['text'=>'标签','type'=>'checkbox','value'=>'','verify'=>['required']],
            'hot' => ['text'=>'投资热度','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'1-5的数字'],
            'thumb' => ['text'=>'封面图','type'=>'img','value'=>'','verify'=>['required']],
            'advantage_img' => ['text'=>'优势图片','type'=>'img','value'=>'','verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'textarea','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url'=>'/investCountry/addInvestCountry',
    ],
    'updateInvestCountry' => [
        'field' => [
            'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'tag_id' => ['text'=>'标签','type'=>'checkbox','value'=>'','verify'=>['required']],

            'hot' => ['text'=>'投资热度','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'封面图','type'=>'img','value'=>'','verify'=>['required']],
            'advantage_img' => ['text'=>'优势图片','type'=>'img','value'=>'','verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'textarea','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/investCountry/updateInvestCountry'
    ],
    'seeInvestCountry' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
			'city_id' => ['text'=>'城市','type'=>'span'],
            'tag_id' => ['text'=>'标签','type'=>'span'],
            'title'=>['text'=>'标题','type'=>'span'],
            'hot' => ['text'=>'投资热度','type'=>'span'],
            'thumb' => ['text'=>'图片','type'=>'img'],
            'advantage_img'=>['text'=>'优势图片','type'=>'img'],
            'describe' => ['text'=>'描述','type'=>'span'],
            'content' => ['text'=>'内容','type'=>'content'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'是否发布','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'read' => ['text'=>'阅读量','type'=>'span'],
//            'real_read' => ['text'=>'真实阅读量','type'=>'span'],
            'publish_date' => ['text'=>'发布时间','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>