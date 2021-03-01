<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestCountry;
use App\Models\Enum;
use App\Models\City;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class InvestCountryController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.invest_country.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

	public function investCountryList(Request $request){
		$enumType = [8];//tag_id为enum表中的type=8
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
			$obj = new InvestCountry();

			$query = $obj->select(array_keys($this->form['field']));
			foreach($search_params as $k=>$v){
				if(!empty($v)){
					if($k == 'title'){
						$query = $query->where($k,'like','%'.$v.'%');
					}else{
						$query = $query->where($k,'=',$v);
					}
				}
			}

			$dataList1 = $query->orderBy($sort,$order)->paginate(10);
			$arr['total'] = $query->count();
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
			}
			return response()->json($arr);
		}else{
			return view('admin/common/list',['title'=>WEBNAME.' - 国家攻略列表','form'=>$this->form]);
		}
	}

	public function addInvestCountry(Request $request){
		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','hot'=>'int','title'=>'string','describe'=>'string','thumb'=>'string','read'=>'int','publish_date'=>'string','sort'=>'int','status'=>'string','content'=>'string','advantage_img'=>'string'];
			$data = $this->getInput($this->form,$params,$request);
			$tag_id = $request->input('tag_id');
            $data['tag_id'] = implode(';', $tag_id);
		
			if(isset($data['error'])){
				unset($data['error']);
				return $this->returnJson(false,$data,'input');
			}
			if($data['hot'] > 5 || $data['hot'] == 0){
				$error['hot'] = '投资热度只能为1-5';
				return $this->returnJson(false,$error,'input');
			}
			$obj = InvestCountry::create($data);
			if ($obj) {
				return $this->returnJson(true, '', 'all');
			} else {
				return $this->returnJson(false, '', 'all');
			}
		}else{
			$enumType = [8];
			$this->form['field']['tag_id']['value']=$this->getEnumByType($enumType);
		}
		return view('admin/common/add',['title'=>WEBNAME.' - 添加国家攻略','form'=>$this->form]);
	}


	public function updateInvestCountry(Request $request){
		$user = Session::get('user');
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);

		$detailData = InvestCountry::where('id','=',$paramsData['id'])->first();
		if(!$detailData){
			abort(404);
		}

		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','hot'=>'string','title'=>'string','describe'=>'string','thumb'=>'string','read'=>'int','publish_date'=>'string','sort'=>'int','status'=>'string','content'=>'string','advantage_img'=>'string'];
			$data = $this->getInput($this->form,$params,$request);
			$tag_id = $request->input('tag_id');
            $detailData->tag_id = implode(';', $tag_id);
			if(isset($data['error'])){
				unset($data['error']);
				return $this->returnJson(false,$data,'input');
			}
			if($data['hot'] > 5 || $data['hot'] == 0){
				$error['hot'] = '投资热度只能为1-5';
				return $this->returnJson(false,$error,'input');
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
			$enumType = [8];
			$this->form['field']['tag_id']['value']=$this->getEnumByType($enumType);
			$detailData->tag_id = explode(';', $detailData->tag_id);
			//城市名称
			$cityName = City::select(['name'])->where('id',$detailData->city_id)->first();
			$detailData->city_name = $cityName->name;
		}
		return view('admin/common/edit',['title'=>WEBNAME.' - 更新国家攻略','form'=>$this->form,'detailData'=>$detailData]);
	}

	public function seeInvestCountry(Request $request){
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);
		$data = InvestCountry::find($paramsData['id']);
		if(!$data){
			abort(404);
		}else{
			// 6热点资讯类型
			$typeData = $this->getEnumByType([8]);
			//标签名称
			$tags = explode(";",$data->tag_id);
			$tagstr = '';
			foreach($tags as $val){
				$tagstr .= (isset($typeData[$val]) && $typeData[$val] ? $typeData[$val] : $val).';';
			}

			$data->tag_id = $tagstr;
			//城市名称
			$cityName = City::select(['name'])->where('id',$data->city_id)->first();
			$data->city_id = $cityName->name;
			return view('admin/common/view',['title'=>WEBNAME.' - 查看国家攻略','form'=>$this->form,'data'=>$data]);
		}
	}


    public function deleteInvestCountry(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = InvestCountry::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }



}