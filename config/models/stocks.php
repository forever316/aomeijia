<?php
/**
 * Created by PhpStorm.
 * User: wlf
 * Date: 2019/4/10
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
    'stocksList' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'text'],
            'scode' => ['text'=>'代码','type'=>'text'],
            'prefix' => ['text'=>'prefix','type'=>'text'],
            'sname' => ['text'=>'名称','type'=>'text'],
            'price' => ['text'=>'价格','type'=>'text'],
            'status' => ['text'=>'状态','type'=>'text'],
            'tprice' => ['text'=>'最新目标价','type'=>'text'],
            'created_at' => ['text'=>'创建时间','type'=>'text'],
            'updated_at' => ['text'=>'更新时间','type'=>'text'],
        ],
        'search' => [
            // 'id' => ['text'=>'ID','type'=>'input'],
            'scode' => ['text'=>'代码','type'=>'input'],
            'sname' => ['text'=>'名称','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[0=>'启用', 1=>'禁用']],
        ],
        'button' => [
            'add' => '/stocks/addStocks',
            'update' => '/stocks/updateStocks',
            'start' => '/stocks/startStocks',
            'stop' => '/stocks/stopStocks',
            'delete' => '/stocks/deleteStocks',
        ],
        'data_url' => '/stocks/stocksList'
    ],

    'addStocks' => [
        'field' => [
            'scode' => ['text'=>'代码','type'=>'input','verify'=>['required']],
            'prefix' => ['text'=>'prefix','type'=>'input','verify'=>['required']],
            'sname' => ['text'=>'名称','type'=>'input','verify'=>['required']],
            'price' => ['text'=>'价格','type'=>'input','verify'=>['required','number']],
            'tprice' => ['text'=>'最新目标价','type'=>'input','verify'=>['number']],

        ],
        'sub_url' => '/stocks/addStocks'
    ],
    'updateStocks' => [
        'field' => [
            'scode' => ['text'=>'代码','type'=>'input','verify'=>['required'],'readonly'=>true],
            'prefix' => ['text'=>'prefix','type'=>'input','verify'=>['required']],
            'sname' => ['text'=>'名称','type'=>'input','verify'=>['required']],
            'price' => ['text'=>'价格','type'=>'input','verify'=>['required','number']],
            'tprice' => ['text'=>'最新目标价','type'=>'input','verify'=>['number']],

        ],
        'sub_url' => '/stocks/updateStocks'
    ],
];
?>