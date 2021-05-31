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

class investCaseController  extends Controller
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

        //可点击的类型,类型枚举为，从enum表中取出type=7的数据，1房产类型,2房产标签,3房产特色,4移民类型,5移民投资金额,6热门资讯类型,7成功案例类型',
        $data['type'] = array('0'=>'不限') + Enum::where('type',7)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();
        //所有的地区列表
        $data['region'] = array('0'=>'不限') + City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();
        $region = isset($_GET['region']) ? $_GET['region'] : 0;
        $country = isset($_GET['country']) ? $_GET['country'] : 0;
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        $data['searchInfo'] = ['region'=>$region,'country'=>$country,'type'=>$type];
        //成功案例
        $query = Information::where('status',1)->where('category',2)->where('publish_date','<=',$date);
        $data['url'] = '/invest/case?1=1';

        $data['country'] = array();
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

        $data['data'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->paginate(9);

        $countryIds = array();
        if($region){
            $countryIds = array_keys($data['country']);
        }
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);

        $data['menu'] = 'invest';
        $data['menu_son'] = 'case';

        return view('front.invest.case',[
            'data' => $data,
            'title' => '成功案例',
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

        $data['data'] = current(Information::where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray());//当前详情页的本条数据
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);
        //4个投资问答
        $data['faqs'] = Faqs::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(4)->get()->toArray();
        //5个热门资讯
        $data['info'] = Information::where('category',1)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(5)->get()->toArray();

        $data['menu'] = 'invest';
        $data['menu_son'] = 'case';

        return view('front.invest.case_detail', [
            'data' => $data,
            'title' => $data['data']['title'],

        ]);
    }


}