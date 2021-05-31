<?php

namespace App\Http\Controllers\Front;

use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\Link;
use App\Models\Article;
use App\Models\OverseaHouse;
use App\Models\Migrate;
use App\Models\CompanyBranch;
use App\Models\Enum;
use App\Models\CompanyConfig;
use App\Models\PartnerType;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CorpController  extends Controller
{
    //显示首页
    public function corpBrief()
    {
        $date = date('Y-m-d');
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        //4个热门房产项目
        $data['house'] = $this->getShowHouseData(4);
        //4个热门移民项目
        $data['migrate'] = $this->getShowMigrateData(4);

        //头部banner,一张图片
        $data['topBanner'] = current(Banner::where('type',8)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //1公司简介,2加入我们,3联系我们,4集团动态
        //澳美家简介内容,type=1,一条数据
        $data['brief'] = current(Article::where('type',1)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //加入我们
        $data['join'] = current(Article::where('type',2)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //联系我们
        $data['contact'] = current(Article::where('type',3)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(1)->get()->toArray());
        //联系我们中的下面的分公司
        $data['contact_branch'] = CompanyBranch::orderBy('sort','desc')->take(4)->get()->toArray();

        //集团动态
        $data['dynamic'] = Article::where('type',4)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->paginate(10);

        $data['dynamic_html'] = str_replace('corpBrief?page=1','corpBrief?page=1&key=news',$data['dynamic']->links());
        for($i=1;$i<10;$i++){
            $data['dynamic_html'] = str_replace('corpBrief?page='.$i,'corpBrief?page='.$i.'&key=news',$data['dynamic_html']);
        }

        $data['menu'] = 'corp';
        $data['menu_son'] = '';

        return view('front.corp.corp_brief',[
            'title' => '集团简介',
            'data' => $data,
        ]);
    }


}