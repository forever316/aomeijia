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

class InspectController  extends Controller
{
    //考察团汇总页
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
        //考察团banner图片，类型为14
        $data['banner_img'] = current(Banner::where('type',14)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(1)->get()->toArray());

        //取出6个成功案例
        $data['case'] = $this->getShowInfoData(6,['category'=>2]);
        $data['case'] = array_chunk($data['case'],2);

        //取出所有考察团内容，type=7
        $data['data'] = Article::where('type',7)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date', 'desc')->orderBy('id','desc')->get()->toArray();
        foreach($data['data'] as $key=>$val){
            $data['data'][$key]['end_date'] = date("Y年m月d日",strtotime($val['close_date']));
        }

        //取出4条往期考察团回顾内容，type=8
        $data['back_review'] = Article::where('type',8)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date', 'desc')->orderBy('id','desc')->take(4)->get()->toArray();



        $data['menu'] = 'home';
        $data['menu_son'] = '';
        $title = '考察团';
        return view('front.inspect.index',[
            'title' => $title,
            'data' => $data,

        ]);

    }
    //显示首页
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
        $data['data'] = Article::where('id',$id)->take(1)->get()->toArray();
        $data['data'] = current($data['data']);
        if($data['data']){
            //上一篇文章
            $data['last_article'] = Article::where('id','<',$id)->where('type',$data['data']['type'])->where('status',1)->where('publish_date','<=',$date)->take(1)->get()->toArray();
            $data['last_article'] = current($data['last_article']);
            //下一篇文章
            $data['next_article'] = Article::where('id','>',$id)->where('type',$data['data']['type'])->where('status',1)->where('publish_date','<=',$date)->take(1)->get()->toArray();
            $data['next_article'] = current($data['next_article']);

            $data['header_route'] = '<span>首页</span>
            <i>></i>
            <span>集团动态</span>
            <i>></i>
            <span>'.$data['data']['title'].'</span>';
        }else{
            $data['header_route'] = '<span>首页</span>
            <i>></i>
            <span>集团动态</span>';

        }

        $data['menu'] = 'corp';
        $data['menu_son'] = '';
        $title = $data['data']['title'];
        //5为海外房产详情页的项目动态
        if($data['data']['type']==5){
            $data['menu'] = 'house';
            $data['header_route'] = '<span>首页</span>
            <i>></i>
            <span>海外房产</span>
            <i>></i>
            <span>'.$data['data']['title'].'</span>';
        }


        return view('front.article.detail',[
            'title' => $title,
            'data' => $data,

        ]);
    }


}