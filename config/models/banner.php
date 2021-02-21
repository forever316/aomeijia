<?php
/**
 * Created by PhpStorm.
 * User: wlf
 * Date: 2020/11/6
 * Time: 14:29
 */


//数组解释
/***
 * key 为你所要操作的表单标识符
 *      field 为所需要的字段数组
 *          key 为字段名以及元素的ID和name
 *              text 为中文解释 type 为表单类型 value 为值 desc 为备注 verify 为所需验证 PS：这些字段一定要存在
 *              verify:required 必填，number 数字，phone 手机号，email 邮箱
 *      sub_url 为表单要提交的地址
 */
return [
    'bannerTypeList' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'text'],
            'title' => ['text'=>'标题','type'=>'text'],
            'desc' => ['text'=>'描述','type'=>'text'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'显示','2'=>'隐藏']],
            'updated_at' => ['text'=>'更新时间','type'=>'text'],
            'created_at' => ['text'=>'创建时间','type'=>'text'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'显示','2'=>'隐藏']],
        ],
        'button' => [
            'update' => '/banner/updateType',
            'see' => '/banner/seeType',
        ],
        'data_url' => '/banner/bannerTypeList'
    ],
    'seeType' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'title' => ['text'=>'标题','type'=>'span'],
            'desc' => ['text'=>'描述','type'=>'text'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'显示','2'=>'隐藏']],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
    
    'updateType' => [
        'field' => [
            'desc' => ['text'=>'描述','type'=>'textarea','verify'=>['required']],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'desc'=>'','verify'=>['required']],
        ],
        'sub_url' => '/banner/updateType'
    ],

    'bannerList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'title' => ['text'=>'标题'],
            'type' => ['text'=>'类型'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态'],
            'describe' => ['text'=>'描述','type'=>'text'],
            'updated_at' => ['text'=>'更新时间'],
            'created_at' => ['text'=>'创建时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'显示','2'=>'隐藏']],
        ],
        'button' => [
            'add' => '/banner/addBanner',
            'update' => '/banner/updateBanner',
            'see' => '/banner/seeBanner',
            'delete' => '/banner/deleteBanner',
        ],
        'data_url' => '/banner/bannerList'
    ],
    'addBanner' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'link' => ['text'=>'链接','type'=>'input','value'=>''],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'img_url' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'显示','2'=>'隐藏'],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>''],
        ],
        'sub_url'=>'/banner/addBanner',
    ],
    'updateBanner' => [
        'field' => [
            'title' => ['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'type' => ['text'=>'所属模块','type'=>'select','value'=>[],'verify'=>['required']],
            'link' => ['text'=>'链接','type'=>'input','value'=>''],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','verify'=>['required','number'],'desc'=>'数值越大，排列越靠前'],
            'img_url' => ['text'=>'图片','type'=>'img','value'=>'','verify'=>['required']],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'显示','2'=>'隐藏'],'verify'=>['required']],
            'describe' => ['text'=>'描述','type'=>'input','value'=>''],
        ],
        'sub_url'=>'/banner/updateBanner',
    ],
    'seeBanner' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'title' => ['text'=>'标题','type'=>'span'],
            'link' => ['text'=>'链接','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['1'=>'显示','2'=>'隐藏']],
            'describe'=>['text'=>'描述','type'=>'span'],
            'img_url' => ['text'=>'图片','type'=>'img'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>