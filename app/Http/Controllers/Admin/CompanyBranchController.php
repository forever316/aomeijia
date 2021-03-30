<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyBranch;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class CompanyBranchController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.company_branch.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
	public function companyBranchList(Request $request){
		if($request->ajax()){
			//获取要排序的字段 默认按创建时间倒序
			$sort = Input::get('sort','created_at');
			$order = Input::get('order','desc');

			//要返回的数组
			$arr = ['total'=>0,'rows'=>[]];

			//数据获取与处理
			$obj = new CompanyBranch();
			$objCount = new CompanyBranch();

			$query = $obj->select(array_keys($this->form['field']));
			$dataList1 = $query->orderBy($sort,$order)->paginate(10);
			$arr['total'] = $objCount->count();
			$dataList1 = $dataList1->toArray();

			//显示隐藏
			foreach ($dataList1['data'] as $key=>$row){
				foreach($this->form['field'] as $k=>$item){
					$arr['rows'][$key][$k] = $row[$k];
				}
			}
			return response()->json($arr);
		}else{
			return view('admin/common/list',['title'=>WEBNAME.' - 分公司地址列表','form'=>$this->form]);
		}
	}

	public function add(Request $request){
		if($_POST){
			//获取参数
			$params = ['company_name'=>'string','company_address'=>'string','sort'=>'int'];
			$data = $this->getInput($this->form,$params,$request);
			if(isset($data['error'])){
				unset($data['error']);
				return $this->returnJson(false,$data,'input');
			}
			$obj = CompanyBranch::create($data);
			if ($obj) {
				return $this->returnJson(true, '', 'all');
			} else {
				return $this->returnJson(false, '', 'all');
			}
		}
		return view('admin/common/add',['title'=>WEBNAME.' - 添加分公司地址','form'=>$this->form]);
	}


	public function update(Request $request){
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);

		$detailData = CompanyBranch::where('id','=',$paramsData['id'])->first();
		if(!$detailData){
			abort(404);
		}

		if($_POST){
			//获取参数
			$params = ['company_name'=>'string','company_address'=>'string','sort'=>'int'];
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
		}
		return view('admin/common/edit',['title'=>WEBNAME.' - 修改分公司地址','form'=>$this->form,'detailData'=>$detailData]);
	}

    public function delete(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = CompanyBranch::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }



}