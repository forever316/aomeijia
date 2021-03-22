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

class investCountryController  extends Controller
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

        //所有的地区列表
        $data['region'] = City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $region = isset($_GET['region']) ? $_GET['region'] : current(array_keys($data['region']));//没有选择地区就默认是第一个地区
        $regionName = isset($data['region'][$region]) ? $data['region'][$region] : '';
        $data['searchInfo'] = ['region'=>$region,'region_name'=>$regionName,'areaName'=>$regionName];
        //根据地区找出该地区下所有的城市Information
        $data['country'] = City::where('pid',$region)->orderBy('sort','desc')->pluck('name','id')->toArray();
        //投资攻略的banner图片,类型为10
        $data['banner_img'] = current(Banner::where('type',10)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());


        $countryIds = array_keys($data['country']);
        //5个热门房产项目，房产是在城市的基础上添加的
        $data['house'] = $this->getShowHouseData(5,['city_id'=>$countryIds]);
        //3个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(3,['city_id'=>$countryIds]);
        //取出7个最新资讯
        $_infoData = $this->getInfoData($countryIds);
        $data['info_top'] = $_infoData['info_top'];
        $data['info_inner'] = $_infoData['info_inner'];
        $data['info_right'] = $_infoData['right_top'];


        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['city_id'=>$countryIds,'category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        $cityArr = City::getCityAllData();//所有的城市数组

        $typeData = Enum::getEnumAllData();//得到类型所有数据

        //有选择国家的话，就查询出该国家下的所有数据，没有选择国家有选择地区的话，就查询出该地区下的所有国家下的数据
        $query = InvestCountry::where('status',1)->where('publish_date','<=',$date);
        $query = $query->whereIn('city_id',array_keys($data['country']));
        $data['data'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(6)->get()->toArray();
        foreach($data['data'] as $key=>$val){
            $tagArr = array_filter(explode(';',$val['tag_id']));
            $data['data'][$key]['tag_name'] = array();
            foreach($tagArr as $k=>$v){
                $data['data'][$key]['tag_name'][] = isset($typeData[$v]) && $typeData[$v] ? $typeData[$v] : $v;
            }
            $data['data'][$key]['city_name'] = isset($cityArr[$val['city_id']]) && $cityArr[$val['city_id']] ? $cityArr[$val['city_id']] : $val['city_id'];
        }

        return view('front.invest.country',[
            'data' => $data,

        ]);
    }

    /*
     * 国家投资详情页
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

        $data['data'] = InvestCountry::where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray();//当前详情页的本条数据
        $data['data'] = current($data['data']);
        $city = $data['data']['city_id'];
        $cityInfo = City::where('id',$city)->orderBy('sort','desc')->first()->toArray();
        //投资攻略的banner图片,类型为10
        $data['banner_img'] = current(Banner::where('type',10)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //获取当前地区的信息，此条数据的pid为地区的id
        $regionName = City::where('pid',0)->where('id',$cityInfo['pid'])->orderBy('sort','desc')->first()->toArray();//
        $data['searchInfo'] = ['areaName'=>$cityInfo['name'],'english_name'=>$cityInfo['english_name'],'regionName'=>$regionName['name']];

        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4,['city_id'=>$city]);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4,['city_id'=>$city]);

        //该国家的6个投资问答
        $data['faqs'] = Faqs::where('status',1)->where('city_id',$city)->orderBy('sort','desc')->orderBy('id','desc')->take(6)->get()->toArray();

        //取出7个最新资讯
        $_infoData = $this->getInfoData($city);
        $data['info_top'] = $_infoData['info_top'];
        $data['info_inner'] = $_infoData['info_inner'];
        $data['info_right'] = $_infoData['right_top'];

        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['city_id'=>$city,'category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        return view('front.invest.country_detail', [
            'data' => $data,

        ]);
    }
    /*
     *国家投资攻略详细信息页
     */
    public function detailInfo()
    {
        $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : 0;
        //公共模块
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();

        $data['data'] = InvestCountry::where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray();//当前详情页的本条数据
        $data['data'] = current($data['data']);
        $city = $data['data']['city_id'];
        $cityInfo = City::where('id',$city)->orderBy('sort','desc')->first()->toArray();
        //投资攻略的banner图片,类型为10
        $data['banner_img'] = current(Banner::where('type',10)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //获取当前地区的信息，此条数据的pid为地区的id
        $regionName = City::where('pid',0)->where('id',$cityInfo['pid'])->orderBy('sort','desc')->first()->toArray();//
        $data['searchInfo'] = ['areaName'=>$cityInfo['name'],'english_name'=>$cityInfo['english_name'],'regionName'=>$regionName['name']];

        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4,['city_id'=>$city]);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4,['city_id'=>$city]);

        return view('front.invest.country_detail_info', [
            'data' => $data,

        ]);

    }



}