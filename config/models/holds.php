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
    'holdsList' => [
        'field' => [
            0=>[
                'id' => ['text'=>'ID','type'=>'text'],
                // 'hdate' => ['text'=>'持仓日期','type'=>'text'],
                'uid' => ['text'=>'用户账号','type'=>'text'],
                'scode' => ['text'=>'代码','type'=>'text'],
                'sname' => ['text'=>'名称','type'=>'text'],
                'hprice' => ['text'=>'持仓成本','type'=>'text'],
                'hnum' => ['text'=>'持仓数量','type'=>'text'],
                's_price' => ['text'=>'现价','type'=>'text'],
                's_tprice' => ['text'=>'最新目标价','type'=>'text'],
                // 'account_profit' => ['text'=>'账面盈亏','type'=>'text'],
                // 'percent' => ['text'=>'比例%','type'=>'text'],
                // 'amount' => ['text'=>'GetRich金额','type'=>'text'],
                // 'profit_forecast' => ['text'=>'盈利预测','type'=>'text'],
                // 'in_date' => ['text'=>'入账日期','type'=>'text'],
                // 'sdate' => ['text'=>'结算日期','type'=>'text'],
                // 'status' => ['text'=>'结算状态','type'=>'text'],
                // 'created_at' => ['text'=>'创建时间','type'=>'text'],
                // 'updated_at' => ['text'=>'更新时间','type'=>'text'],
            ],
            1=>[
                'id' => ['text'=>'ID','type'=>'text'],
                'hdate' => ['text'=>'持仓日期','type'=>'text'],
                'uid' => ['text'=>'用户账号','type'=>'text'],
                'scode' => ['text'=>'代码','type'=>'text'],
                'sname' => ['text'=>'名称','type'=>'text'],
                'hprice' => ['text'=>'持仓成本','type'=>'text'],
                'hnum' => ['text'=>'持仓数量','type'=>'text'],
                's_price' => ['text'=>'现价','type'=>'text'],
                's_tprice' => ['text'=>'最新目标价','type'=>'text'],
                'account_profit' => ['text'=>'账面盈亏','type'=>'text'],
                'percent' => ['text'=>'比例%','type'=>'text'],
                'amount' => ['text'=>'GetRich金额','type'=>'text'],
                'profit_forecast' => ['text'=>'盈利预测','type'=>'text'],
                'in_date' => ['text'=>'入账日期','type'=>'text'],
                // 'sdate' => ['text'=>'结算日期','type'=>'text'],
                // 'status' => ['text'=>'结算状态','type'=>'text'],
                'created_at' => ['text'=>'创建时间','type'=>'text'],
                // 'updated_at' => ['text'=>'更新时间','type'=>'text'],
            ],
        ],
        'search' =>[
            0=>[
                'sid' => ['text'=>'代码','type'=>'select'],
            ],
            1=>[
                // 'id' => ['text'=>'ID','type'=>'input'],
                'uid' => ['text'=>'用户账号','type'=>'select'],
                'sid' => ['text'=>'代码','type'=>'select'],
                'status' => ['text'=>'结算状态','type'=>'select','value'=>[0=>'未结算', 1=>'已结算']],
                'start_time' => ['text'=>'入账开始日期','type'=>'date','value'=>date('Y-m-d')],
                'end_time' => ['text'=>'入账结束日期','type'=>'date','value'=>date('Y-m-d')],
            ],
        ],
        'button' => [
            'add' => '/holds/addHolds',
            'update' => '/holds/updateHolds',
            'settlement' => '/holds/settlementHolds',
            'settleOne' => '/holds/settleOneHolds',
            'delete' => '/holds/deleteHolds',
        ],
        'data_url' => '/holds/holdsList'
    ],

    'addHolds' => [
        'field' => [
            'uid' => ['text'=>'用户账号','type'=>'select','verify'=>['required']],
            'sid' => ['text'=>'代码','type'=>'select','verify'=>['required']],
            'hdate' => ['text'=>'持仓日期','type'=>'date','verify'=>['required'],'value'=>date('Y-m-d')],
            'hnum' => ['text'=>'持仓数量','type'=>'input','verify'=>['number']],
            'hprice' => ['text'=>'持仓成本','type'=>'input','verify'=>['number']],

        ],
        'sub_url' => '/holds/addHolds'
    ],
    'updateHolds' => [
        'field' => [
            'uid' => ['text'=>'用户账号','type'=>'select','verify'=>['required']],
            'sid' => ['text'=>'代码','type'=>'select','verify'=>['required']],
            'hdate' => ['text'=>'持仓日期','type'=>'date','verify'=>['required']],
            'hnum' => ['text'=>'持仓数量','type'=>'input','verify'=>['number']],
            'hprice' => ['text'=>'持仓成本','type'=>'input','verify'=>['number']],
        ],
        'sub_url' => '/holds/updateHolds'
    ],
    'settlementHolds' => [
        'field' => [
            'uid' => ['text'=>'用户账号','type'=>'select','readonly'=>true],
            'sid' => ['text'=>'名称','type'=>'select','readonly'=>true],
            'amount' => ['text'=>'GetRich金额','type'=>'input','verify'=>['number']],
            'in_date' => ['text'=>'入账日期','type'=>'date','verify'=>['required'],'value'=>date('Y-m-d')],
        ],
        'sub_url' => '/holds/settlementHolds'
    ],
];
?>