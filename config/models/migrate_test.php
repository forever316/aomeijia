<?php
return [
    'migrateTestList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'客户名字'],
            'phone' => ['text'=>'电话号码'],
            'email'=>['text'=>'邮箱'],
            'sex' => ['text'=>'性别','options'=>['1'=>'启用','2'=>'禁用']],
            'city'=>['text'=>'国家'],
            'reason'=>['text'=>'原因'],
            'capital' => ['text'=>'资产'],
            'education' => ['text'=>'学历'],
            'oversea_identity'=>['text'=>'海外身份'],
            'english_level'=>['text'=>'英语能力'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'客户名字','type'=>'input'],
            'phone' => ['text'=>'电话号码','type'=>'input'],
            'email' => ['text'=>'邮箱','type'=>'input'],
            'sex' => ['text'=>'性别','type'=>'select','value'=>[''=>'--请选择--','1'=>'先生','2'=>'女士']],
        ],
        'button' => [
            'see' => '/migrateTest/seeMigrateTest',
        ],
        'data_url' => '/migrateTest/migrateTestList',
    ],
    'seeMigrateTest' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
			'name' => ['text'=>'客户名字','type'=>'span'],
            'phone' => ['text'=>'电话号码','type'=>'span'],
            'email'=>['text'=>'邮箱','type'=>'span'],
            'sex' => ['text'=>'性别','type'=>'select','value'=>['1'=>'先生','2'=>'女士']],
            'city' => ['text'=>'国家','type'=>'span'],
            'reason'=>['text'=>'移民原因','type'=>'span'],
            'capital' => ['text'=>'资产','type'=>'span'],
            'education' => ['text'=>'学历','type'=>'span'],
            'oversea_identity'=>['text'=>'海外身份','type'=>'span'],
            'english_level' => ['text'=>'英语能力','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>