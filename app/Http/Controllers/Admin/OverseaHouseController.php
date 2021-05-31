<?php

namespace App\Http\Controllers\Admin;

use App\Models\OverseaHouse;
use App\Models\Enum;
use App\Models\City;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class OverseaHouseController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.oversea_house.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function houseList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $obj = new OverseaHouse();
            $objCount = new OverseaHouse();

            $query = $obj->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'title'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $objCount = $objCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $objCount = $objCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $objCount->count();
            $dataList1 = $dataList1->toArray();

			$cityData = $this->getCityIdName();
            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['type','status'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
				//城市名称
				$arr['rows'][$key]['city_id'] = isset($cityData[$row['city_id']]) && $cityData[$row['city_id']] ? $cityData[$row['city_id']] : $row['city_id'];
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 海外房产列表','form'=>$this->form]);
        }
    }

    public function addHouse(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['city_id'=>'string','type_id'=>'string','feature_id'=>'int','price_range_id'=>'string','images'=>'string','project_atlas'=>'string','unit_price'=>'string','title'=>'string','describe'=>'string','home_show'=>'string','complete_date'=>'string','area'=>'string','house_type'=>'string','total_price'=>'string','property_year'=>'string','first_payment'=>'string','year_return'=>'string','house_standard'=>'string','address'=>'string','sort'=>'string','status'=>'string','watch_number'=>'string','publish_date'=>'string','basic_info'=>'string','main_door'=>'string','surround_facility'=>'string','program_feature'=>'string','invest_analysis'=>'string','latitude'=>'string','longitude'=>'string','process_img'=>'string'];
            
            $data = $this->getInput($this->form,$params,$request);
            $tag_id = $request->input('tag_id');
            $data['tag_id'] = implode(';', $tag_id);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $obj = OverseaHouse::create($data);
            if ($obj) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }else{
            //1房产类型,2房产标签,3房产特色
            $objType = Enum::select(['id','name','type'])->where('status',1)->whereIn('type',array(1,2,3,10))->orderBy('sort','desc')->get();
            foreach($objType as $item){
                if($item->type==1){
                    $this->form['field']['type_id']['value'][$item->id] = $item->name;
                }elseif($item->type==2){
                    $this->form['field']['tag_id']['value'][$item->id] = $item->name;
                }elseif($item->type==3){
                    $this->form['field']['feature_id']['value'][$item->id] = $item->name;
                }elseif($item->type==10){
                    $this->form['field']['price_range_id']['value'][$item->id] = $item->name;
                }
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加海外房产','form'=>$this->form]);
    }


    public function updateHouse(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = OverseaHouse::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['city_id'=>'string','type_id'=>'string','feature_id'=>'int','price_range_id'=>'string','images'=>'string','project_atlas'=>'string','unit_price'=>'string','title'=>'string','describe'=>'string','home_show'=>'string','complete_date'=>'string','area'=>'string','house_type'=>'string','total_price'=>'string','property_year'=>'string','first_payment'=>'string','year_return'=>'string','house_standard'=>'string','address'=>'string','sort'=>'string','status'=>'string','watch_number'=>'string','publish_date'=>'string','basic_info'=>'string','main_door'=>'string','surround_facility'=>'string','program_feature'=>'string','invest_analysis'=>'string','latitude'=>'string','longitude'=>'string','process_img'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            $tag_id = $request->input('tag_id');
            $detailData->tag_id = implode(';', $tag_id);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            foreach($params as $key=>$val){
                $detailData->$key = $data[$key];
            }
            $return = $detailData->save();
            if ($return) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }else{
            //1房产类型,2房产标签,3房产特色
            $objType = Enum::select(['id','name','type'])->where('status',1)->whereIn('type',array(1,2,3,10))->orderBy('sort','desc')->get();
            foreach($objType as $item){
                if($item->type==1){
                    $this->form['field']['type_id']['value'][$item->id] = $item->name;
                }elseif($item->type==2){
                    $this->form['field']['tag_id']['value'][$item->id] = $item->name;
                }elseif($item->type==3){
                    $this->form['field']['feature_id']['value'][$item->id] = $item->name;
                }elseif($item->type==10){
                    $this->form['field']['price_range_id']['value'][$item->id] = $item->name;
                }
            }
            $this->form['field']['images']['value'] = explode(';', $detailData->images);
            $detailData->tag_id = explode(';', $detailData->tag_id);
            //城市名称
            $cityName = City::select(['name'])->where('id',$detailData->city_id)->first();
            $detailData->city_name = $cityName->name;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改海外房产','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function seeHouse(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = OverseaHouse::find($paramsData['id']);
        if(!$data){
            abort(404);
        }else{
            // //1房产类型,2房产标签,3房产特色
			$typeData = $this->getEnumByType([1,2,3,10]);
            //类型名称
            $data->type_id = isset($typeData[$data->type_id]) && $typeData[$data->type_id] ? $typeData[$data->type_id] : $data->type_id;
            //特色名称
            $data->feature_id = isset($typeData[$data->feature_id]) && $typeData[$data->feature_id] ? $typeData[$data->feature_id] : $data->feature_id;
            //房产价格区间
            $data->price_range_id = isset($typeData[$data->price_range_id]) && $typeData[$data->price_range_id] ? $typeData[$data->price_range_id] : $data->price_range_id;

            //标签名称
            $tag_ids = explode(';', $data->tag_id);
            $data->tag_id = '';
            foreach($tag_ids as $id){
                $data->tag_id .= (isset($typeData[$id]) && $typeData[$id] ? $typeData[$id] : $id).';';
            }
            //城市名称
            $cityName = City::select(['name'])->where('id',$data->city_id)->first();
            $data->city_id = $cityName->name;
            //多个图片
            $data->images1 = explode(';', $data->images);
            return view('admin/common/view',['title'=>WEBNAME.' - 查看海外房产','form'=>$this->form,'data'=>$data]);
        }
    }

}