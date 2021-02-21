<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.city.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function ajaxCityList(){
        $status = Input::get('status',0);
        $arr[] = ['id'=>0,'name'=>'全球','pid'=>0,'open'=>true];
        $cityList = City::orderBy('sort','asc')->get();
        foreach($cityList as $key=>$item){
            $arr[] = ['id'=>$item->id,'name'=>$item->name,'pid'=>$item->pid,'open'=>true];
        }
       
        return response()->json($arr);
    }

    public function cityList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string','hot'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $obj = new City();
            $objCount = new City();
            $query = $obj->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like',$v.'%');
                        $objCount = $objCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $objCount = $objCount->where($k,'=',$v);
                    }
                }
            }
            $user = Session::get('user');
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $objCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['hot'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        if($k == 'pid'){
                            $obj = City::find($row[$k]);
                            if( $row[$k]){
                                $arr['rows'][$key][$k] = $obj->name;
                            }else{
                                $arr['rows'][$key][$k] = '全球';
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
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 城市列表','form'=>$this->form]);
        }
    }

    public function cityAdd(Request $request){
        if($_POST){
            //获取参数
            $params = ['pid'=>'string','name'=>'string','pic'=>'string','sort'=>'int','hot'=>'string','english_name'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('pid',array_keys($data))){
                    unset($data['pid']);
                    $data['pid_show'] = '请选择上级城市';
                }
                return $this->returnJson(false,$data,'input');
            }

            // $fieldArray = $data['field'];
            // unset($data['field']);
            // if(isset($fieldArray) && count($fieldArray) > 0){
            //     foreach($fieldArray as $k=>$item){
            //         if(empty($item)){
            //             unset($fieldArray[$k]);
            //         }
            //     }
            //     $data['field'] = serialize($fieldArray);
            // }
            $obj = City::create($data);
            if($obj){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            $endCount = 1;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加城市','form'=>$this->form,'endCount'=>$endCount]);
    }

    public function cityUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = City::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['pid'=>'string','name'=>'string','pic'=>'string','sort'=>'int','hot'=>'string','english_name'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('pid',array_keys($data))){
                    unset($data['pid']);
                    $data['pid_show'] = '请选择上级城市';
                }
                return $this->returnJson(false,$data,'input');
            }

            // $fieldArray = $data['field'];
            // unset($data['field']);
            // if(isset($fieldArray) && count($fieldArray) > 0){
            //     foreach($fieldArray as $k=>$item){
            //         if(empty($item)){
            //             unset($fieldArray[$k]);
            //         }
            //     }
            //     $data['field'] = serialize($fieldArray);
            // }

            $detailData->pid = $data['pid'];
            $detailData->name = $data['name'];
            $detailData->english_name = $data['english_name'];
            $detailData->pic = $data['pic'];
            $detailData->sort = $data['sort'];
            $detailData->hot = $data['hot'];
            // if(isset($data['field']) && !empty($data['field'])){
            //     $detailData->field = $data['field'];
            // }
            DB::beginTransaction();
            $obj = $detailData->save();
            if(!$obj){
                DB::rollback();
                return $this->returnJson(false,'城市修改失败','all');
            }

            $objModel = new City();
            $pathStr = $objModel->getTypePath($detailData->id,$detailData->pid);
            // if(Goods::where('type_id','=',$detailData->id)->count() > 0){
            //     $upReturn = Goods::where('type_id','=',$detailData->id)->update(['type_path'=>$pathStr]);
            //     if(!$upReturn){
            //         DB::rollback();
            //         return $this->returnJson(false,'修改商品路径失败','all');
            //     }
            // }
            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            if($detailData->pid == 0){
                $detailData->pname = '全球';
            }else{
                $obj = City::find($detailData->pid);
                $detailData->pname = $obj->name;
            }
            $endCount = 2;
            // $detailData->fieldArray = [];
            // if(!empty($detailData->field)){
            //     $detailData->fieldArray = $temp = unserialize($detailData->field);
            //     if(!empty($temp)){
            //         krsort($temp);
            //         $endCount = key($temp);
            //     }
            // }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改城市','form'=>$this->form,'detailData'=>$detailData,'endCount'=>$endCount]);
    }

    public function cityDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $objCount = City::whereIn('pid',$ids)->count();
            if($objCount > 0){
                return $this->returnJson(false,'该分类存在子分类，不可删除','all');
            }
            // $goodsCount = Goods::whereIn('type_id',$ids)->count();
            // if($goodsCount > 0){
            //     return $this->returnJson(false,'该商品分类存在关联商品，不可删除','all');
            // }

            $return = City::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
}