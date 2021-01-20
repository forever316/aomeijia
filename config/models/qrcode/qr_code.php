<?php



return [
    'goodsQrCodeList' => [
        'field' => [
            'batch' => ['text'=>'批次'],
            'type' => ['text'=>'类型','options'=>['1'=>'经销商','2'=>'师傅','3'=>'普通用户','4'=>'全部']],
            'operation_user' => ['text'=>'操作人'],
            'goods_name' => ['text'=>'商品名称'],
            'integral' => ['text'=>'积分'],
            'integral_number' => ['text'=>'数量'],
            'integral_count' => ['text'=>'积分总和'],
            'stock_id'=>['text'=>'股东'],
            'created_at' => ['text'=>'创建时间'],
        ],
        'search' => [
            'batch' => ['text'=>'批次','type'=>'input'],
            'goods_name' => ['text'=>'商品名称','type'=>'input'],
        ],
        'button' => [
            'add' => '/qrCode/goodsQrCodeAdd',
            'customButton'=>[
                [
                    'url'=>'/qrCode/goodsQrCodeList',
                    'path' => 'admin.qrcode.goods_qr_code_list'
                ],
            ]
        ],
        'data_url' => '/qrCode/goodsQrCodeList'
    ],
    'goodsQrCodeList2' => [
        'field' => [
            'number' => ['text'=>'编号'],
            'batch' => ['text'=>'批次'],
            'type' => ['text'=>'类型','options'=>['1'=>'经销商','2'=>'师傅','3'=>'普通用户','4'=>'全部']],
            'operation_user' => ['text'=>'操作人'],
            'goods_name' => ['text'=>'商品名称'],
            'integral' => ['text'=>'积分'],
            'status' => ['text'=>'状态','options'=>['0'=>'未使用','1'=>'已使用']],
            'user_id' => ['text'=>'获取人编号'],
            'user_nickname' => ['text'=>'获取人昵称'],
            'updated_at' => ['text'=>'更新时间'],
            'created_at' => ['text'=>'创建时间'],
            'stock_id'=>['text'=>'股东'],
        ],
        'search' => [
            'number' => ['text'=>'编号','type'=>'input'],
            'batch' => ['text'=>'批次','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>['3'=>'全部','0'=>'未使用','1'=>'已使用']],
        ],
        'button' => [
            'delete' => '/qrCode/goodsQrCodeDelete',
            'customButton'=>[
                [
                    'url'=>'/qrCode/exportGoodsQrCode',
                    'path' => 'admin.qrcode.export_goods_qr_code'
                ],
            ]
        ],
        'data_url' => '/qrCode/goodsQrCodeList'
    ],
    'goodsQrCodeAdd' => [
        'field' => [
            'type' => ['text'=>'领取人类型','type'=>'span','value'=>'暂无'],
            'batch' => ['text'=>'批次','type'=>'input'],
            'goods_name' => ['text'=>'商品名称','type'=>'input'],
            'integral' => ['text'=>'积分','type'=>'input'],
            'count' => ['text'=>'生成张数','type'=>'input','desc'=>'数值：1至300'],
            'stock_id' => ['text'=>'股东','type'=>'select','value'=>[]],
        ],
        'sub_url'=>'/qrCode/goodsQrCodeAdd',
    ],
];