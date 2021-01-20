<?php

namespace App\Http\Controllers\Admin;

use App\Models\Authority\AdminUserRole;
use App\Models\Authority\Department;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Role;
use App\Models\Finance\UserIntegralLog;
use App\Models\User_relations;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RelationsController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.relation.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    /**
     * 用户列表
     * ljf
     */
    public function RelationsList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['user_name'=>'string',];
            $search_params = $this->getInput([],$params,$request);
            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $user = new User_relations();
            $userCount = new User_relations();
//            $query = $user->select('user_relations.pid','user_info.integral','user.nickname',DB::raw('sum(operation_amount) as sum'),DB::raw('COUNT(*) as num'))->leftjoin('user_info', 'user_relations.pid', '=', 'user_info.user_id')->leftjoin('user', 'user_relations.pid', '=', 'user.id')
//                ->rightJoin('user_integral_log','user_integral_log.user_id','=', 'user_info.user_id')->where('user_integral_log.type','=',6)->groupBy('user_relations.pid');
            $query = $user->select('user_relations.pid','user_info.integral','user.nickname',DB::raw('COUNT(*) as num'))->leftjoin('user_info', 'user_relations.pid', '=', 'user_info.user_id')->leftjoin('user', 'user_relations.pid', '=', 'user.id')
               ->groupBy('user_relations.pid');

//
//
//            $query = $user->select('`count(*)`')->groupBy('pid')->get();

            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'user_name'){
                        $query = $query->where('user.nickname','like','%'.$v.'%');
                    }
                }
            }
            $dataList1 = $query->orderBy('user_relations.'.$sort,'user_relations.'.$order)->paginate(10);
//            $arr['total'] = $dataList1->total;
            $dataList1 = $dataList1->toArray();
            $arr['total'] = $dataList1['total'];
//            echo"<pre>";print_r($dataList1);exit;
            foreach ($dataList1['data'] as $key=>$row){
                $bonus_integral = UserIntegralLog::where('user_id','=',$row['pid'])->where('type','=',6)->sum('operation_amount');
                $arr['rows'][$key]['id'] = $key;
                $arr['rows'][$key]['user_name'] = $row['nickname']?$row['nickname']:'';
                $arr['rows'][$key]['recommend_amount'] = $row['num']?$row['num']:0;
                $arr['rows'][$key]['bonus_integral'] = $bonus_integral?$bonus_integral:0;
                $arr['rows'][$key]['integral'] = $row['integral']?$row['integral']:0;
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 用户列表','form'=>$this->form]);
        }
    }

}