<?php

return [
    'returnList' => [
        'field' => [
            'order_sn' => ['text'=>'订单编号'],
            'ruturn_reason' => ['text'=>'退货原因'],
            'return_user' => ['text'=>'申请联系人'],
            'return_phone' => ['text'=>'联系方式'],
            'status' => ['text'=>'状态'],
            'created_at' => ['text'=>'申请时间'],
        ],
        'search' => [
            'order_sn' => ['text'=>'订单编号','type'=>'input',],
            'status' => ['text'=>'订单状态','type'=>'select','value'=>[''=>'所有', '-1'=>'待审核 ','1'=>'审核通过','-2'=>'审核失败']],
            'start_time' => ['text'=>'申请开始日期','type'=>'date',],
            'end_time' => ['text'=>'申请结束日期','type'=>'date',],
        ],
        'button' => [
            'update' => '/order/updateReturn',
//            'customButton'=>[
//                [
//                    'url'=> '/order/deliverGoodsSet',
//                    'path' => 'admin.order.deliver_goods_set'
//                ]
//            ]
        ],
        'data_url' => '/order/returnList',
    ],
    'updateReturn' => [
        'field' => [
            'order_sn' => ['text'=>'订单编号','type'=>'span'],
            'status' => ['text'=>'状态','type'=>'span'],
            'ruturn_reason' => ['text'=>'退货理由','type'=>'span'],
            'return_user' => ['text'=>'退货申请人','type'=>'content'],
            'return_phone' => ['text'=>'联系方式','type'=>'content'],

            'bank_name' => ['text'=>'银行名称','type'=>'span'],
            'bank_card_number' => ['text'=>'银行卡号','type'=>'span'],
            'real_name' => ['text'=>'真实姓名','type'=>'span'],
            'id_card_no' => ['text'=>'身份证号码','type'=>'span'],

            'created_at' => ['text'=>'申请时间','type'=>'span'],
            'varify_status' => ['text'=>'是否通过','type'=>'radio','value'=>['1'=>'通过','-2'=>'不通过'],'desc'=>'【审核通过】平台将资金打入客户银行卡'],
        ],
        'sub_url' => '/order/updateReturn'
    ],
];
?>