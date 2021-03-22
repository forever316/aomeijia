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

class investThemeController  extends Controller
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

        //投资主题,type=6
        $words = isset($_GET['words']) ? $_GET['words'] : 0;
        $data['searchInfo']['words'] = $words;
        $query = Article::where('type',6)->where('status',1)->where('publish_date','<=',$date);
        if($words){
            $query = $query->where(function ($query) use ($words)  {
                $query->where('title','like','%'.$words.'%')
                    ->orwhere('describe', 'like','%'.$words.'%');
            });
        }
        $data['theme'] = $query->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->paginate(20);
        //投资主题的热门搜索词，搜索词类型，1投资主题,2海外房产,3成功案例,4百科资讯',，取出前三条
        $data['search'] = HotSearch::where('type',1)->where('status',1)->orderBy('sort','desc')->pluck('words','id')->take(3)->toArray();

        return view('front.invest.theme',[
            'data' => $data,
        ]);
    }

    /*
     * 投资主题详情页
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

        $data['data'] = current(Article::where('type',6)->where('status',1)->where('publish_date','<=',$date)->where('id',$id)->take(1)->get()->toArray());//当前详情页的本条数据
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);
        //4个投资问答
        $data['faqs'] = Faqs::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(4)->get()->toArray();
        //5个热门资讯
        $data['info'] = Information::where('category',1)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(5)->get()->toArray();

        return view('front.invest.theme_detail', [
            'data' => $data,

        ]);
    }




}