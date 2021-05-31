<?php

namespace App\Http\Controllers\Admin;

use App\Models\MigrateTest;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class MigrateTestController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.migrate_test.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

	public function migrateTestList(Request $request){
		if($request->ajax()){
			//获取要搜索的字段
			$params = ['id'=>'string','phone'=>'string','name'=>'string','email'=>'string','sex'=>'string'];
			$search_params = $this->getInput([],$params,$request);

			//获取要排序的字段 默认按创建时间倒序
			$sort = Input::get('sort','id');
			$order = Input::get('order','desc');

			//要返回的数组
			$arr = ['total'=>0,'rows'=>[]];

			//数据获取与处理
			$obj = new MigrateTest();

			$query = $obj->select(array_keys($this->form['field']));
			foreach($search_params as $k=>$v){
				if(!empty($v)){
					if($k == 'name'){
						$query = $query->where($k,'like','%'.$v.'%');
					}else{
						$query = $query->where($k,'=',$v);
					}
				}
			}

			$dataList1 = $query->orderBy($sort,$order)->paginate(10);
			$arr['total'] = $query->count();
			$dataList1 = $dataList1->toArray();

			//显示隐藏
			foreach ($dataList1['data'] as $key=>$row){
				foreach($this->form['field'] as $k=>$item){
					if(in_array($k,['type','status','sex'])){
						$arr['rows'][$key][$k] = $item['options'][$row[$k]];
					}else{
						$arr['rows'][$key][$k] = $row[$k];
					}
				}
			}
			return response()->json($arr);
		}else{
			return view('admin/common/list',['title'=>WEBNAME.' - 移民测试列表','form'=>$this->form]);
		}
	}

	public function seeMigrateTest(Request $request){
		$params = ['id'=>'int'];
		$paramsData = $this->getInput([],$params,$request);
		$data = MigrateTest::find($paramsData['id']);
		if(!$data){
			abort(404);
		}else{
			return view('admin/common/view',['title'=>WEBNAME.' - 查看国家攻略','form'=>$this->form,'data'=>$data]);
		}
	}
}