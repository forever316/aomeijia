<?php

namespace App\Http\Controllers\Admin\Home;

use App\Models\Authority\AdminUserRole;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Menu;
use App\Models\Authority\MenuRole;
use App\Models\Authority\Modular;
use App\Models\Authority\Resources;
use App\Models\Authority\ResourcesRole;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsType;
use App\Models\Home\CompanyConfig;
use App\Models\Home\HomeModular;
use App\Models\Home\HomeModularContent;
use App\Models\Vip_level;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    private $form = [];


    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.home.shopping_home.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function modularList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','modular_name'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $homeModular = new HomeModular();
            $homeModularCount = new HomeModular();
            $query = $homeModular->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'modular_name'){
                        $query = $query->where($k,'like',$v.'%');
                        $homeModularCount = $homeModularCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $homeModularCount = $homeModularCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $homeModularCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'modular_img'){
                        if(!empty($row[$k])){
                            $arr['rows'][$key][$k] = '<a href="/'.$row[$k].'" target="_blank">'.$row[$k].'</a>';
                        }else{
                            $arr['rows'][$key][$k] = '-';
                        }
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 首页模块列表','form'=>$this->form]);
        }
    }

    public function modularAdd(Request $request){
        $goodsTypeList = [];
        if($_POST){
            $modular_type = Input::get('modular_type',0);
            if($modular_type){
                //获取参数
                $params = ['modular_name'=>'string','modular_img'=>'string','sort'=>'string'];
                $data = $this->getInput($this->form,$params,$request);
                if(isset($data['error'])){
                    unset($data['error']);
                    return $this->returnJson(false,$data,'input');
                }
                if(!preg_match('/^\d*$/',$data['sort'])){
                    return $this->returnJson(false,'排序请填写数字','all');
                }
                switch($modular_type){
                    case '4':
                        $goods_id = Input::get('goods_id',0);
                        $img1 = Input::get('img1',0);
                        if(empty($goods_id)){
                            return $this->returnJson(false,'请选择商品（模块1）','all');
                        }else{
                            $goods_id = implode(',',$goods_id);
                        }
                        if(empty($img1)){return $this->returnJson(false,'请添加图片（模块1）','all');}
//                        if(empty($goods_id2)){return $this->returnJson(false,'请选择商品（模块2）','all');}
//                        if(empty($img2)){return $this->returnJson(false,'请添加图片（模块2）','all');}
//                        if(empty($goods_id3)){return $this->returnJson(false,'请选择商品（模块3）','all');}
//                        if(empty($img3)){return $this->returnJson(false,'请添加图片（模块3）','all');}
//                        if(empty($goods_id4)){return $this->returnJson(false,'请选择商品（模块4）','all');}
//                        if(empty($img4)){return $this->returnJson(false,'请添加图片（模块4）','all');}

                        DB::beginTransaction();
                        $data['modular_type'] = $modular_type;
                        $homeModular = HomeModular::create($data);
                        if(!$homeModular){
                            DB::rollback();
                            return $this->returnJson(false,'模块创建失败','all');
                        }

                        $homeModularContent1 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img1,'goods_id'=>$goods_id,'sort'=>1]);
                        if(!$homeModularContent1){
                            DB::rollback();
                            return $this->returnJson(false,'模块创建失败(1)','all');
                        }

//                        $homeModularContent2 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img2,'goods_id'=>$goods_id2,'sort'=>2]);
//                        if(!$homeModularContent2){
//                            DB::rollback();
//                            return $this->returnJson(false,'模块创建失败(2)','all');
//                        }
//
//                        $homeModularContent3 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img3,'goods_id'=>$goods_id3,'sort'=>3]);
//                        if(!$homeModularContent3){
//                            DB::rollback();
//                            return $this->returnJson(false,'模块创建失败(3)','all');
//                        }
//
//                        $homeModularContent4 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img4,'goods_id'=>$goods_id4,'sort'=>4]);
//                        if(!$homeModularContent4){
//                            DB::rollback();
//                            return $this->returnJson(false,'模块创建失败(4)','all');
//                        }
                        DB::commit();
                        break;
                    case '2':
                        $goods_id = Input::get('goods_id',0);

                        $img1 = Input::get('img1',0);


                        if(empty($goods_id)){
                            return $this->returnJson(false,'请选择商品（模块1）','all');
                        }else{
                            $goods_id = implode(',',$goods_id);
                        }
                        if(empty($img1)){
                            return $this->returnJson(false,'请添加图片（模块1）','all');
                        }

                        $data['modular_type'] = $modular_type;
                        DB::beginTransaction();
                        $homeModular = HomeModular::create($data);
                        if(!$homeModular){
                            DB::rollback();
                            return $this->returnJson(false,'模块创建失败','all');
                        }

                        $homeModularContent1 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img1,'goods_id'=>$goods_id,'sort'=>1]);
                        if(!$homeModularContent1){
                            DB::rollback();
                            return $this->returnJson(false,'模块创建失败(1)','all');
                        }

//                        $homeModularContent2 = HomeModularContent::create(['modular_id'=>$homeModular->id,'img'=>$img2,'goods_id'=>$goods_id2,'sort'=>2]);
//                        if(!$homeModularContent2){
//                            DB::rollback();
//                            return $this->returnJson(false,'模块创建失败(2)','all');
//                        }
                        DB::commit();
                        break;
                }
                return $this->returnJson(true,'','all');
            }else{
                echo "不要瞎打开页面！你妹的";die;
            }
        }else{
            //$goodsTypeList = GoodsType::select(['id','name'])->where('access_key','=',$this->access_key)->get();
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加首页模型','form'=>$this->form]);//,'goodsTypeList'=>$goodsTypeList
    }

    //访问页面
    public function home_modular5(){
        $goodsTypeList = GoodsType::select(['id','name'])->get();
        return view('admin.home.home_modular',['goodsTypeList'=>$goodsTypeList]);
    }
    public function home_modular4(){
        $goodsTypeList = GoodsType::select(['id','name'])->get();
        return view('admin.home.home_modular4',['goodsTypeList'=>$goodsTypeList]);
    }
    public function home_modular2(){
        $goodsTypeList = GoodsType::select(['id','name'])->get();
        return view('admin.home.home_modular2',['goodsTypeList'=>$goodsTypeList]);
    }

    public function modularUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = HomeModular::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        $HomeModularContentList = [];
        if($_POST){
            $modular_type = Input::get('modular_type',0);
            if($modular_type){
                $params = ['modular_name'=>'string','modular_img'=>'string','sort'=>'string'];
                $data = $this->getInput($this->form,$params,$request);
                if(isset($data['error'])){
                    unset($data['error']);
                    return $this->returnJson(false,$data,'input');
                }
                if(!preg_match('/^\d*$/',$data['sort'])){
                    return $this->returnJson(false,'排序请填写数字','all');
                }
                switch($modular_type) {
                    case '2':
                        $goods_id = Input::get('goods_id',0);
                        $img1 = Input::get('img1',0);
                        if(empty($goods_id)){
                            return $this->returnJson(false,'请选择商品（模块1）','all');
                        }else{
                            $goods_id = implode(',',$goods_id);
                        }
                        if(empty($img1)){
                            return $this->returnJson(false,'请添加图片（模块1）','all');
                        }
                        $detailData->modular_name = $data['modular_name'];
                        $detailData->modular_img = $data['modular_img'];
                        $detailData->sort = $data['sort'];
                        DB::beginTransaction();
                        if(!$detailData->save()){
                            DB::rollback();
                            return $this->returnJson(false,'模块修改失败','all');
                        }
                        $homeModularContent1 = HomeModularContent::where('modular_id','=',$detailData->id)->where('sort','=',1)->update(['img'=>$img1,'goods_id'=>$goods_id]);
                        if(!$homeModularContent1){
                            DB::rollback();
                            return $this->returnJson(false,'模块修改失败(1)','all');
                        }
                        DB::commit();
                        break;
                    case '4':
                        $goods_id = Input::get('goods_id',0);
                        $img1 = Input::get('img1',0);
                        if(empty($goods_id)){
                            return $this->returnJson(false,'请选择商品（模块1）','all');
                        }else{
                            $goods_id = implode(',',$goods_id);
                        }
                        if(empty($img1)){return $this->returnJson(false,'请添加图片（模块1）','all');}
                        $detailData->modular_name = $data['modular_name'];
                        $detailData->modular_img = $data['modular_img'];
                        $detailData->sort = $data['sort'];

                        DB::beginTransaction();
                        if(!$detailData->save()){
                            DB::rollback();
                            return $this->returnJson(false,'模块修改失败','all');
                        }
                        $homeModularContent1 = HomeModularContent::where('modular_id','=',$detailData->id)->where('sort','=',1)->update(['img'=>$img1,'goods_id'=>$goods_id]);
                        if(!$homeModularContent1){
                            DB::rollback();
                            return $this->returnJson(false,'模块修改失败(1)','all');
                        }
                        DB::commit();
                        break;
                }
            }else{
                echo "不要瞎打开页面！你妹的";die;
            }
            return $this->returnJson(true,'','all');
        }else{

            $homeModularContentList = HomeModularContent::where('modular_id','=',$detailData->id)->first();

            $goodsList = Goods::select(['id','name'])->whereIn('id',explode(',',$homeModularContentList->goods_id))->get();
            $homeModularContentList['goodsList'] = $goodsList;
                return view('admin/common/edit',['title'=>WEBNAME.' - 修改首页模型','form'=>$this->form,'detailData'=>$detailData,'homeModularContentList'=>$homeModularContentList->toArray()]);
            }

    }

    public function modularDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            DB::beginTransaction();
            $return = HomeModular::whereIn('id',$ids)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除失败','all');
            }
            $return = HomeModularContent::whereIn('modular_id',$ids)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }
    }

    public function companyConfigSet(Request $request){
        if($_POST){
            $company_name = Input::get('company_name',0);
            $custom_service_phone = Input::get('custom_service_phone',0);
            $header_logo = Input::get('header_logo',0);
            $footer_logo = Input::get('footer_logo',0);
            $wechat1_img = Input::get('wechat1_img',0);
            $wechat2_img = Input::get('wechat2_img',0);
            $synopsis = Input::get('synopsis',0);
            $video = Input::get('video',0);
            $copyright = Input::get('copyright',0);

            $page_title = Input::get('page_title',0);
            $page_keywords = Input::get('page_keywords',0);
            $page_description = Input::get('page_description',0);
            $consult_wechat_qrcode = Input::get('consult_wechat_qrcode',0);
            $consult_wechat_number = Input::get('consult_wechat_number',0);


            if(empty($company_name)){
                return $this->returnJson(false,'公司名称不允许设置空值','all');
            }
            if(empty($header_logo)){
                return $this->returnJson(false,'请上传公司头部Logo','all');
            }
            if(empty($footer_logo)){
                return $this->returnJson(false,'请上传公司底部Logo','all');
            }
            if(empty($wechat1_img)){
                return $this->returnJson(false,'请上传澳美家海外微信公众号图片','all');
            }
            if(empty($wechat2_img)){
                return $this->returnJson(false,'请上传财富管理公众号图片','all');
            }
            if(empty($video)){
                return $this->returnJson(false,'请上传公司宣传视频','all');
            }
            if(empty($custom_service_phone)){
                return $this->returnJson(false,'咨询电话不允许设置空值','all');
            }
            $a = CompanyConfig::where('id','=',1)->update( [
                'company_name'=>$company_name,
                'custom_service_phone'=>$custom_service_phone,
                'header_logo' => $header_logo,
                'footer_logo'=>$footer_logo,
                'wechat1_img'=>$wechat1_img,
                'wechat2_img'=>$wechat2_img,
                'video'=>$video,
                'copyright'=>$copyright,
                'page_title'=>$page_title,
                'page_keywords'=>$page_keywords,
                'page_description'=>$page_description,
                'consult_wechat_qrcode'=>$consult_wechat_qrcode,
                'consult_wechat_number'=>$consult_wechat_number,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if(!$a){
                return $this->returnJson(false,'公司资料设置失败','all');
            }
            return $this->returnJson(true,'公司资料设置成功','all');
        }else{
            $detailData = CompanyConfig::where('id','=',1)->first();
        }
        return view('admin/home/company_config_set',['title'=>WEBNAME.' - 公司资料设置','detailData'=>$detailData]);
    }
}