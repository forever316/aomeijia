<?php

namespace App\Http\Controllers\Front;

use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\Link;
use App\Models\CompanyConfig;
use App\Models\PartnerType;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HomeController  extends Controller
{
    //显示首页
    public function index()
    {
        //头部banner
        $data['topBanner'] = Banner::where('type',1)->where('status',1)->orderBy('sort','desc')->take(3)->get()->toArray();
        //首页服务图片
        $data['serviceBanner'] = Banner::where('type',2)->where('status',1)->orderBy('sort','desc')->first()->toArray();
        //城市的三级联动
        $cityList = City::orderBy('sort','asc')->get();
        if($cityList){
            $data['cityList'] = $this->build_tree($cityList->toArray(),0);
        }
        //公司资料设置
        $data['company'] = CompanyConfig::where('id',1)->first()->toArray();

        //友情链接
        $data['linkData'] = $this->getLinkData();
        //合作伙伴
        $_partnerData = Partner::where('status',1)->orderBy('sort','desc')->get()->toArray();
        $_partnerType = PartnerType::get()->toArray();
        $partnerType = array();
        foreach($_partnerType as $key=>$val){
            $partnerType[$val['id']] = $val['name'];
        }
        $partnerData = array();
        foreach($_partnerData as $key=>$val){
            $partnerData[$val['type']]['type_name'] = isset($partnerType[$val['type']]) && $partnerType[$val['type']] ? $partnerType[$val['type']] : $val['type'];
            $partnerData[$val['type']]['partner'][] = $val;
        }
        $data['partnerData'] = $partnerData;
        // echo '<pre>';
        // var_dump($partnerData);
        // exit;




        // echo '<pre>';
        // var_dump($data);
        // exit;
        return view('front.home',[
            'title' => '首页',
            'data' => $data,
            
        ]);
    }


}