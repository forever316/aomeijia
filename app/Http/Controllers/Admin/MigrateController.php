<?php

namespace App\Http\Controllers\Admin;

use App\Models\Migrate;
use App\Models\Enum;
use App\Models\City;
use App\Models\TeamMember;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class MigrateController extends Controller
{
    private $form = [];
    private $title = '全球移民';

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.migrate.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function migrateList(Request $request){
        $typeData = $this->getEnumByType([4]);
        $investData = $this->getEnumByType([5]);
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string','type_id'=>'string','invest_id'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $obj = new Migrate();

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

                //移民类型，投资类型
                $arr['rows'][$key]['type_id'] = isset($typeData[$row['type_id']]) && $typeData[$row['type_id']] ? $typeData[$row['type_id']] : $row['type_id'];
                $arr['rows'][$key]['invest_id'] = isset($investData[$row['invest_id']]) && $investData[$row['invest_id']] ? $investData[$row['invest_id']] : $row['invest_id'];
            }
            return response()->json($arr);
        }else{
            $this->form['search']['type_id']['value'] = array(''=>'请选择')+$typeData;
            $this->form['search']['invest_id']['value'] = array(''=>'请选择')+$investData;
            return view('admin/common/list',['title'=>WEBNAME.' - '.$this->title.'列表','form'=>$this->form]);
        }
    }

    public function addMigrate(Request $request){
        if($_POST){
            //获取参数
            $params = ['city_id'=>'string','type_id'=>'string','invest_id'=>'int','title'=>'string','img'=>'string','project_charac'=>'string','live_require'=>'string','identity'=>'string','transact_period'=>'string','total_price'=>'string','sort'=>'int','status'=>'string','publish_date'=>'string','read'=>'string','project_brief'=>'string','project_advantage'=>'string','apply_condition'=>'string','apply_process'=>'string','face'=>'string'];
            
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $obj = Migrate::create($data);
            if ($obj) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }else{
            $typeData = $this->getEnumByType([4]);
            $investData = $this->getEnumByType([5]);
//            $this->form['field']['user_id']['value'] = TeamMember::getTeamMemberList();
            $this->form['field']['type_id']['value'] = $typeData;
            $this->form['field']['invest_id']['value'] = $investData;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加'.$this->title,'form'=>$this->form]);
    }


    public function updateMigrate(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = Migrate::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['city_id'=>'string','type_id'=>'string','invest_id'=>'int','title'=>'string','img'=>'string','project_charac'=>'string','live_require'=>'string','identity'=>'string','transact_period'=>'string','total_price'=>'string','sort'=>'string','status'=>'string','publish_date'=>'string','read'=>'string','project_brief'=>'string','project_advantage'=>'string','apply_condition'=>'string','apply_process'=>'string','face'=>'string'];
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
            $typeData = $this->getEnumByType([4]);
            $investData = $this->getEnumByType([5]);
//            $this->form['field']['user_id']['value'] = TeamMember::getTeamMemberList();
            $this->form['field']['type_id']['value'] = $typeData;
            $this->form['field']['invest_id']['value'] = $investData;
            //城市名称
            $cityName = City::select(['name'])->where('id',$detailData->city_id)->first();
            $detailData->city_name = $cityName->name;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改'.$this->title,'form'=>$this->form,'detailData'=>$detailData]);
    }

    public function seeMigrate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Migrate::find($paramsData['id']);
        if(!$data){
            abort(404);
        }else{
            $typeData = $this->getEnumByType([4]);
            $investData = $this->getEnumByType([5]);
            $teamMember = TeamMember::getTeamMemberList();

            //移民类型，投资类型
            $data->type_id = isset($typeData[$data->type_id]) && $typeData[$data->type_id] ? $typeData[$data->type_id] : $data->type_id;
            $data->invest_id = isset($investData[$data->invest_id]) && $investData[$data->invest_id] ? $investData[$data->invest_id] : $data->invest_id;
//            $data->user_id = isset($teamMember[$data->user_id]) && $teamMember[$data->user_id] ? $teamMember[$data->user_id] : $data->user_id;
            //城市名称
            $cityName = City::select(['name'])->where('id',$data->city_id)->first();
            $data->city_id = $cityName->name;
            return view('admin/common/view',['title'=>WEBNAME.' - 查看'.$this->title,'form'=>$this->form,'data'=>$data]);
        }
    }

    public function deleteMigrate(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Migrate::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }

}