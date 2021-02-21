<?php
/**
 * Created by PhpStorm.
 * User: wlf
 * Date: 2020/11/17
 * Time: 13:55
 */

return [
    'bannerManage'=>[
        'ico' => 'fa fa-picture-o',
        'title' => 'Banner管理',
        'menu' => [
            'bannerTypeManage' => ['title' => 'Banner类型管理','url' => '/banner/bannerTypeList'],
            'bannerManage' => ['title' => 'Banner管理','url' => '/banner/bannerList'],
        ],
        'resources' => [
            '/banner/bannerTypeList' => 'Banner类型列表',
            '/banner/addType' => '增加Banner类型',
            '/banner/updateType' => '修改Banner类型',
            '/banner/seeType' => '查看Banner类型',
            '/banner/deleteType' => '删除Banner类型',

            '/banner/bannerList' => 'Banner列表',
            '/banner/addBanner' => '增加Banner',
            '/banner/updateBanner' => '修改Banner',
            '/banner/seeBanner' => '查看Banner',
            '/banner/deleteBanner' => '删除Banner',
        ]
    ],
    'GoodsManage'=>[
        'ico' => 'glyphicon glyphicon-gift',
        'title' => '商品管理',
        'menu' => [
            'goodsTypeManage' => ['title' => '商品类型管理','url' => '/goodsType/goodsTypeList'],
            'goodsManage' => ['title' => '商品管理','url' => '/goods/goodsList'],
        ],
        'resources' => [
            '/goodsType/goodsTypeList' => '商品类型列表',
            '/goodsType/goodsTypeAdd' => '增加商品类型',
            '/goodsType/goodsTypeUpdate' => '修改商品类型',
            '/goodsType/goodsTypeDelete' => '删除商品类型',
            '/goodsType/ajaxGoodsTypeList' => '获取商品类型列表（必选权限）',

            '/goods/goodsList' => '商品列表',
            '/goods/goodsAdd' => '增加商品',
            '/goods/goodsUpdate' => '修改商品',
            '/goods/goodsDetail' => '查看商品',
            '/goods/goodsDelete' => '删除商品',
        ]
    ],
    'wechatConfigManage'=>[
        'ico' => 'glyphicon glyphicon-fire',
        'title' => '微信管理',
        'menu' => [
            'wechatConfigManage' => ['title' => '配置管理','url' => '/wechatConfig/wechatConfigList'],
        ],
        'resources' => [
            '/wechatConfig/wechatConfigList' => '配置列表',
            '/wechatConfig/updateWechatConfig' => '编辑配置',
            '/wechatConfig/seeWechatConfig'=>'查看配置',
            '/wechatConfig/seeToken' => '菜单列表',

           '/wechatMenu/wechatMenuList'=>'菜单列表',//配置列表
            '/wechatMenu/addWechatMenu'=>'添加菜单',
            '/wechatMenu/updateWechatMenu' =>'更新菜单',
            'wechatMenu/seeWechatMenu'=>'查看菜单',
            '/wechatMenu/deleteWechatMenu'=>'删除菜单',
            '/wechatMenu/publish'=>'发布菜单'
        ]
    ],
    'systemManage'=>[
        'ico' => 'glyphicon glyphicon-cog',
        'title' => '系统管理',
        'menu' => [
            'adminManage' => ['title' => '管理员管理','url' => '/user/userList'],
            'deptManage' => ['title' => '部门管理','url' => '/department/departmentList'],
            'roleManage' => ['title' => '角色管理','url' => '/role/roleList'],
        ],
        'resources' => [
            '/user/userList' => '管理员列表',
            '/user/addUser' => '增加管理员',
            '/user/updateUser' => '修改管理员',
            '/user/seeUser' => '查看管理员',
            '/user/deleteUser' => '删除管理员',
            '/user/resetPass' => '重置密码',

            '/department/departmentList' => '部门列表',
            '/department/addDepartment' => '增加部门',
            '/department/updateDepartment' => '修改部门',
            '/department/seeDepartment' => '查看部门',
            '/department/deleteDepartment' => '删除部门',
            '/department/ajaxDepartmentList' => '获取部门列表（管理员管理跟部门管理有添加修改权限必选）',

            '/role/roleList' => '角色列表',
            '/role/addRole' => '增加角色',
            '/role/updateRole' => '修改角色',
            '/role/seeRole' => '查看角色',
            '/role/deleteRole' => '删除角色',
        ]
    ],
];