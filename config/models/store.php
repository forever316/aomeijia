<?php

return [
    'storeList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'name' => ['text'=>'商家名称'],
            'address' => ['text'=>'地址'],
            'phone' => ['text'=>'电话'],
            'status' => ['text'=>'状态'],
        ],
        'search' => [
            'name' => ['text'=>'商家名称','type'=>'input'],
            'phone' => ['text'=>'手机号','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择状态--',   '-1'=>'待审核',
                '1'=>'营业中',
                '-2'=>'审核失败',
                '2'=>'停止营业']],
        ],
        'button' => [
            'add' => '/addStore',
            'update' => '/updateStore',
            'see' => '/seeStore',
//            'customButton'=>[
//                [
//                    'url'=>'/user/resetPass',
//                    'path' => 'admin.user.resetPasswordBtn'
//                ]
//            ]
        ],
        'data_url'=>'/storeList'
    ],
    'updateStore' => [
        'field' => [
            'distributor_num' => ['text'=>'渠道商编号','type'=>'span'],
            'type_id' => ['text'=>'商家类型','type'=>'custom','value'=>'admin.goods.add_goods_ztree'],
            'name' => ['text'=>'店铺名称','type'=>'input','value'=>'','verify'=>['required']],
             'map' => ['text'=>'商家位置','type'=>'custom','value'=>'admin.map'],
//            'address' => ['text'=>'店铺地址','type'=>'input','value'=>'','verify'=>['required']],
            'store_img' => ['text'=>'店面图片','type'=>'imgs','value'=>[],'verify'=>['required']],
            'business_licence' => ['text'=>'营业执照','type'=>'imgs','value'=>'','verify'=>['required']],
            'bank_name' => ['text'=>'银行名称','type'=>'input','value'=>'','verify'=>['required']],
            'bank_num' => ['text'=>'银行卡号','type'=>'input','value'=>'','verify'=>['required']],
            'contact' => ['text'=>'联系人','type'=>'input','value'=>'','verify'=>['required']],
            'phone' => ['text'=>'手机号','type'=>'input','value'=>'','verify'=>['required']],
            'idcard_positive_img' => ['text'=>'身份证正反面照','type'=>'imgs','value'=>[],'verify'=>['required']],
            'idcard_img' => ['text'=>'手持身份证照','type'=>'img','value'=>[],'verify'=>['required']],
            'commitment_img' => ['text'=>'承诺书','type'=>'img','value'=>[],'verify'=>['required']],
            'main_business' => ['text'=>'主营业务','type'=>'input','value'=>'','verify'=>['required']],
            'business_hours' => ['text'=>'营业时间','type'=>'input','value'=>'','verify'=>['required']],
            'custom' => ['text'=>'自定义','type'=>'custom','value'=>'admin.store_order'],
            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'审核成功','-2'=>'审核失败'],'verify'=>['required']],
            'varify_content' => ['text'=>'审核备注','type'=>'textarea','value'=>''],
            'add_time' => ['text'=>'申请时间','type'=>'span','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/updateStore'
    ],

    'addStore' => [
        'field' => [
            'user_phone' => ['text'=>'用户手机号','type'=>'input','value'=>'','verify'=>['required']],
            'distributor_num' => ['text'=>'渠道商编号','type'=>'input','value'=>'','verify'=>['required']],
            'type_id' => ['text'=>'商家类型','type'=>'custom','value'=>'admin.goods.add_goods_ztree'],
            'name' => ['text'=>'店铺名称','type'=>'input','value'=>'','verify'=>['required']],
            'map' => ['text'=>'商家位置','type'=>'custom','value'=>'admin.map'],
//            'address' => ['text'=>'店铺地址','type'=>'input','value'=>'','verify'=>['required']],
            'store_img' => ['text'=>'店面图片','type'=>'imgs','value'=>[],'verify'=>['required']],
            'business_licence' => ['text'=>'营业执照','type'=>'imgs','value'=>'','verify'=>['required']],
            'bank_name' => ['text'=>'银行名称','type'=>'input','value'=>'','verify'=>['required']],
            'bank_num' => ['text'=>'银行卡号','type'=>'input','value'=>'','verify'=>['required']],
            'contact' => ['text'=>'联系人','type'=>'input','value'=>'','verify'=>['required']],
            'phone' => ['text'=>'手机号','type'=>'input','value'=>'','verify'=>['required']],
            'idcard_positive_img' => ['text'=>'身份证正面照','type'=>'imgs','value'=>[],'verify'=>['required']],
            'idcard_img' => ['text'=>'身份证反面照','type'=>'img','value'=>[],'verify'=>['required']],
            'commitment_img' => ['text'=>'承诺书','type'=>'img','value'=>[],'verify'=>['required']],
            'main_business' => ['text'=>'主营业务','type'=>'input','value'=>'','verify'=>['required']],
            'business_hours' => ['text'=>'营业时间','type'=>'input','value'=>'','verify'=>['required']],
//            'custom' => ['text'=>'自定义','type'=>'custom','value'=>'admin.store_order'],
//            'status' => ['text'=>'状态','type'=>'radio','value'=>['1'=>'审核成功','-2'=>'审核失败'],'verify'=>['required']],
//            'varify_content' => ['text'=>'审核备注','type'=>'textarea','value'=>''],
//            'add_time' => ['text'=>'申请时间','type'=>'span','value'=>'','verify'=>['required']],
        ],
        'sub_url' => '/addStore'
    ],


    'seeStore' => [
        'field' => [
            'distributor_num' => ['text'=>'渠道商编号','type'=>'span'],
            'name' => ['text'=>'店铺名称','type'=>'span'],
            'address' => ['text'=>'店铺地址','type'=>'span'],
            'store_img' => ['text'=>'店面图片','type'=>'imgs',],
            'business_licence' => ['text'=>'营业执照','type'=>'imgs'],
            'bank_num' => ['text'=>'银行卡号','type'=>'span'],
            'contact' => ['text'=>'联系人','type'=>'span'],
            'phone' => ['text'=>'手机号','type'=>'span'],
            'idcard_positive_img' => ['text'=>'身份证正面照','type'=>'imgs'],
            'idcard_img' => ['text'=>'手持身份证照','type'=>'img'],
            'commitment_img' => ['text'=>'承诺书','type'=>'img',],
            'status' => ['text'=>'状态','type'=>'span'],
            'varify_content' => ['text'=>'审核备注','type'=>'span'],
            'main_business' => ['text'=>'主营业务','type'=>'span'],
            'business_hours' => ['text'=>'营业时间','type'=>'span'],
            'achievement' => ['text'=>'业绩','type'=>'span'],
            'plate_amount' => ['text'=>'平台广告费','type'=>'span'],
            'treasure_num' => ['text'=>'宝袋数','type'=>'span'],
            'bonus_integral' => ['text'=>'总奖励宝分','type'=>'span'],
            'add_time' => ['text'=>'申请时间','type'=>'span','value'=>'','verify'=>['required']],
        ],
    ],
];
?>