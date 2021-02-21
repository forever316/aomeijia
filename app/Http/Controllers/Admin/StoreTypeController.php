<?php

namespace App\Http\Controllers\Admin;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class StoreTypeController extends Controller
{
    private $form = [];
    private $access_key = 0;

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.store_type.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function ajaxGoodsTypeAttribute(){
        $id = Input::get('typeID');
        if(empty($id)){
            return $this->returnJson(false,'参数错误','all');
        }else{
            $goodsType = GoodsType::where('type','=',2)->where('id','=',$id)->first();
            if(!$goodsType){
                return $this->returnJson(false,'类型不存在，请刷新页面','all');
            }
            $attributeArray = [];
            if(!empty($goodsType->field)){
                $attributeArray = unserialize($goodsType->field);
            }
            return $this->returnJson(true,$attributeArray,'all');
        }
    }

    public function ajaxGoodsTypeList(){
        $status = Input::get('status',0);
        $user = Session::get('user');
        if(!$status){

            $ptype1 = GoodsType::select(['id'])->where('pid','=',0)->where('type','=',2)->orderBy('sort','asc')->get();
            $pArray = [];
            foreach($ptype1 as $item){
                $pArray[] = $item->id;
            }

            $ptype2 = GoodsType::select(['id'])->whereIn('pid',array_values($pArray))->orderBy('sort','asc')->get();
            $pArray2 = [];
            foreach($ptype2 as $item){
                $pArray[] = $item->id;
            }
            $result = array_merge($pArray, $pArray2);
            $id = Input::get('id',0);
            if(!empty($id)){
                $goodsTypeList = GoodsType::where('id','!=',$id)->whereIn('id',$result)->orderBy('sort','asc')->get();
            }else{
                $goodsTypeList = GoodsType::whereIn('id',$result)->orderBy('sort','asc')->get();
            }
            $arr[] = ['id'=>0,'name'=>'商城','pid'=>0,'open'=>true];
            foreach($goodsTypeList as $key=>$item){
                $arr[] = ['id'=>$item->id,'name'=>$item->name,'pid'=>$item->pid,'open'=>true];
            }
        }else{
            $arr[] = ['id'=>0,'name'=>'商城','pid'=>0,'open'=>true];
            $goodsTypeList = GoodsType::where('type','=',2)->orderBy('sort','asc')->get();
            foreach($goodsTypeList as $key=>$item){
                $arr[] = ['id'=>$item->id,'name'=>$item->name,'pid'=>$item->pid,'open'=>true];
            }
        }
        return response()->json($arr);
    }

    public function storeTypeList(Request $request){
//                $c = new \AopClient();
//        echo "<pre>";print_r($c);die;
//        $c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
//        $c->appId = "2017022005778017";
//        $c->rsaPrivateKey = 'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCqLzSzP0JGPdwvriKNX5pLnC3eMcljMi0DyPKPLkL1eF8d/die1x+XpxFdCCrOKFjtP9/idSpG35Nl79T0GANijGldpQHR+e5ClH8zrKM2AjdMAyrYfsohyLUj0TeacXWvUZjPR4h+33u/CZggP1XqqsmN/+oAcMqmbS8eFyq+u1r2j5cVWXnM/qgNfWdnCYHqOMEY3BhvAvRrHFVoxADBTh3CJOGjt1IcVycbB/kOBri/RLANYqx6unKdfqRtlgUvaPRyj4rwBpuN3SwJTpmspg/hsQDZhJhTssMSwC9w4O3muArws0efDTmvg4+QUszsRUexlm5JJ15SHau/s6fhAgMBAAECggEBAJEyw2jnYPkjEDiR/qLV3YQDFVNM8QC0L5naGbE1jCV49NZW3TnwWuD9xp+0Nyk7XVvWMoM46cAcQtsm+27jCghLuh4OiXYIIlMl9T02Xu3WiC1PSn/59SVL49hSSXl4sirJmHHJG1j7/c1pNyTURM55totzu8dydEP4RcoLhAnD1Gkl3PPWQx5psTVKR99xld23Ukw+MyaZX6iw9X1uQ3EidhCLMwTIb/0CXDCHbh/TA215BfA9cY/s+NlnJ4hYOTgE4CxORRoS4Z4lEP0Wvh1tLnBZDdj80qo73K8O6bLAMtAZHj09U7ky/8QkKy3OO0G+qplT0MKhEzsxi8BIxt0CgYEA5D0H7RdBwWt6t8R64aupHLpGu4ZvyE6oPHYUU9kDniPCMKgXOfCvAZCFqKiq0BH5pNrmtsxBWexwtTOm/4HSLNXJoixw2AEgcVRXyhbPI6+0sJ8rwR+p5Hl8kvzMRXsc91EsLY1OP1e6Jv3Sek1+dzVXzbkMpKNCZhsZ6habgOMCgYEAvuJ38i03h/BHe51OAV9OzuxtXPrSUnB7lLxC2eWyrG5HpLHX+uzYnRJbYUmdDrn2KWmsdE5n3MoBhrM6qmmoZSlceedMuAzdWTCH0VROmE1er6KrM+ng4DPvsebFFl4D/5fSdjsvS8xRiOvBSNKnGHg+0/yCp3fo8bsOXWY/Y2sCgYEAvlkMADbSNz6tBRAPL6BblMLh9Mlk9phrBKmxwFAQDVZjQPMfE8pgGhzu679nXcpv+oY5viBRLG7dfLHMR/F8WLofxGnt3qfp57pg0QD+1hNWzaqh8hm3Nf3/4BKHRjcr7DM9dewQYxGGBbjQTgHNRBwv0znOioxB9ygJD8q0++MCgYEAgqJUeh2t2k97bEK8Zr4GHiC5u59AHwEx4hlxGtRTEiSqzTCU4foDSIOOnCcX4EMuDyttxW7/L5/jqX6xUHzcrNbAngDIhVDwjyBiYsTywNJ6UXLe/bk6l9WTXcnT6bnPvLT3aMiaVqJuzmihr6fSiTGJteQiul+awQxGCW93RB8CgYBjV0zCngYruutn9Sc2x4rh/KRwywjYUYtKE78ajQGUA/5Qd3/v2Ux7f/fJU/+B5jn9Ht5bfLm11bJMcsRyNXl3oxRZQvAnRpMAej4ajw0UEnYusApHa1RR4IR8pLjj6rGDmCu1f/OUg7QKWA1nIh536zfrvclquF6BYujaIld8pA==' ;
//        $c->format = "json";
//        $c->charset= "GBK";
//        $c->signType= "RSA2";
//
////实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
//        $request = new \AlipayOpenPublicTemplateMessageIndustryModifyRequest();
////SDK已经封装掉了公共参数，这里只需要传入业务参数
////此次只是参数展示，未进行字符串转义，实际情况下请转义
//        $request->setBizContent = "{" +
//            "    \"primary_industry_name\":\"IT科技/IT软件与服务\"," +
//            "    \"primary_industry_code\":\"10001/20102\"," +
//            "    \"secondary_industry_code\":\"10001/20102\"," +
//            "    \"secondary_industry_name\":\"IT科技/IT软件与服务\"" +
//            " }";
//        $response= $c->execute($request);
//
//        dd($response);
//        $a = $c ->echoDebug('123');
//        echo "<pre>";print_r($a);die;

        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $goodsType = new GoodsType();
            $goodsTypeCount = new GoodsType();
            $query = $goodsType->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like',$v.'%');
                        $goodsTypeCount = $goodsTypeCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $goodsTypeCount = $goodsTypeCount->where($k,'=',$v);
                    }
                }
            }
            $user = Session::get('user');
            $query = $query->where('type','=',2);
            $goodsTypeCount = $goodsTypeCount->where('type','=',2);
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $goodsTypeCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'pid'){
                        $goodsType = GoodsType::find($row[$k]);
                        if( $row[$k]){
                            $arr['rows'][$key][$k] = $goodsType->name;
                        }else{
                            $arr['rows'][$key][$k] = '商城';
                        }
                    }elseif($k == 'pic'){
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
            return view('admin/common/list',['title'=>WEBNAME.' - 商品类型列表','form'=>$this->form]);
        }
    }

    public function storeTypeAdd(Request $request){
        if($_POST){
            //获取参数
            $params = ['pid'=>'string','name'=>'string','pic'=>'string','field'=>'array','sort'=>'int','is_show'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('pid',array_keys($data))){
                    unset($data['pid']);
                    $data['pid_show'] = '请选择上级类型';
                }
                return $this->returnJson(false,$data,'input');
            }

            $fieldArray = $data['field'];
            unset($data['field']);
            if(isset($fieldArray) && count($fieldArray) > 0){
                foreach($fieldArray as $k=>$item){
                    if(empty($item)){
                        unset($fieldArray[$k]);
                    }
                }
                $data['field'] = serialize($fieldArray);
            }
            $data['type'] = 2;
            $goodsType = GoodsType::create($data);
            if($goodsType){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            $endCount = 1;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加商家类型','form'=>$this->form,'endCount'=>$endCount,'type'=>2]);
    }

    public function storeTypeUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = GoodsType::where('type','=',2)->where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['pid'=>'string','name'=>'string','pic'=>'string','field'=>'array','sort'=>'int','is_show'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('pid',array_keys($data))){
                    unset($data['pid']);
                    $data['pid_show'] = '请选择上级类型';
                }
                return $this->returnJson(false,$data,'input');
            }

            $fieldArray = $data['field'];
            unset($data['field']);
            if(isset($fieldArray) && count($fieldArray) > 0){
                foreach($fieldArray as $k=>$item){
                    if(empty($item)){
                        unset($fieldArray[$k]);
                    }
                }
                $data['field'] = serialize($fieldArray);
            }

            $detailData->pid = $data['pid'];
            $detailData->name = $data['name'];
            $detailData->pic = $data['pic'];
            $detailData->sort = $data['sort'];
            $detailData->is_show = $data['is_show'];
            if(isset($data['field']) && !empty($data['field'])){
                $detailData->field = $data['field'];
            }
            DB::beginTransaction();
            $goodsType = $detailData->save();
            if(!$goodsType){
                DB::rollback();
                return $this->returnJson(false,'类型修改失败','all');
            }

            $goodsTypeModel = new GoodsType();
            $pathStr = $goodsTypeModel->getTypePath($detailData->id,$detailData->pid);
            if(Goods::where('type_id','=',$detailData->id)->count() > 0){
                $upReturn = Goods::where('type_id','=',$detailData->id)->update(['type_path'=>$pathStr]);
                if(!$upReturn){
                    DB::rollback();
                    return $this->returnJson(false,'修改商品路径失败','all');
                }
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            if($detailData->pid == 0){
                $detailData->pname = '商城';
            }else{
                $goodsType = GoodsType::find($detailData->pid);
                $detailData->pname = $goodsType->name;
            }
            $endCount = 2;
            $detailData->fieldArray = [];
            if(!empty($detailData->field)){
                $detailData->fieldArray = $temp = unserialize($detailData->field);
                if(!empty($temp)){
                    krsort($temp);
                    $endCount = key($temp);
                }
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改商品类型','form'=>$this->form,'detailData'=>$detailData,'endCount'=>$endCount,'type'=>2]);
    }

    public function goodsTypeDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $goodsTypeCount = GoodsType::whereIn('pid',$ids)->count();
            if($goodsTypeCount > 0){
                return $this->returnJson(false,'该商品分类存在子分类，不可删除','all');
            }
            $goodsCount = Goods::whereIn('type_id',$ids)->count();
            if($goodsCount > 0){
                return $this->returnJson(false,'该商品分类存在关联商品，不可删除','all');
            }

            $return = GoodsType::where('type','=',2)->whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
}