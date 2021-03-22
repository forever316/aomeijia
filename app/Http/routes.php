<?php
/**
 * 后台路由
 */
Route::group(['domain' => ADMINWEBSITE,'middleware'=>['auth','authority']], function()
{
   //公司资料设置
    Route::match(['get', 'post'], '/home/companyConfigSet','Admin\Home\homeController@companyConfigSet');

    //首页管理
    // Route::match(['get', 'post'], '/shoppingHome/modularList','Admin\Home\shoppingHomeController@modularList');
    // Route::match(['get', 'post'], '/shoppingHome/modularAdd','Admin\Home\shoppingHomeController@modularAdd');
    // Route::match(['get', 'post'], '/shoppingHome/modularUpdate','Admin\Home\shoppingHomeController@modularUpdate');
    // Route::match(['get', 'post'], '/shoppingHome/modularDelete','Admin\Home\shoppingHomeController@modularDelete');

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
    // Route::get('/finance/rankingList','Admin\HomeController@rankinglist');

    //微信菜单
    // Route::any('/publish','/WeChat\WechatMenuController@publishWechatMenu');

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


    //澳美家新添加的菜单
    //banner管理
    Route::match(['get', 'post'], '/banner/addBanner','Admin\BannerController@addBanner');//增加banner
    Route::match(['get', 'post'], '/banner/bannerList','Admin\BannerController@bannerList');//banner列表
    Route::match(['get', 'post'], '/banner/updateBanner','Admin\BannerController@updateBanner');//修改banner
    Route::match(['get', 'post'], '/banner/deleteBanner','Admin\BannerController@deleteBanner');//删除banner
    Route::match(['get', 'post'], '/banner/seeBanner','Admin\BannerController@seeBanner');//查看banner

    Route::match(['get', 'post'], '/banner/bannerTypeList','Admin\BannerController@bannerTypeList');//banner类型列表
    Route::match(['get', 'post'], '/banner/addType','Admin\BannerController@addType');//增加banner类型
    Route::match(['get', 'post'], '/banner/deleteType','Admin\BannerController@deleteType');//删除banner类型
    Route::match(['get', 'post'], '/banner/seeType','Admin\BannerController@seeType');//查看banner类型
    Route::match(['get', 'post'], '/banner/updateType','Admin\BannerController@updateType');//修改banner类型

    //城市管理
    Route::match(['get', 'post'], '/city/cityList','Admin\CityController@cityList');
    Route::match(['get', 'post'], '/city/cityAdd','Admin\CityController@cityAdd');
    Route::match(['get', 'post'], '/city/cityUpdate','Admin\CityController@cityUpdate');
    Route::match(['get', 'post'], '/city/cityDelete','Admin\CityController@cityDelete');
    Route::post('/city/ajaxcityList','Admin\CityController@ajaxcityList');

    //文章管理
    Route::match(['get', 'post'], '/article/addArticle','Admin\ArticleController@addArticle');//增加文章
    Route::match(['get', 'post'], '/article/articleList','Admin\ArticleController@articleList');//文章列表
    Route::match(['get', 'post'], '/article/updateArticle','Admin\ArticleController@updateArticle');//修改文章
    Route::match(['get', 'post'], '/article/deleteArticle','Admin\ArticleController@deleteArticle');//删除文章
    Route::match(['get', 'post'], '/article/seeArticle','Admin\ArticleController@seeArticle');//查看文章

    //链接管理
    Route::match(['get', 'post'], '/link/linkTypeList','Admin\LinkController@linkTypeList');//链接类型列表
    Route::match(['get', 'post'], '/link/addLink','Admin\LinkController@addLink');//添加链接
    Route::match(['get', 'post'], '/link/linkList','Admin\LinkController@linkList');//链接列表
    Route::match(['get', 'post'], '/link/updateLink','Admin\LinkController@updateLink');//更新链接
    Route::match(['get', 'post'], '/link/deleteLink','Admin\LinkController@deleteLink');//删除链接
    Route::match(['get', 'post'], '/link/seeLink','Admin\LinkController@seeLink');//查看链接

    //合作伙伴类型管理
    Route::match(['get', 'post'], '/partner/partnerTypeList','Admin\PartnerController@partnerTypeList');//合作伙伴类型列表
    Route::match(['get', 'post'], '/partner/addPartnerType','Admin\PartnerController@addPartnerType');//添加合作伙伴类型
    Route::match(['get', 'post'], '/partner/updatePartnerType','Admin\PartnerController@updatePartnerType');//更新合作伙伴类型

    //合作伙伴管理
    Route::match(['get', 'post'], '/partner/addPartner','Admin\PartnerController@addPartner');//添加合作伙伴
    Route::match(['get', 'post'], '/partner/partnerList','Admin\PartnerController@partnerList');//合作伙伴列表
    Route::match(['get', 'post'], '/partner/updatePartner','Admin\PartnerController@updatePartner');//更新合作伙伴
    Route::match(['get', 'post'], '/partner/deletePartner','Admin\PartnerController@deletePartner');//删除合作伙伴
    Route::match(['get', 'post'], '/partner/seePartner','Admin\PartnerController@seePartner');//查看合作伙伴

    //团队成员管理
    Route::match(['get', 'post'], '/teamMember/addTeamMember','Admin\TeamMemberController@addTeamMember');//添加团队成员
    Route::match(['get', 'post'], '/teamMember/teamMemberList','Admin\TeamMemberController@teamMemberList');//团队成员列表
    Route::match(['get', 'post'], '/teamMember/updateTeamMember','Admin\TeamMemberController@updateTeamMember');//更新团队成员
    Route::match(['get', 'post'], '/teamMember/deleteTeamMember','Admin\TeamMemberController@deleteTeamMember');//删除团队成员
    Route::match(['get', 'post'], '/teamMember/seeTeamMember','Admin\TeamMemberController@seeTeamMember');//查看团队成员

    //热门搜索词管理
    Route::match(['get', 'post'], '/hotsearch/addHotsearch','Admin\HotSearchController@addHotsearch');//添加热门搜索词
    Route::match(['get', 'post'], '/hotsearch/hotsearchList','Admin\HotSearchController@hotsearchList');//热门搜索词列表
    Route::match(['get', 'post'], '/hotsearch/updateHotsearch','Admin\HotSearchController@updateHotsearch');//更新热门搜索词
    Route::match(['get', 'post'], '/hotsearch/deleteHotsearch','Admin\HotSearchController@deleteHotsearch');//删除热门搜索词
    Route::match(['get', 'post'], '/hotsearch/seeHotsearch','Admin\HotSearchController@seeHotsearch');//查看热门搜索词

    //客户咨询管理
    Route::match(['get', 'post'], '/customerConsult/customerConsultList','Admin\CustomerConsultController@customerConsultList');//客户咨询列表
    Route::match(['get', 'post'], '/customerConsult/seeCustomerConsult','Admin\CustomerConsultController@seeCustomerConsult');//查看客户咨询

    //标签管理
    Route::match(['get', 'post'], '/tag/tagList','Admin\TagController@tagList');//标签列表
    Route::match(['get', 'post'], '/tag/addTag','Admin\TagController@addTag');//添加标签
    Route::match(['get', 'post'], '/tag/updateTag','Admin\TagController@updateTag');//更新标签
    Route::match(['get', 'post'], '/tag/deleteTag','Admin\TagController@deleteTag');//删除标签
    Route::match(['get', 'post'], '/tag/seeTag','Admin\TagController@seeTag');//查看标签

    //枚举管理
    Route::match(['get', 'post'], '/enum/enumList','Admin\EnumController@enumList');//枚举列表
    Route::match(['get', 'post'], '/enum/addEnum','Admin\EnumController@addEnum');//添加枚举
    Route::match(['get', 'post'], '/enum/updateEnum','Admin\EnumController@updateEnum');//更新枚举
    Route::match(['get', 'post'], '/enum/seeEnum','Admin\EnumController@seeEnum');//查看枚举

    //海外房产管理
    Route::match(['get', 'post'], '/house/houseList','Admin\OverseaHouseController@houseList');//海外房产列表
    Route::match(['get', 'post'], '/house/addHouse','Admin\OverseaHouseController@addHouse');//添加海外房产
    Route::match(['get', 'post'], '/house/updateHouse','Admin\OverseaHouseController@updateHouse');//更新海外房产
    Route::match(['get', 'post'], '/house/deleteHouse','Admin\OverseaHouseController@deleteHouse');//删除海外房产
    Route::match(['get', 'post'], '/house/seeHouse','Admin\OverseaHouseController@seeHouse');//查看海外房产

	//信息管理,热门资讯category=1,成功案例category=2
	Route::match(['get', 'post'], '/information/informationList','Admin\InformationController@informationList');//热点资讯列表
	Route::match(['get', 'post'], '/information/addInformation','Admin\InformationController@addInformation');//添加热点资讯
	Route::match(['get', 'post'], '/information/updateInformation','Admin\InformationController@updateInformation');//更新热点资讯
	Route::match(['get', 'post'], '/information/deleteInformation','Admin\InformationController@deleteInformation');//删除热点资讯
	Route::match(['get', 'post'], '/information/seeInformation','Admin\InformationController@seeInformation');//查看热点资讯


	/*
    *投资攻略
    */

	// //成功案例,删除和查看同热点资讯
 //    Route::match(['get', 'post'], '/information/caseInformationList','Admin\InformationController@caseInformationList');//成功案例列表
 //    Route::match(['get', 'post'], '/information/addCaseInformation','Admin\InformationController@addCaseInformation');//添加成功案例
 //    Route::match(['get', 'post'], '/information/updateCaseInformation','Admin\InformationController@updateCaseInformation');//更新成功案例
 //    Route::match(['get', 'post'], '/information/deleteCaseInformation','Admin\InformationController@deleteInformation');//删除成功案例
 //    Route::match(['get', 'post'], '/information/seeCaseInformation','Admin\InformationController@seeInformation');//查看成功案例

    //投资问答管理
    Route::match(['get', 'post'], '/faqs/faqsList','Admin\FaqsController@faqsList');//投资问答列表
    Route::match(['get', 'post'], '/faqs/addFaqs','Admin\FaqsController@addFaqs');//添加投资问答
    Route::match(['get', 'post'], '/faqs/updateFaqs','Admin\FaqsController@updateFaqs');//更新投资问答
    Route::match(['get', 'post'], '/faqs/deleteFaqs','Admin\FaqsController@deleteFaqs');//删除投资问答
    Route::match(['get', 'post'], '/faqs/seeFaqs','Admin\FaqsController@seeFaqs');//查看投资问答

    //国家攻略管理
    Route::match(['get', 'post'], '/investCountry/investCountryList','Admin\InvestCountryController@investCountryList');//国家攻略列表
    Route::match(['get', 'post'], '/investCountry/addInvestCountry','Admin\InvestCountryController@addInvestCountry');//添加国家攻略
    Route::match(['get', 'post'], '/investCountry/updateInvestCountry','Admin\InvestCountryController@updateInvestCountry');//更新国家攻略
    Route::match(['get', 'post'], '/investCountry/deleteInvestCountry','Admin\InvestCountryController@deleteInvestCountry');//删除国家攻略
    Route::match(['get', 'post'], '/investCountry/seeInvestCountry','Admin\InvestCountryController@seeInvestCountry');//查看国家攻略


    /*
    * 全球移民
    */
    //移民测试管理
    Route::match(['get', 'post'], '/migrateTest/migrateTestList','Admin\MigrateTestController@migrateTestList');//移民测试列表
    Route::match(['get', 'post'], '/migrateTest/seeMigrateTest','Admin\MigrateTestController@seeMigrateTest');//查看移民测试

    //全球移民管理
    Route::match(['get', 'post'], '/migrate/migrateList','Admin\MigrateController@migrateList');//全球移民列表
    Route::match(['get', 'post'], '/migrate/addMigrate','Admin\MigrateController@addMigrate');//添加全球移民
    Route::match(['get', 'post'], '/migrate/updateMigrate','Admin\MigrateController@updateMigrate');//更新全球移民
    Route::match(['get', 'post'], '/migrate/deleteMigrate','Admin\MigrateController@deleteMigrate');//删除全球移民
    Route::match(['get', 'post'], '/migrate/seeMigrate','Admin\MigrateController@seeMigrate');//查看全球移民

    //分公司地址管理
    Route::match(['get', 'post'], '/companyBranch/list','Admin\CompanyBranchController@list');//分公司地址列表
    Route::match(['get', 'post'], '/companyBranch/add','Admin\CompanyBranchController@add');//添加分公司地址
    Route::match(['get', 'post'], '/companyBranch/update','Admin\CompanyBranchController@update');//更新分公司地址
    Route::match(['get', 'post'], '/companyBranch/delete','Admin\CompanyBranchController@delete');//删除分公司地址

    //展会活动管理
    Route::match(['get', 'post'], '/active/list','Admin\ActiveController@list');//展会活动列表
    Route::match(['get', 'post'], '/active/add','Admin\ActiveController@add');//添加展会活动
    Route::match(['get', 'post'], '/active/update','Admin\ActiveController@update');//更新展会活动
    Route::match(['get', 'post'], '/active/delete','Admin\ActiveController@delete');//删除展会活动
    Route::match(['get', 'post'], '/active/see','Admin\ActiveController@see');//查看展会活动

});

/**
 * 前台路由
 */
Route::group(['domain' => FRONTWEBSITE,'middleware' => 'access'], function()//,'middleware'=>['wxOAuth']
{
    //首页
    Route::get('/','Front\HomeController@index');

    //集团简介
    Route::get('/corp/corpBrief','Front\CorpController@corpBrief');
    Route::get('/article','Front\ArticleController@detail');//文章详情页

    //百科资讯
    Route::get('/information','Front\InformationController@index');//百科资讯汇总页
    Route::get('/information/detail','Front\InformationController@detail');//百科资讯详情页

    //全球移民
    Route::get('/migrate','Front\MigrateController@index');//全球移民汇总页
    Route::get('/migrate/detail','Front\MigrateController@detail');//全球移民详情页
    Route::get('/migrate/test','Front\MigrateController@test');//全球移民测试页

    //海外房产
    Route::get('/house','Front\HouseController@index');//全球移民汇总页
    Route::get('/house/detail','Front\HouseController@detail');//全球移民详情页


    //投资攻略
    Route::get('/invest/country','Front\investCountryController@index');//国家投资攻略汇总页
    Route::get('/invest/country/detail','Front\investCountryController@detail');//国家投资攻略详情页
    Route::get('/invest/country/detailInfo','Front\investCountryController@detailInfo');//国家投资攻略详细信息页
    Route::get('/invest/theme','Front\investThemeController@index');//投资主题汇总页
    Route::get('/invest/theme/detail','Front\investThemeController@detail');//投资主题详情页
    Route::get('/invest/faqs','Front\investFaqsController@index');//投资主题汇总页//投资问答faqs
    Route::get('/invest/case','Front\investCaseController@index');//投资主题汇总页
    Route::get('/invest/case/detail','Front\investCaseController@detail');//投资主题详情页


    
});









///////////////////////////////////////////////////////////////
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
    // \Illuminate\Support\Facades\Session::forget($user->access_key.'tongji');
    return redirect('/');
});//清空缓存
Route::get( '/map',function(){
    return view('admin.map');
});//清空缓存
//Route::get( '/setAuthority','Admin\HomeController@setAuthority');//加入权限

//获取页面
Route::get('/home_modular5','Admin\Home\homeController@home_modular5');
Route::get('/home_modular4','Admin\Home\homeController@home_modular4');
Route::get('/home_modular2','Admin\Home\homeController@home_modular2');


