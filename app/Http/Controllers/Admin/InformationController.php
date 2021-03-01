<?php

namespace App\Http\Controllers\Admin;

use App\Models\Information;
use App\Models\Enum;
use App\Models\City;
use App\Models\OverseaHouse;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class InformationController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.information.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

	public function informationList(Request $request){
		$category = isset($_GET['category']) && $_GET['category'] ? $_GET['category'] : 0;
		//6资讯类型,7是成功案例
		if($category==1){
			$enumType = [6];
		}elseif($category==2){
			$enumType = [7];
		}
		if($request->ajax()){
			//获取要搜索的字段
			$params = ['id'=>'string','title'=>'string','status'=>'string','type_id'=>'string','category'=>'string'];
			$search_params = $this->getInput([],$params,$request);

			//获取要排序的字段 默认按创建时间倒序
			$sort = Input::get('sort','created_at');
			$order = Input::get('order','desc');

			//要返回的数组
			$arr = ['total'=>0,'rows'=>[]];

			//数据获取与处理
			$obj = new Information();
			$objCount = new Information();

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
			$typeData = $this->getEnumByType($enumType);
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
				//类型名称
				$arr['rows'][$key]['type_id'] = isset($typeData[$row['type_id']]) && $typeData[$row['type_id']] ? $typeData[$row['type_id']] : $row['type_id'];
			}
			return response()->json($arr);
		}else{
			$typeData = array(''=>'--请选择--') + $this->getEnumByType($enumType);

			$this->form['search']['type_id']['value'] = $typeData;
			return view('admin/common/list',['title'=>WEBNAME.' - 信息列表','form'=>$this->form]);
		}
	}

	public function addInformation(Request $request){
		$user = Session::get('user');
		$category = isset($_GET['category']) && $_GET['category'] ? $_GET['category'] : 0;
		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','category'=>'string','type_id'=>'string','title'=>'string','describe'=>'string','thumb'=>'string','read'=>'int','publish_date'=>'string','sort'=>'int','status'=>'string','content'=>'string'];
			$data = $this->getInput($this->form,$params,$request);
			if(isset($data['error'])){
				unset($data['error']);
				return $this->returnJson(false,$data,'input');
			}
			$obj = Information::create($data);
			if ($obj) {
				return $this->returnJson(true, '', 'all');
			} else {
				return $this->returnJson(false, '', 'all');
			}
		}else{
			//6资讯类型,7是成功案例
			if($category==1){
				$enumType = [6];
			}elseif($category==2){
				$enumType = [7];
			}
			$this->form['field']['type_id']['value']=$this->getEnumByType($enumType);
		}
		return view('admin/common/add',['title'=>WEBNAME.' - 添加信息','form'=>$this->form]);
	}


	public function updateInformation(Request $request){
		$user = Session::get('user');
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);

		$detailData = Information::where('id','=',$paramsData['id'])->first();
		if(!$detailData){
			abort(404);
		}

		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','type_id'=>'string','title'=>'string','describe'=>'string','thumb'=>'string','read'=>'int','publish_date'=>'string','sort'=>'int','status'=>'string','content'=>'string'];
			$data = $this->getInput($this->form,$params,$request);
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
			//6资讯类型,7是成功案例
			$category = $detailData->category;
			if($category==1){
				$enumType = [6];
			}elseif($category==2){
				$enumType = [7];
			}
			$this->form['field']['type_id']['value']=$this->getEnumByType($enumType);
			//城市名称
			$cityName = City::select(['name'])->where('id',$detailData->city_id)->first();
			$detailData->city_name = $cityName->name;
		}
		return view('admin/common/edit',['title'=>WEBNAME.' - 更新信息','form'=>$this->form,'detailData'=>$detailData]);
	}

	public function seeInformation(Request $request){
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);
		$data = Information::find($paramsData['id']);
		if(!$data){
			abort(404);
		}else{
			// 6热点资讯类型
			$typeData = $this->getEnumByType([6,7]);
			//类型名称
			$data->type_id = isset($typeData[$data->type_id]) && $typeData[$data->type_id] ? $typeData[$data->type_id] : $data->type_id;
			//城市名称
			$cityName = City::select(['name'])->where('id',$data->city_id)->first();
			$data->city_id = $cityName->name;
			return view('admin/common/view',['title'=>WEBNAME.' - 查看信息','form'=>$this->form,'data'=>$data]);
		}
	}


    public function deleteInformation(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Information::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }



}