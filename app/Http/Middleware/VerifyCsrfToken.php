<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/getCity','/api/aliBaichuan',
        '/api/businessHList','/api/businessTypeList','/api/getStoreAllList','/api/storeDetails','/api/cartOrder','/api/lijiOrder',
        '/api/cartSubOrder','/api/lijiSubOrder','/api/calculationBf','/api/sign','/api/onekeyPayment','/api/oneKeyAlipayNotify',
        '/api/getCompanyConfig','/api/storeSign',
        '/api/oneKeyWeixinNotify','/api/storePayDetail','/api/getStorePayUser','/api/storePaySub','/api/messageList','/api/viewMessage',
        '/api/index','/api/indexGoodsList','/api/register','/api/login','/api/forgetPassword','/api/goodsTypeList','/api/goodsList'
        ,'/api/goodDetail','/api/addCollect','/api/deleteCollect','/api/collectList','/api/addOrUpdateCart','/api/deleteCart','/api/cartList'
        //我的
        ,'/api/my','/api/setPersonal','/api/addAddress','/api/merchantsSettled','/api/editAddress','/api/updateAddress',
        '/api/deleteAddress','/api/defaultAddress','/api/distributor','/api/myIntegral','/api/myUnderlingBusiness',
        '/api/contactCustomer',
        //宝袋
        '/api/treasureBag','/api/myDistributor',
        //修改个人资料
        '/api/setHead','/api/setNickname','/api/setPhone','/api/setSex','/api/setBirthday','/api/setRealName','/api/setIdCard','/api/setBank'
        ,'/api/address','/api/dataList','/api/balance','/api/businessManage','/api/myCollection'
        ,'/api/balanceDetail','/api/storeDetail','/api/cashPassword','/api/withdrawCash','/api/withdrawCashA'
        ,'/api/setCashPassword'
        //订单
        ,'/api/allOrder','/api/unpaid','/api/returnGoods','/api/waitingGoods','/api/receivingGoods','/api/cancelOrder','/api/confirmOrder'
        ,'/api/detailUnpaid','/api/deleteOrder','/api/detailOrder'
        //商家管理
        ,'/api/storeIntegral','/api/storeOrderManage','/api/orderReturn','/api/storeCode','/api/myerweima','/api/test','/api/exchangeIntegralStore'
        //宝分
        ,'/api/setCashPasswordA','/api/putCashPassword','/api/storePutCash','/api/imagesUpdate'
        ,'/api/IntegralAmount','/api/setLoginPassword','/api/setCashPassword','/api/cashIntegral','/api/storeCashIntegral','/api/pay','/alipay_notify','/api/exchangeIntegral','/api/setBankCard'
        ,'/api/offLinePay','/api/storePay','/api/getSignText','/api/sms'
        ,'/api/storeNotPaY','/api/distributorNot'
        //版本升级
        ,'/api/configUpdate'
    ];
}
