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

class HouseController  extends Controller
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

        //取出7个最新资讯
        $_infoData = $this->getInfoData();
        $data['info_top'] = $_infoData['info_top'];
        $data['info_inner'] = $_infoData['info_inner'];
        $data['info_right'] = $_infoData['info_right'];
        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);
        //海外房产的热门搜索词，搜索词类型，1投资主题,2海外房产,3成功案例,4百科资讯',，取出前三条
        $data['search'] = HotSearch::where('type',2)->where('status',1)->orderBy('sort','desc')->pluck('words','id')->take(3)->toArray();

        //banner图片，海外房地产的banner图片是type=3
        $data['banner_img'] = current(Banner::where('type',3)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        //可点击的类型,类型枚举为，从enum表中取出type=1的数据，1房产类型,2房产标签,3房产特色,4移民类型,5移民投资金额,6热门资讯类型,7成功案例类型',10价格范围区间
        $data['type'] = array('0'=>'不限') + Enum::where('type',1)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $data['feature'] = array('0'=>'不限') + Enum::where('type',3)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $data['price'] = array('0'=>'不限') + Enum::where('type',10)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();

        //搜索的参数
        $region = isset($_GET['region']) ? $_GET['region'] : 0;
        $country = isset($_GET['country']) ? $_GET['country'] : 0;
        $city = isset($_GET['city']) ? $_GET['city'] : 0;
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        $feature = isset($_GET['feature']) ? $_GET['feature'] : 0;
        $price = isset($_GET['price']) ? $_GET['price'] : 0;
        $words = isset($_GET['words']) ? $_GET['words'] : 0;

        //所有的地区列表
        $data['region'] = array('0'=>'不限') + City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();

        $data['searchInfo'] = ['region'=>$region,'country'=>$country,'city'=>$city,'type'=>$type,'feature'=>$feature,'price'=>$price,'words'=>$words];
        //主要的全球移民信息
        $query = OverseaHouse::where('status',1)->where('publish_date','<=',$date);
        $data['url'] = '/house?1=1';

        $data['country'] = $data['city'] = array('0'=>'不限');
        if($region){//有选择地区的话，找出该地区下所有的国家
            $data['url'] .= '&region='.$region;
            $data['country'] = array('0'=>'不限') + City::where('pid',$region)->orderBy('sort','desc')->pluck('name','id')->toArray();
            $countryIds = array_keys($data['country']);
            //有选择国家的话，就查询出该国家下的所有数据，没有选择国家有选择地区的话，就查询出该地区下的所有国家下的数据
            if($country){//有选择国家的话，找出该国家下所有的城市
                $countryIds = [$country];
                $data['url'] .= '&country='.$country;
            }
            //根据该地区下的所有国家或者已经选定的国家，找出这些国家下所有的城市
            $data['city'] = array('0'=>'不限') + City::whereIn('pid',$countryIds)->orderBy('sort','desc')->pluck('name','id')->toArray();
            if($city){
                $query = $query->where('city_id',$city);
                $data['url'] .= '&city='.$city;
            }else{
                $query = $query->whereIn('city_id',array_keys($data['city']));
            }
            if(empty($country)){
                $data['city'] = array('0'=>'不限');
            }
        }
        if($type){
            $data['url'] .= '&type='.$type;
            $query = $query->where('type_id',$type);
        }
        if($feature){
            $data['url'] .= '&feature='.$feature;
            $query = $query->where('feature_id',$feature);
        }
        if($price){
            $data['url'] .= '&price='.$price;
            $query = $query->where('price_range_id',$price);
        }
        if($words){
            $query = $query->where(function ($query) use ($words)  {
                $query->where('title','like','%'.$words.'%')
                    ->orwhere('describe', 'like','%'.$words.'%');
            });
            $data['url'] .= '&words='.$words;
        }

        $data['data'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->paginate(10);
        $cityData = City::getCityAllData();//得到城市所有数据
        $typeData = Enum::getEnumAllData();//得到类型所有数据
        foreach($data['data'] as $key=>$val){
            $imgArr = array_filter(explode(';',$val['images']));
            $data['data'][$key]['img'] = $imgArr ? current($imgArr) : '';
            $city_parent = City::where('id',$val['city_id'])->first();
            $data['data'][$key]['country_name'] = isset($cityData[$city_parent->pid]) ? $cityData[$city_parent->pid] : $city_parent->pid;
            $data['data'][$key]['city_name'] = isset($cityData[$val['city_id']]) ? $cityData[$val['city_id']] : $val['city_id'];
            $data['data'][$key]['type_name'] = isset($typeData[$val['type_id']]) ? $typeData[$val['type_id']] : $val['type_id'];
            $tagArr = array_filter(explode(';',$val['tag_id']));
            $tag_name = [];
            if($tagArr){
                foreach($tagArr as $k=>$v){
                    $_name = isset($typeData[$v]) && $typeData[$v] ? $typeData[$v] : $v;
                    $tag_name[] = $_name;
                }
            }
            $data['data'][$key]['tag_name'] = $tag_name;

        }
//        echo '<pre>';
//        var_dump($data['info_top']);
//        exit;

        $data['menu'] = 'house';
        $data['menu_son'] = '';

        return view('front.house.index',[
            'data' => $data,
            'title' => '海外房产',
        ]);
    }

    /*
     * 海外房产详情页
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

        //海外房产购房流程图片，类型为5
        $data['buy_img'] = current(Banner::where('type',5)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //当前详情页的本条数据
        $data['data'] = OverseaHouse::where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray();
        $cityData = City::getCityAllData();//得到城市所有数据
        $typeData = Enum::getEnumAllData();//得到类型所有数据
        foreach($data['data'] as $key=>$val){
            $imgArr = array_filter(explode(';',$val['images']));
            $data['data'][$key]['imgs'] = $imgArr;
            $city_parent = City::where('id',$val['city_id'])->first();
            $data['data'][$key]['country_name'] = isset($cityData[$city_parent->pid]) ? $cityData[$city_parent->pid] : $city_parent->pid;
            $data['data'][$key]['city_name'] = isset($cityData[$val['city_id']]) ? $cityData[$val['city_id']] : $val['city_id'];
            $data['data'][$key]['type_name'] = isset($typeData[$val['type_id']]) ? $typeData[$val['type_id']] : $val['type_id'];
            $tagArr = array_filter(explode(';',$val['tag_id']));
            $tag_name = [];
            if($tagArr){
                foreach($tagArr as $k=>$v){
                    $_name = isset($typeData[$v]) && $typeData[$v] ? $typeData[$v] : $v;
                    $tag_name[] = $_name;
                }
            }
            $data['data'][$key]['tag_name'] = $tag_name;
        }
        $data['data'] = $data['data'][0];
        //详情页的项目动态，article   type==5
        $data['dynamic'] = Article::where('type',5)->where('project_id',$data['data']['id'])->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->get()->toArray();


        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);
        //取出4个最新资讯
        $data['info'] = $this->getShowInfoData(4,['category'=>1]);

        $data['menu'] = 'house';
        $data['menu_son'] = '';

        return view('front.house.detail', [
            'data' => $data,
            'title' => $data['data']['title'],
        ]);
    }



}