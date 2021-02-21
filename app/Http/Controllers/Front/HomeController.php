<?php

namespace App\Http\Controllers\Front;

use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\CompanyConfig;
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


        // echo '<pre>';
        // var_dump($data);
        // exit;
        return view('front.home',[
            'title' => '首页',
            'data' => $data,
            
        ]);
    }


}