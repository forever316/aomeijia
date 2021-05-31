<?php

return [
    'houseList' => [
        'field' => [
            'id' => ['text'=>'ID'],
            'city_id' => ['text'=>'城市','options'=>[]],
            'title' => ['text'=>'标题'],
            'unit_price' => ['text'=>'最低单价'],
            'area' => ['text'=>'面积'],
            'house_type' => ['text'=>'户型'],
            'total_price' => ['text'=>'总价'],
            'property_year' => ['text'=>'产权年限'],
            'first_payment' => ['text'=>'首付比例'],
            'year_return' => ['text'=>'年回报率'],
            'sort' => ['text'=>'排序'],
            'status' => ['text'=>'状态','options'=>['1'=>'启用','2'=>'禁用']],
            'created_at' => ['text'=>'创建时间'],
            'updated_at' => ['text'=>'更新时间'],
        ],
        'search' => [
            'id' => ['text'=>'ID','type'=>'input'],
            'title' => ['text'=>'标题','type'=>'input'],
            'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'--请选择--','1'=>'启用','2'=>'禁用']],
        ],
        'button' => [
            'add' => '/house/addHouse',
            'update' => '/house/updateHouse',
            'see' => '/house/seeHouse',
            'delete' => '/house/deleteHouse',
        ],
        'data_url' => '/house/houseList',
    ],
    'addHouse' => [
        'field' => [
            'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'type_id' => ['text'=>'类型','type'=>'select','value'=>[]],
            'feature_id'=>['text'=>'特色','type'=>'select','value'=>[]],
            'price_range_id' => ['text'=>'价格区间','type'=>'select','value'=>[]],
            'tag_id'=>['text'=>'标签','type'=>'checkbox','value'=>[]],
            'images'=>['text'=>'图片','type'=>'imgs','value'=>'','verify'=>['required']],
            'longitude'=>['text'=>'经度','type'=>'input','value'=>''],
            'latitude'=>['text'=>'纬度','type'=>'input','value'=>''],
            'process_img'=>['text'=>'购房流程图片','type'=>'img','value'=>'','verify'=>['required']],
            'unit_price'=>['text'=>'最低单价','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'title'=>['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'describe'=>['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'home_show'=>['text'=>'显示在首页','type'=>'radio','value'=>['1'=>'是','2'=>'否'],'verify'=>['required']],
            'complete_date'=>['text'=>'交房时间','type'=>'input','value'=>'','verify'=>['required']],
            'area'=>['text'=>'面积','type'=>'input','value'=>'','verify'=>['required']],
            'house_type'=>['text'=>'户型','type'=>'input','value'=>'','verify'=>['required']],
            'total_price'=>['text'=>'总价','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'property_year'=>['text'=>'产权年限','type'=>'input','value'=>'','verify'=>['required']],
            'first_payment'=>['text'=>'首付比例','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'year_return'=>['text'=>'年回报率','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'house_standard'=>['text'=>'交房标准','type'=>'input','value'=>'','verify'=>['required']],
            'address'=>['text'=>'项目位置','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','desc'=>'数值越大，排列越靠前'],
            'status'=>['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'watch_number'=>['text'=>'在看人数','type'=>'input','value'=>''],
            'publish_date'=>['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'basic_info'=>['text'=>'基本信息','type'=>'ueditor','value'=>'','verify'=>['required']],
            'main_door'=>['text'=>'主力户型','type'=>'ueditor','value'=>''],
            'surround_facility' => ['text'=>'周边配套','type'=>'ueditor','value'=>''],
            'project_atlas'=>['text'=>'项目图集','type'=>'ueditor','value'=>''],
            'program_feature' => ['text'=>'项目特色','type'=>'ueditor','value'=>''],
            'invest_analysis'=>['text'=>'投资分析','type'=>'ueditor','value'=>''],
        ],
        'sub_url'=>'/house/addHouse',
    ],
    'updateHouse' => [
        'field' => [
            'city_id' => ['text'=>'城市','type'=>'custom','value'=>'admin.common.add_city_ztree','verify'=>['required']],
            'type_id' => ['text'=>'类型','type'=>'select','value'=>[]],
            'feature_id'=>['text'=>'特色','type'=>'select','value'=>[]],
            'price_range_id' => ['text'=>'价格区间','type'=>'select','value'=>[]],
            'tag_id'=>['text'=>'标签','type'=>'checkbox','value'=>[]],
            'images'=>['text'=>'图片','type'=>'imgs','value'=>[],'verify'=>['required']],
            'longitude'=>['text'=>'经度','type'=>'input','value'=>''],
            'latitude'=>['text'=>'纬度','type'=>'input','value'=>''],
            'process_img'=>['text'=>'购房流程图片','type'=>'img','value'=>'','verify'=>['required']],
            'unit_price'=>['text'=>'最低单价','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'title'=>['text'=>'标题','type'=>'input','value'=>'','verify'=>['required']],
            'describe'=>['text'=>'描述','type'=>'input','value'=>'','verify'=>['required']],
            'home_show'=>['text'=>'显示在首页','type'=>'radio','value'=>['1'=>'是','2'=>'否'],'verify'=>['required']],
            'complete_date'=>['text'=>'交房时间','type'=>'input','value'=>'','verify'=>['required']],
            'area'=>['text'=>'面积','type'=>'input','value'=>'','verify'=>['required']],
            'house_type'=>['text'=>'户型','type'=>'input','value'=>'','verify'=>['required']],
            'total_price'=>['text'=>'总价','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'property_year'=>['text'=>'产权年限','type'=>'input','value'=>'','verify'=>['required']],
            'first_payment'=>['text'=>'首付比例','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'year_return'=>['text'=>'年回报率','type'=>'input','value'=>'','verify'=>['required'],'desc'=>'填写数字'],
            'house_standard'=>['text'=>'交房标准','type'=>'input','value'=>'','verify'=>['required']],
            'address'=>['text'=>'项目位置','type'=>'input','value'=>'','verify'=>['required']],
            'sort'=>['text'=>'排序','type'=>'input','value'=>'','desc'=>'数值越大，排列越靠前'],
            'status'=>['text'=>'状态','type'=>'radio','value'=>['1'=>'启用','2'=>'禁用'],'verify'=>['required']],
            'watch_number'=>['text'=>'在看人数','type'=>'input','value'=>''],
            'publish_date'=>['text'=>'发布时间','type'=>'date','value'=>'','verify'=>['required']],
            'basic_info'=>['text'=>'基本信息','type'=>'ueditor','value'=>'','verify'=>['required']],
            'main_door'=>['text'=>'主力户型','type'=>'ueditor','value'=>''],
            'surround_facility' => ['text'=>'周边配套','type'=>'ueditor','value'=>''],
            'project_atlas'=>['text'=>'项目图集','type'=>'ueditor','value'=>''],
            'program_feature' => ['text'=>'项目特色','type'=>'ueditor','value'=>''],
            'invest_analysis'=>['text'=>'投资分析','type'=>'ueditor','value'=>''],
        ],
        'sub_url' => '/house/updateHouse'
    ],
    'seeHouse' => [
        'field' => [
            'id' => ['text'=>'ID','type'=>'span'],
            'city_id' => ['text'=>'城市','type'=>'span'],
            'type_id' => ['text'=>'类型','type'=>'span'],
            'feature_id'=>['text'=>'特色','type'=>'span'],
            'price_range_id' => ['text'=>'价格区间','type'=>'span'],
            'tag_id'=>['text'=>'标签','type'=>'span'],
            'images'=>['text'=>'图片','type'=>'imgs','value'=>[],],
            'longitude'=>['text'=>'经度','type'=>'span'],
            'latitude'=>['text'=>'纬度','type'=>'span'],
            'process_img'=>['text'=>'购房流程图片','type'=>'img'],
            'unit_price'=>['text'=>'最低单价','type'=>'span'],
            'title'=>['text'=>'标题','type'=>'span'],
            'describe'=>['text'=>'描述','type'=>'span'],
            'home_show'=>['text'=>'显示在首页','type'=>'select','value'=>['1'=>'是','2'=>'否']],
            'complete_date'=>['text'=>'交房时间','type'=>'span'],
            'area'=>['text'=>'面积','type'=>'span'],
            'house_type'=>['text'=>'户型','type'=>'span'],
            'total_price'=>['text'=>'总价','type'=>'span'],
            'property_year'=>['text'=>'产权年限','type'=>'span'],
            'first_payment'=>['text'=>'首付比例','type'=>'span'],
            'year_return'=>['text'=>'年回报率','type'=>'span'],
            'house_standard'=>['text'=>'交房标准','type'=>'span'],
            'address'=>['text'=>'项目位置','type'=>'span'],
            'sort'=>['text'=>'排序','type'=>'span'],
            'status'=>['text'=>'状态','type'=>'select','value'=>['1'=>'启用','2'=>'禁用']],
            'watch_number'=>['text'=>'在看人数','type'=>'span'],
            'publish_date'=>['text'=>'发布时间','type'=>'span'],
            'basic_info'=>['text'=>'基本信息','type'=>'content'],
            'main_door'=>['text'=>'主力户型','type'=>'content'],
            'surround_facility' => ['text'=>'周边配套','type'=>'content'],
            'project_atlas'=>['text'=>'项目图集','type'=>'content'],
            'program_feature' => ['text'=>'项目特色','type'=>'content'],
            'invest_analysis'=>['text'=>'投资分析','type'=>'content'],
            'updated_at' => ['text'=>'更新时间','type'=>'span'],
            'created_at' => ['text'=>'创建时间','type'=>'span'],
        ],
    ],
];
?>