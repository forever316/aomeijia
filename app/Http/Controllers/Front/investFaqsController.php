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

class investFaqsController  extends Controller
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

        $region = isset($_GET['region']) ? $_GET['region'] : 0;
        $country = isset($_GET['country']) ? $_GET['country'] : 0;
        $data['searchInfo'] = ['region'=>$region,'country'=>$country];

        //可点击的地区
        $data['region'] = array('0'=>'不限') + City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();
        //可点击的国家
        $data['country'] = array('0'=>'不限');

        $query = Faqs::where('status',1);

        $data['url'] = '/invest/faqs?1=1';
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

        $data['data'] = $query->orderBy('sort','desc')->orderBy('id','desc')->paginate(10);

        //取出5个最新资讯
        $data['info'] = $this->getShowInfoData(5,['category'=>1]);
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);

        $data['menu'] = 'invest';
        $data['menu_son'] = 'faqs';

        return view('front.invest.faqs',[
            'data' => $data,
            'title' => '投资问答',
        ]);
    }

}