<?php
$category = isset($_GET['category']) && $_GET['category'] ? $_GET['category'] : 0;
return [
    'informationList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'type_id' => ['text'=>'所属模块'],
			'city_id' => ['text'=>'城市'],
            'title' => ['text'=>'标题'],
            'describe' => ['text'=>'描述'],
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
			'type_id' => ['text'=>'类型','type'=>'select','value'=>[]],
            'category' => ['text'=>'','type'=>'hidden','value'=>$category],
        ],
        'button' => [
            'add' => '/information/addInformation?category='.$category,
            'update' => '/information/updateInformation',
            'see' => '/information/seeInformation',
            'delete' => '/information/deleteInformation',
        ],
        'data_url' => '/information/informationList?category='.$category,
    ],
    'addInformation' => [
        'field' => [
			'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'category' => ['text'=>'所属类别','type'=>'hidden','value'=>$category,'verify'=>['required']],
            'type_id' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'是否发布','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url'=>'/information/addInformation?category='.$category,
    ],
    'updateInformation' => [
        'field' => [
			'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type_id' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'thumb' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'read' => ['text'=>'阅读量','type'=>'input','value'=>''],
            'publish_date' => ['text'=>'发布时间','type'=>'date','value'=>''],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'是否发布','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'content' => ['text'=>'内容','type'=>'ueditor','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/information/updateInformation'
    ],
    'seeInformation' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
			'city_id' => ['text'=>'城市','type'=>'span'],
            'type_id' => ['text'=>'所属模块','type'=>'span'],
            'title' => ['text'=>'标题','type'=>'span'],
            'describe' => ['text'=>'描述','type'=>'span'],
            'thumb' => ['text'=>'图片','type'=>'img'],
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