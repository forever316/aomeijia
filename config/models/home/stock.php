<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/1
 * Time: 13:50
 */
return[
    'stockholderList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name'=>['text'=>'股东名字'],
            'updated_at' => ['text'=>'更新时间'],
            'created_at' => ['text'=>'创建时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'name' => ['text'=>'股东名字','type'=>'input'],
        ],
        'button' => [
            'add' => '/user/addStockholder',
            'update' => '/user/updateStockholder',
            'see' => '/user/seeStockholder',
            'delete' => '/user/deleteStockholder',
        ],
        'data_url' => '/user/stockholderList'
    ],
    'addStockholder' => [
        'field' => [
            'name' => [
                'text'=>'股东名字','type'=>'input','value'=>'','verify'=>['required']
            ]
        ],
        'sub_url'=>'/user/addStockholder',
    ],
    'updateStockholder' => [
        'field' => [
            'name' => ['text'=>'股东名字','type'=>'input','value'=>'','verify'=>['required']],
        ],
        'sub_url'=>'/user/updateStockholder',
    ],
    'seeStockholder' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'name' => ['text'=>'股东名字','type'=>'span'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];