<?php

return [
    'teamMemberList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'名字'],
            'job' => ['text'=>'职位'],
            'phone' => ['text'=>'电话'],
            'wechat_id' => ['text'=>'微信号'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'sort'=>['text'=>'排序'],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'名字','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/teamMember/addTeamMember',
            'update' => '/teamMember/updateTeamMember',
            'see' => '/teamMember/seeTeamMember',
            'delete' => '/teamMember/deleteTeamMember',
        ],
        'data_url' => '/teamMember/teamMemberList',
    ],
    'addTeamMember' => [
        'field' => [
            'name' => ['text'=>'名字','type'=>'input','value'=>'','verify'=>['required']],
            'job' => ['text'=>'职位','type'=>'input','value'=>'','verify'=>['required']],
            'phone' => ['text'=>'电话','type'=>'input','value'=>'','verify'=>['required']],
            'photo' => ['text'=>'照片','type'=>'img','value'=>'','verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'wechat_id' => ['text'=>'微信号','type'=>'input','value'=>'','verify'=>['required']],
            'wechat_code' => ['text'=>'微信二维码','type'=>'img','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url'=>'/teamMember/addTeamMember',
    ],
    'updateTeamMember' => [
        'field' => [
            'name' => ['text'=>'名字','type'=>'input','value'=>'','verify'=>['required']],
            'job' => ['text'=>'职位','type'=>'input','value'=>'','verify'=>['required']],
            'phone' => ['text'=>'电话','type'=>'input','value'=>'','verify'=>['required']],
            'photo' => ['text'=>'照片','type'=>'img','value'=>'','verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'wechat_id' => ['text'=>'微信号','type'=>'input','value'=>'','verify'=>['required']],
            'wechat_code' => ['text'=>'微信二维码','type'=>'img','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
        ],
        'sub_url' => '/teamMember/updateTeamMember'
    ],
    'seeTeamMember' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'name' => ['text'=>'名字','type'=>'span'],
            'job' => ['text'=>'职位','type'=>'span'],
            'phone' => ['text'=>'电话','type'=>'span'],
            'photo' => ['text'=>'照片','type'=>'img'],
            'describe' => ['text'=>'描述','type'=>'span'],
            'wechat_id' => ['text'=>'微信号','type'=>'span'],
            'wechat_code' => ['text'=>'微信二维码','type'=>'img'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>