<?php

return [
    'orderList' => [
        'field' => [
            'source_id' => ['text'=>'订单类型'],
            'order_sn' => ['text'=>'订单编号'],
            'add_time' => ['text'=>'下单日期'],
            'consignee' => ['text'=>'收货人'],
            'goods_amount' => ['text'=>'总金额'],
            'yuanbao_paid' => ['text'=>'宝分支付'],
            'money_paid' => ['text'=>'在线支付'],
            'status' => ['text'=>'订单状态'],
        ],
        'search' => [
            'order_sn' => ['text'=>'订单编号','type'=>'input',],
        //  'order_status' => ['text'=>'订单状态','type'=>'select','value'=>[''=>'所有', '0'=>'未确认','1'=>'已确认','2'=>'已取消','3'=>'无效','4'=>'退货']],
            'order_status' => ['text'=>'订单状态','type'=>'select','value'=>[''=>'所有', '1'=>'待付款','2'=>'待发货','3'=>'待收货','4'=>'退货']],
            'start_time' => ['text'=>'下单开始日期','type'=>'date',],
            'end_time' => ['text'=>'下单结束日期','type'=>'date',],
        ],
        'button' => [
            'update' => '/order/updateOrder',
//            'delete' => '/orderscg/downOrders',
            'customButton'=>[
                [
                    'url'=> '/order/deliverGoodsSet',
                    'path' => 'admin.order.deliver_goods_set'
                ]
            ]
        ],
        'data_url' => '/order/orderList',
    ],
    'updateOrder' => [
        'field' => [
            'order_sn' => ['text'=>'订单编号','type'=>'span'],
            'status' => ['text'=>'订单状态','type'=>'span'],
            'pay_name' => ['text'=>'支付方式','type'=>'span'],
            'add_time' => ['text'=>'下单时间','type'=>'span'],
            'consignee' => ['text'=>'收货人','type'=>'content'],
            'address' => ['text'=>'收货地址','type'=>'span'],
            'mobile' => ['text'=>'收货人联系方式','type'=>'span'],
            'custom' => ['text'=>'自定义','type'=>'custom','value'=>'admin.order.good_list'],
            'postscript' => ['text'=>'订单附言','type'=>'span'],
            'to_buyer' => ['text'=>'给客户的留言','type'=>'textarea'],
        ],
        'sub_url' => '/order/updateOrder'
    ],
    'downOrderList' => [
        'field' => [
            'source_id' => ['text'=>'订单类型'],
            'order_sn' => ['text'=>'订单编号'],
            'add_time' => ['text'=>'下单日期'],
            'store_name' => ['text'=>'商家'],
            'goods_amount' => ['text'=>'总金额'],
            'yuanbao_paid' => ['text'=>'宝分支付'],
            'money_paid' => ['text'=>'在线支付'],
            'plate_amount'=>['text'=>'广告费'],
            'status' => ['text'=>'订单状态'],
        ],
        'search' => [
            'order_sn' => ['text'=>'订单编号','type'=>'input',],
            //  'order_status' => ['text'=>'订单状态','type'=>'select','value'=>[''=>'所有', '0'=>'未确认','1'=>'已确认','2'=>'已取消','3'=>'无效','4'=>'退货']],
            'order_status' => ['text'=>'订单状态','type'=>'select','value'=>[''=>'所有', '0'=>'未付款','2'=>'已付款']],
            'start_time' => ['text'=>'下单开始日期','type'=>'date',],
            'end_time' => ['text'=>'下单结束日期','type'=>'date',],
        ],
        'button' => [
            'see' => '/order/seedownOrder',
//            'delete' => '/orderscg/downOrders',
//            'customButton'=>[
//                [
//                    'url'=> '/order/deliverGoodsSet',
//                    'path' => 'admin.order.deliver_goods_set'
//                ]
//            ]
        ],
        'data_url' => '/order/downOrderList',
    ],
    'seedownOrder' => [
        'field' => [
            'order_sn' => ['text'=>'订单编号','type'=>'span'],
            'status' => ['text'=>'订单状态','type'=>'content'],
            'pay_name' => ['text'=>'支付方式','type'=>'content'],
            'add_time' => ['text'=>'下单时间','type'=>'span'],
            'goods_amount'=>['text'=>'总金额','type'=>'span'],
            'yuanbao_paid'=>['text'=>'元宝支付','type'=>'span'],
            'money_paid'=>['text'=>'付款金额','type'=>'span'],
            'plate_amount'=>['text'=>'广告费','type'=>'span'],
            'nick_name'=>['text'=>'买家昵称','type'=>'span'],
            'store_name'=>['text'=>'商家昵称','type'=>'content'],
//            'sale_phone'=>['text'=>'商家联系方式','type'=>'span'],
//            'sale_address'=>['text'=>'商家地址','type'=>'span'],
            'img' => ['text'=>'店面图片','type'=>'imgs'],
        ],
    ],
];
?>