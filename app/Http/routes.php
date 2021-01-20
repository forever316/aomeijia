<?php
/**
 * 后台路由
 */
Route::group(['middleware'=>['auth','authority']], function()
{
   //公司资料设置
    Route::match(['get', 'post'], '/shoppingHome/companyConfigSet','Admin\Home\shoppingHomeController@companyConfigSet');

    //首页管理
    Route::match(['get', 'post'], '/shoppingHome/modularList','Admin\Home\shoppingHomeController@modularList');
    Route::match(['get', 'post'], '/shoppingHome/modularAdd','Admin\Home\shoppingHomeController@modularAdd');
    Route::match(['get', 'post'], '/shoppingHome/modularUpdate','Admin\Home\shoppingHomeController@modularUpdate');
    Route::match(['get', 'post'], '/shoppingHome/modularDelete','Admin\Home\shoppingHomeController@modularDelete');

    //部门管理
    Route::match(['get', 'post'], '/department/departmentList','Admin\Authority\DepartmentController@departmentList');
    Route::match(['get', 'post'], '/department/addDepartment','Admin\Authority\DepartmentController@addDepartment');
    Route::match(['get', 'post'], '/department/deleteDepartment','Admin\Authority\DepartmentController@deleteDepartment');
    Route::match(['get', 'post'], '/department/seeDepartment','Admin\Authority\DepartmentController@seeDepartment');
    Route::match(['get', 'post'], '/department/updateDepartment','Admin\Authority\DepartmentController@updateDepartment');
    Route::post('/department/ajaxDepartmentList','Admin\Authority\DepartmentController@ajaxDepartmentList');

    //角色管理
    Route::match(['get', 'post'], '/role/roleList','Admin\Authority\RoleController@roleList');
    Route::match(['get', 'post'], '/role/addRole','Admin\Authority\RoleController@addRole');
    Route::match(['get', 'post'], '/role/updateRole','Admin\Authority\RoleController@updateRole');
    Route::match(['get', 'post'], '/role/seeRole','Admin\Authority\RoleController@seeRole');
    Route::match(['get', 'post'], '/role/deleteRole','Admin\Authority\RoleController@deleteRole');

    //登录退出
    Route::match(['get', 'post'], '/login','Admin\HomeController@authenticate');//登录
    Route::match(['get', 'post'], '/login2','Admin\HomeController@login2');//登录（重新登录）
    Route::get( '/userOut','Admin\HomeController@userOut');//退出

    //用户管理
    Route::match(['get', 'post'], '/user/userList','Admin\UserController@userList');//用户列表
    Route::match(['get', 'post'], '/user/addUser','Admin\UserController@addUser');//增加用户
    Route::match(['get', 'post'], '/user/updateUser','Admin\UserController@updateUser');//修改用户
    Route::match(['get', 'post'], '/user/seeUser','Admin\UserController@seeUser');//查看用户
    Route::match(['get', 'post'], '/user/deleteUser','Admin\UserController@deleteUser');//删除用户
    Route::post( '/user/resetPass','Admin\UserController@resetPass');//重置密码

    //首页
    Route::get('/','Admin\HomeController@index');
    Route::get('/index','Admin\HomeController@index');
    Route::get('/home','Admin\HomeController@home');

    //统计
    Route::get('/finance/rankingList','Admin\HomeController@rankinglist');

    //微信菜单
    Route::any('/publish','/WeChat\WechatMenuController@publishWechatMenu');

    //getrich新添加的菜单
    //商品管理
    Route::match(['get', 'post'], '/stocks/addStocks','Admin\StocksController@addStocks');//增加商品
    Route::match(['get', 'post'], '/stocks/stocksList','Admin\StocksController@stocksList');//商品列表
    Route::match(['get', 'post'], '/stocks/updateStocks','Admin\StocksController@updateStocks');//修改商品
    Route::match(['get', 'post'], '/stocks/deleteStocks','Admin\StocksController@deleteStocks');//删除商品
    Route::match(['get', 'post'], '/stocks/startStocks','Admin\StocksController@startStocks');//启用商品
    Route::match(['get', 'post'], '/stocks/stopStocks','Admin\StocksController@stopStocks');//禁用商品

    //持仓管理
    Route::match(['get', 'post'], '/holds/addHolds','Admin\HoldsController@addHolds');//增加持仓
    Route::match(['get', 'post'], '/holds/holdsList','Admin\HoldsController@holdsList');//持仓列表
    Route::match(['get', 'post'], '/holds/updateHolds','Admin\HoldsController@updateHolds');//修改持仓
    Route::match(['get', 'post'], '/holds/deleteHolds','Admin\HoldsController@deleteHolds');//删除持仓
    Route::match(['get', 'post'], '/holds/settlementHolds','Admin\HoldsController@settlementHolds');//结算持仓
    Route::match(['get', 'post'], '/holds/settleOneHolds','Admin\HoldsController@settleOneHolds');//一元结算

});

//获取图片验证码
Route::get('getCaptcha',['as'=>'getCaptcha','uses'=>'Tools\KitController@captcha']);
//获取图片验证码(登录专用)
Route::get('getCaptcha2',['as'=>'getCaptcha2','uses'=>'Tools\KitController@captcha2']);

//图片上传
Route::post('uploadImg',['as'=>'uploadImg','uses'=>'Tools\UploadController@uploadImg']);

//删除文件
Route::post('deleteFile',['as'=>'deleteFile','uses'=>'Tools\UploadController@deleteFile']);


Route::any('/send','WeChat\WechatController@send');

Route::any('/dhjf/{access_key}/{number}','Client\IntegralController@dhjf');

Route::get( '/wipeCache',function(){
    \Illuminate\Support\Facades\Session::forget('authority');
    \Illuminate\Support\Facades\Session::forget('resources');
    $user = \Illuminate\Support\Facades\Session::get('user');
    \Illuminate\Support\Facades\Session::forget($user->access_key.'tongji');
    return redirect('/');
});//清空缓存
Route::get( '/map',function(){
    return view('admin.map');
});//清空缓存
//Route::get( '/setAuthority','Admin\HomeController@setAuthority');//加入权限

//获取页面
Route::get('/home_modular5','Admin\Home\shoppingHomeController@home_modular5');
Route::get('/home_modular4','Admin\Home\shoppingHomeController@home_modular4');
Route::get('/home_modular2','Admin\Home\shoppingHomeController@home_modular2');


