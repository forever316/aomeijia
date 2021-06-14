<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\BannerType;
use App\Models\Banner;
use App\Models\City;
use App\Models\Link;
use App\Models\CompanyConfig;
use App\Models\PartnerType;
use App\Models\Partner;
use App\Models\Enum;
use App\Models\Information;
// use App\Models\Link;
use App\Models\Migrate;
use App\Models\OverseaHouse;
use App\Models\TeamMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Active;


class HomeController  extends Controller
{
    /*
     * 跟城市有关模块：热门资讯跟成功案例，海外房产跟海外移民
     *
     */
    //显示首页
    public function index()
    {
        $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $data['pid'] = $pid;
        $data['id'] = $id;
        $date = date('Y-m-d');
        //头部banner，取前三张图片
        $data['topBanner'] = Banner::where('type',1)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(3)->get()->toArray();
        //首页服务图片,1张图片
        $data['serviceBanner'] = Banner::where('type',2)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->first();
        if($data['serviceBanner']){
            $data['serviceBanner'] = $data['serviceBanner']->toArray();
        }
        //城市的三级联动
        $cityList = City::orderBy('sort','desc')->orderBy('id','desc')->get();
        $allCityIds = array();
        foreach($cityList as $ck=>$cv){
            $allCityIds[] = $cv['id'];
        }
        $data['cityList'] = array();
        $data['cityList_hot'] = array();//热门城市数组
        if($cityList){
            $data['cityList'] = $this->build_tree($cityList->toArray(),0);
            foreach($data['cityList'] as $kk=>$vv){

                if(isset($vv['childs']) && $vv['childs']){
                    foreach($vv['childs'] as $child){
                        if($child['hot']==1){//此处为热门国家
                            $data['cityList_hot'][] = $child;
                        }
                    }
                }
            }
        }
        $searchCityIds = $allCityIds;
        if($id){
            $searchCityIds = $this->get_all_child($cityList,$id);
        }elseif($pid){
            $searchCityIds = $this->get_all_child($cityList,$pid);
        }

        //公司资料设置
        $data['company'] = CompanyConfig::where('id',1)->first()->toArray();


        //热门资讯类型和热门资讯//enum=6为热门资讯类型
        $data['infoType'] = Enum::where('type',6)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->get()->toArray();
        $data['info'] = $data['info_two'] = $data['info_other'] = array();

        if($data['infoType'] && $data['infoType'][0]){
            //默认只显示第一个类型的热门资讯，其他类型的热门资讯根据ajax点击请求数据获得
            $type = $data['infoType'][0]['id'];
            $condition = array();
            $condition['category'] = 1;
            $condition['type_id'] = $type;
            $condition['city_id'] = $searchCityIds;//增加显示城市
            //两条大数据加10条10个标题
            $data['info'] = $this->getShowInfoData(12,$condition);

            $i=1;
            foreach($data['info'] as $key_info=>$val_info){
                if($i<=2){
                    //前面两个热门资讯
//                    $val_info['thumb'] = $this->crop_img($val_info['thumb'],310,260);
                    $data['info_two'][] = $val_info;
                }else{
                    //后面十个热门资讯
                    $data['info_other'][] = $val_info;
                }
                $i++;
            }
        }

        //热门资讯下面的滚动的微信文章链接Link,type=5
        $data['wxbgBanner'] = Banner::where('type',6)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->first();
        if($data['wxbgBanner']){
            $data['wxbgBanner'] = $data['wxbgBanner']->toArray();
        }
        //微信文章标题
        $data['wechat'] = Link::where('type',5)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(20)->get()->toArray();
        //热门展会,1个热门展会
        $data['active'] = current($this->getActive(1));

        //考察团,4个考察团,考察团内容type为7
        $data['inspect'] = Article::where('type',7)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(4)->get()->toArray();
        foreach($data['inspect'] as $key=>$val){
            $data['inspect'][$key]['end_date'] = date("Y年m月d日",strtotime($val['close_date']));
        }

        //热门展会考察团下方的内容，亮条往期活动和两条往期考察团内容,8往期考察团回顾，9往期活动回顾'
        $data['past_active'] = Article::where('type',9)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(2)->get()->toArray();
        $data['past_inspect'] = Article::where('type',8)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('publish_date','desc')->orderBy('id','desc')->take(2)->get()->toArray();

        //热点项目推荐为海外房产，显示8条数据
        $condition = array();
        $condition['city_id'] = $searchCityIds;//增加显示城市
        $data['house'] = $this->getShowHouseData(8,$condition);

        //海外移民，显示6条数据
        $condition = array();
        $condition['city_id'] = $searchCityIds;//增加显示城市
        $data['total_migrate'] = $this->getShowMigrateData(6,$condition);
        $data['migrate'] = $data['migrate_first'] = $data['migrate_two'] = array();

        $i = 1;
        foreach($data['total_migrate'] as $key=>$val){
            if($i==1){
                $data['migrate_first'] = $val;
            }elseif($i==2){
                $data['migrate_two'] = $val;
            }else{
                $data['migrate'][] = $val;
            }
            $i++;
        }


        //成功案例，显示5条数据
        $condition = array();
        $condition['category'] = 2;
        $condition['city_id'] = $searchCityIds;//增加显示城市
        //成功案例是5个
        $data['case'] = $this->getShowInfoData(5,$condition);

        //专业团队，可显示的数据全部轮播
        $data['member'] = TeamMember::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->get()->toArray();

        //专业售前售后服务，banner Type=4
        $data['bottomBanner'] = Banner::where('type',4)->where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->take(6)->get()->toArray();


        //合作伙伴
        $_partnerData = Partner::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->get()->toArray();
        $partnerType = PartnerType::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->get()->toArray();
        $partnerData = array();
        foreach($partnerType as $key=>$val){
            $partnerData[$val['id']]['typeName'] = $val['name'];
            $partnerData[$val['id']]['class'] = '';
            if($key==0){
                $partnerData[$val['id']]['class'] = 'active';//默认显示第一个
            }
            foreach($_partnerData as $kk=>$vv){
                if($val['id']==$vv['type']){
                    $partnerData[$val['id']]['partner'][] = $vv;
                }
            }
        }
        $data['partnerData'] = $partnerData;

        //友情链接
        $data['linkData'] = $this->getLinkData();

//        echo '<pre>';
//        var_dump($data['migrate_first']);
//        exit;

        $data['menu'] = 'index';
        $data['menu_son'] = '';
        
        return view('front.home',[
            'title' => '首页',
            'data' => $data,
            
        ]);
    }

    public function getInfoByType()
    {
        $type_id = isset($_POST['type_id']) ? $_POST['type_id'] : 0;
        $date = date('Y-m-d');
        //默认只显示第一个类型的热门资讯，其他类型的热门资讯根据ajax点击请求数据获得
        $_data = Information::where('category',1)->where('type_id',$type_id)->where('status',1)->where('publish_date','<=',$date)->orderBy('sort','desc')->orderBy('id','desc')->take(12)->get()->toArray();//两条大数据加10条10个标题

        $i=1;
        $data['info_two'] = $data['info_other'] = array();
        foreach($_data as $key_info=>$val_info){
            if($i<=2){
                //前面两个热门资讯
                $data['info_two'][] = $val_info;
            }else{
                //后面十个热门资讯
                $data['info_other'][] = $val_info;
            }
            $i++;
        }
        $data['status'] = 1;
        return json_encode($data);
    }


}