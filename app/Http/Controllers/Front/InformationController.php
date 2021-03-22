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

class InformationController  extends Controller
{
    //显示首页
    public function index()
    {
        //公共模块
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);

        //可点击的地区
        $data['region'] = array('0'=>'不限') + City::where('pid',0)->orderBy('sort','desc')->pluck('name','id')->toArray();
        //可点击的国家
        $data['country'] = array('0'=>'不限');
        //可点击的类型,类型枚举为，从enum表中取出type=6的数据
        $data['type'] = array('0'=>'不限') + Enum::where('type',6)->where('status',1)->orderBy('sort','desc')->pluck('name','id')->toArray();

        //热门搜索词，搜索词类型，1投资主题,2海外房产,3成功案例,4百科资讯',，取出前三条
        $data['search'] = HotSearch::where('type',4)->where('status',1)->orderBy('sort','desc')->pluck('words','id')->take(3)->toArray();

        //三个热门投资主题数据,文章类型，''1公司简介,2加入我们,3联系我们,4集团动态,5项目动态,6投资主题'',7,考察团内容，8往期考察团回顾，9往期活动回顾',
        $data['theme'] = Article::where('type',6)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(3)->get()->toArray();
        //四个投资问答
        $data['faqs'] = Faqs::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(4)->get()->toArray();
        //宣传图片，百科资讯宣传图片类型为9
        $data['adver_img'] = Banner::where('type',9)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray();


        //热门资讯，'类别，1热门资讯，2成功案例',
        $query = Information::where('category',1)->where('status',1)->where('publish_date','<=',$date);
        $region = isset($_GET['region']) ? $_GET['region'] : 0;
        $country = isset($_GET['country']) ? $_GET['country'] : 0;
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        $words = isset($_GET['words']) ? $_GET['words'] : 0;
        $data['searchInfo'] = ['region'=>$region,'country'=>$country,'type'=>$type,'words'=>$words];
        $data['url'] = '/information?1=1';
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
        if($words){
            $query = $query->where(function ($query) use ($words)  {
                $query->where('title','like','%'.$words.'%')
                    ->orwhere('describe', 'like','%'.$words.'%');
            });
            $data['url'] .= '&words='.$words;
        }
        //取出主数据，为10条热门资讯数据
        $data['data'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->paginate(12);
        $i = 1;
        $data['top_data'] = $data['list_data'] = array();
        foreach($data['data'] as $key=>$val){
            if($i<=3){
                $data['top_data'][$key] = $val;//轮播文章，为前面3条数据
            }else{
                $data['list_data'][$key] = $val;//列表数据，列表为9条数据
            }
            $i++;
        }

        return view('front.information.index',[
            'data' => $data,

        ]);
    }
    /*
     * 百科资讯详情页
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
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);
        //三个热门投资主题数据,文章类型，''1公司简介,2加入我们,3联系我们,4集团动态,5项目动态,6投资主题'',7,考察团内容，8往期考察团回顾，9往期活动回顾',
        $data['theme'] = Article::where('type',6)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(3)->get()->toArray();
        //四个投资问答
        $data['faqs'] = Faqs::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(4)->get()->toArray();
        //宣传图片，百科资讯宣传图片类型为9
        $data['adver_img'] = Banner::where('type',9)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray();


        $data['data'] = Information::where('category',1)->where('status',1)->where('id',$id)->where('publish_date','<=',$date)->take(1)->get()->toArray();
        $data['data'] = current($data['data']);
        $data['last_article'] = $data['next_article'] = '';
        if($data['data']){
            //上一篇文章
            $data['last_article'] = Information::where('category',1)->where('id','<',$id)->where('status',1)->where('publish_date','<=',$date)->take(1)->get()->toArray();
            $data['last_article'] = current($data['last_article']);
            //下一篇文章
            $data['next_article'] = Information::where('category',1)->where('id','>',$id)->where('status',1)->where('publish_date','<=',$date)->take(1)->get()->toArray();
            $data['next_article'] = current($data['next_article']);

        }

        return view('front.information.detail',[
            'data' => $data,

        ]);
    }


}