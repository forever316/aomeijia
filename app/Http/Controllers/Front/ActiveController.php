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
use App\Models\Active;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ActiveController  extends Controller
{
    //展会活动汇总页
    public function index()
    {
        //公共模块
        $date = date('Y-m-d');
        //取出7个最新资讯
        $data = $this->getInfoData();
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        //展会活动banner图片，类型为15
        $data['banner_img'] = current(Banner::where('type',15)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        //取出9条热门活动内容，分页展示
        $data['data'] = Active::where('status',1)->where('show_start_date','<=',$date)->where('show_end_date','>=',$date)->orderBy('sort','desc')->orderBy('show_end_date','asc')->orderBy('id','desc')->paginate(9);
        foreach($data['data'] as $key=>$val) {
            $data['data'][$key]['thumb_358_640'] = $this->crop_img($val['thumb'], 358, 640);
        }

        //取出4条往期活动回顾内容，type=9
        $data['back_review'] = Article::where('type',9)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date', 'desc')->orderBy('id','desc')->take(4)->get()->toArray();
        foreach($data['back_review'] as $key=>$val) {
            $data['back_review'][$key]['thumb_276_211'] = $this->crop_img($val['thumb'], 276, 211);
        }

        $data['menu'] = 'index';
        $data['menu_son'] = '';
        $title = '热门活动';
        return view('front.active.index',[
            'title' => $title,
            'data' => $data,

        ]);

    }
    //展会活动的详情页,
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
        //本篇文章的详细内容
        $data['data'] = Active::where('id',$id)->take(1)->get()->toArray();
        $data['data'] = current($data['data']);

        $title = $data['data']['theme'];
        $data['header_route'] = '<span>首页</span><i>></i><span>热门活动</span><i>></i>'.$title;

        $data['menu'] = 'index';
        $data['menu_son'] = '';

        return view('front.active.detail',[
            'title' => $title,
            'data' => $data,
        ]);
    }

    //往期活动汇总页
    public function reviewIndex()
    {
        //公共模块
        $date = date('Y-m-d');
        //取出7个最新资讯
        $data = $this->getInfoData();
        //公司资料设置
        $data['company'] = $this->getCompanyData();
        //友情链接
        $data['linkData'] = $this->getLinkData();
        //展会活动banner图片，类型为15
        $data['banner_img'] = current(Banner::where('type',15)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        //取出往期活动回顾内容，type=9
        $data['data'] = Article::where('type',9)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date', 'desc')->orderBy('id','desc')->paginate(16);
        foreach($data['data'] as $key=>$val) {
            $data['data'][$key]['thumb_276_211'] = $this->crop_img($val['thumb'], 276, 211);
        }

        $data['menu'] = 'index';
        $data['menu_son'] = '';
        $title = '往期活动回顾';
        return view('front.active.review_index',[
            'title' => $title,
            'data' => $data,

        ]);

    }

    //往期展会活动详情页,type=9
    public function reviewDetail()
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
        //本篇文章的详细内容
        $data['data'] = Article::where('id',$id)->take(1)->get()->toArray();
        $data['data'] = current($data['data']);
        $title = $data['data']['title'];
        $data['header_route'] = '<span>首页</span><i>></i><span>往期活动回顾</span><i>></i>'.$title;


        $data['menu'] = 'index';
        $data['menu_son'] = '';

        return view('front.active.review_detail',[
            'title' => $title,
            'data' => $data,
        ]);
    }
}