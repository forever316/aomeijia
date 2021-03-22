<?php

namespace App\Http\Controllers\Front;

use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\Link;
use App\Models\Article;
use App\Models\OverseaHouse;
use App\Models\Information;
use App\Models\Migrate;
use App\Models\CompanyBranch;
use App\Models\Enum;
use App\Models\Faqs;
use App\Models\CompanyConfig;
use App\Models\PartnerType;
use App\Models\Partner;
use App\Models\HotSearch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\InvestCountry;

class MigrateController  extends Controller
{
    //显示汇总页
    public function index()
    {
        //公共模块
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();

        //banner图片，类型为11,测试图片，类型为12
        $data['banner_img'] = current(Banner::where('type',11)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        $data['test_img'] = current(Banner::where('type',12)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        //可点击的类型,类型枚举为，从enum表中取出type=7的数据，1房产类型,2房产标签,3房产特色,4移民类型,5移民投资金额,6热门资讯类型,7成功案例类型',
        $data['type'] = array('0'=>'不限') + Enum::where('type',4)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $data['type_invest'] = array('0'=>'不限') + Enum::where('type',5)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();
        //所有的地区列表
        $data['region'] = array('0'=>'不限') + City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $region = isset($_GET['region']) ? $_GET['region'] : 0;
        $country = isset($_GET['country']) ? $_GET['country'] : 0;
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        $type_invest = isset($_GET['type_invest']) ? $_GET['type_invest'] : 0;
        $data['searchInfo'] = ['region'=>$region,'country'=>$country,'type'=>$type,'type_invest'=>$type_invest];
        //主要的全球移民信息
        $query = Migrate::where('status',1)->where('publish_date','<=',$date);
        $data['url'] = '/migrate?1=1';

        $data['country'] = array('0'=>'不限');
        if($region){//有选择地区的话，找出该地区下所有的城市
            $data['url'] .= '&region='.$region;
            $data['country'] = array('0'=>'不限') + City::where('pid',$region)->orderBy('sort','desc')->pluck('name','id')->toArray();
            //有选择国家的话，就查询出该国家下的所有数据，没有选择国家有选择地区的话，就查询出该地区下的所有国家下的数据
            if($country){
                $data['url'] .= '&country='.$country;
                $query = $query->where('city_id',$country);
            }else{
                $query = $query->whereIn('city_id',array_keys($data['country']));
            }
        }
        if($type){
            $data['url'] .= '&type='.$type;
            $query = $query->where('type_id',$type);
        }
        if($type_invest){
            $data['url'] .= '&type_invest='.$type_invest;
            $query = $query->where('invest_id',$type_invest);
        }
        $data['data'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->get()->toArray();

        return view('front.migrate.index',[
            'data' => $data,

        ]);
    }

    /*
     * 全球移民详情页
     */
    public function detail()
    {
        $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : 0;
        //公共模块
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        //banner图片，类型为11,全球移民banner图片
        $data['banner_img'] = current(Banner::where('type',11)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        $data['data'] = current(Migrate::where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray());//当前详情页的本条数据
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
//取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);
        //取出7个最新资讯
        $_infoData = $this->getInfoData();
        $data['info_top'] = $_infoData['info_top'];
        $data['info_inner'] = $_infoData['info_inner'];
        $data['info_right'] = $_infoData['right_top'];
        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        return view('front.migrate.detail', [
            'data' => $data,

        ]);
    }

    /*
     * 全球移民测试页
     */
    public function test()
    {
        //公共模块
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        return view('front.migrate.test', [
            'data' => $data,
        ]);
    }


}