<?php

namespace App\Http\Controllers\Front;

use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\Link;
use App\Models\CompanyConfig;
use App\Models\PartnerType;
use App\Models\Partner;
use App\Models\Enum;
use App\Models\Information;
// use App\Models\Link;
use App\Models\Migrate;
use App\Models\OverseaHouse;
use App\Models\TeamMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HomeController  extends Controller
{
    //显示首页
    public function index()
    {
        $date = date('Y-m-d');
        //头部banner
        $data['topBanner'] = Banner::where('type',1)->where('status',1)->orderBy('sort','desc')->take(3)->get()->toArray();
        //首页服务图片,1张图片
        $data['serviceBanner'] = Banner::where('type',2)->where('status',1)->orderBy('sort','desc')->first();
        if($data['serviceBanner']){
            $data['serviceBanner'] = $data['serviceBanner']->toArray();
        }
        //城市的三级联动
        $cityList = City::orderBy('sort','desc')->get();
        $data['cityList'] = array();
        if($cityList){
            $data['cityList'] = $this->build_tree($cityList->toArray(),0);
        }
        //公司资料设置
        $data['company'] = CompanyConfig::where('id',1)->first()->toArray();


        //热门资讯类型和热门资讯//enum=6为热门资讯类型
        $data['infoType'] = Enum::where('type',6)->where('status',1)->orderBy('sort','desc')->get()->toArray();
        if($data['infoType'] && $data['infoType'][0]){
            //默认只显示第一个类型的热门资讯，其他类型的热门资讯根据ajax点击请求数据获得
            $type = $data['infoType'][0]['type'];
            $data['info'] = Information::where('category',1)->where('type_id',$type)->where('status',1)->where('publish_date','>=',$date)->orderBy('sort','desc')->take(12)->get()->toArray();//两条大数据加10条10个标题
        }else{
            $data['info'] = array();
        }

        //热门资讯下面的滚动的微信文章链接Link,type=5
        $data['wxbgBanner'] = Banner::where('type',6)->where('status',1)->orderBy('sort','desc')->first();
        if($data['wxbgBanner']){
            $data['wxbgBanner'] = $data['wxbgBanner']->toArray();
        }

        $data['wechat'] = Link::where('type',5)->where('status',1)->orderBy('sort','desc')->take(20)->get()->toArray();
        //热门展会下方的4张图片
        $data['middleBanner'] = Banner::where('type',7)->where('status',1)->orderBy('sort','desc')->take(4)->get()->toArray();

        //热点项目推荐为海外房产，显示8条数据
        $data['house'] = OverseaHouse::where('home_show',1)->where('status',1)->where('publish_date','>=',$date)->orderBy('sort','desc')->take(8)->get()->toArray();
        //海外移民，显示6条数据
        $data['house'] = Migrate::where('status',1)->where('publish_date','>=',$date)->orderBy('sort','desc')->take(6)->get()->toArray();
        //成功案例，显示5条数据
        $data['case'] = Information::where('category',2)->where('status',1)->where('publish_date','>=',$date)->orderBy('sort','desc')->take(5)->get()->toArray();
         //专业团队，显示前5个
        $data['member'] = TeamMember::where('status',1)->orderBy('sort','desc')->take(5)->get()->toArray();
        //专业售前售后服务，banner Type=4
        $data['bottomBanner'] = Banner::where('type',4)->where('status',1)->orderBy('sort','desc')->take(6)->get()->toArray();

        //合作伙伴
        $_partnerData = Partner::where('status',1)->orderBy('sort','desc')->get()->toArray();
        $partnerType = PartnerType::where('status',1)->orderBy('sort','desc')->get()->toArray();
        $partnerData = array();
        foreach($partnerType as $key=>$val){
            $partnerData[$val['id']]['typeName'] = $val['name'];
            $partnerData[$val['id']]['class'] = '';
            if($key==0){
                $partnerData[$val['id']]['class'] = 'active';//默认显示第一个
            }
            foreach($_partnerData as $kk=>$vv){
                if($val['id']==$vv['type']){
                    $partnerData[$val['id']]['partner'][] = $vv;
                }
            }
        }
        $data['partnerData'] = $partnerData;

        //友情链接
        $data['linkData'] = $this->getLinkData();
        
        return view('front.home',[
            'title' => '首页',
            'data' => $data,
            
        ]);
    }


}