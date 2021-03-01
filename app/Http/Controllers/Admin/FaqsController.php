<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faqs;
use App\Models\City;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class FaqsController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.faqs.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
	public function faqsList(Request $request){
		if($request->ajax()){
			//获取要搜索的字段
			$params = ['id'=>'string','questions'=>'string','status'=>'string'];
			$search_params = $this->getInput([],$params,$request);

			//获取要排序的字段 默认按创建时间倒序
			$sort = Input::get('sort','created_at');
			$order = Input::get('order','desc');

			//要返回的数组
			$arr = ['total'=>0,'rows'=>[]];

			//数据获取与处理
			$obj = new Faqs();
			$objCount = new Faqs();

			$query = $obj->select(array_keys($this->form['field']));
			foreach($search_params as $k=>$v){
				if(!empty($v)){
					if($k == 'questions'){
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
			return view('admin/common/list',['title'=>WEBNAME.' - 问答知识列表','form'=>$this->form]);
		}
	}

	public function addFaqs(Request $request){
		$user = Session::get('user');
		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','questions'=>'string','answers'=>'string','sort'=>'int','status'=>'string'];
			$data = $this->getInput($this->form,$params,$request);
			if(isset($data['error'])){
				unset($data['error']);
				return $this->returnJson(false,$data,'input');
			}
			$obj = Faqs::create($data);
			if ($obj) {
				return $this->returnJson(true, '', 'all');
			} else {
				return $this->returnJson(false, '', 'all');
			}
		}
		return view('admin/common/add',['title'=>WEBNAME.' - 添加问答知识','form'=>$this->form]);
	}


	public function updateFaqs(Request $request){
		$user = Session::get('user');
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);

		$detailData = Faqs::where('id','=',$paramsData['id'])->first();
		if(!$detailData){
			abort(404);
		}

		if($_POST){
			//获取参数
			$params = ['city_id'=>'string','questions'=>'string','answers'=>'string','sort'=>'int','status'=>'string'];
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
			//城市名称
			$cityName = City::select(['name'])->where('id',$detailData->city_id)->first();
			$detailData->city_name = $cityName->name;
		}
		return view('admin/common/edit',['title'=>WEBNAME.' - 修改问答知识','form'=>$this->form,'detailData'=>$detailData]);
	}

	public function seeFaqs(Request $request){
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);
		$data = Faqs::find($paramsData['id']);
		if(!$data){
			abort(404);
		}else{
			//城市名称
			$cityName = City::select(['name'])->where('id',$data->city_id)->first();
			$data->city_id = $cityName->name;
			return view('admin/common/view',['title'=>WEBNAME.' - 查看问答知识','form'=>$this->form,'data'=>$data]);
		}
	}

    public function deleteFaqs(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Faqs::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }



}