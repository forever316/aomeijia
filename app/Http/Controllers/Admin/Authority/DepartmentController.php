<?php

namespace App\Http\Controllers\Admin\Authority;

use App\Http\Controllers\Controller;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Authority\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    private $form = [];
    private $access_key = 0;

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.authority.department.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function ajaxDepartmentList(){
        $id = Input::get('id',0);
        $user = Session::get('user');
        if(!empty($id)){
            $departmentList = Department::where('id','!=',$id)->get();
        }else{
            $departmentList = Department::get();
        }
        $arr = [];
        foreach($departmentList as $key=>$item){
            if($item->pid == 0){
                $arr[] = ['id'=>$item->id,'name'=>$item->name,'pid'=>$item->pid,'open'=>true];
            }else{
                $arr[] = ['id'=>$item->id,'name'=>$item->name,'pid'=>$item->pid,'open'=>true];
            }
        }
        return response()->json($arr);
    }


    public function departmentList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $departmentType = new Department();
            $departmentTypeCount = new Department();
            $query = $departmentType->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $departmentTypeCount = $departmentTypeCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $departmentTypeCount = $departmentTypeCount->where($k,'=',$v);
                    }
                }
            }
            $departmentTypeCount = $departmentTypeCount;
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $departmentTypeCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'pid'){
                        $dept = Department::find($row[$k]);
                        $arr['rows'][$key][$k] = $dept['name'];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 部门列表','form'=>$this->form]);
        }
    }

    public function addDepartment(Request $request){
        if($_POST){
            //获取参数
            $params = ['name'=>'string','pid'=>'string','role_ids'=>'array'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('pid',array_keys($data))){
                    unset($data['pid']);
                    $data['pid_show'] = '请选择上级部门';
                }
                return $this->returnJson(false,$data,'input');
            }
            DB::beginTransaction();

            $roles = $data['role_ids'];
            unset($data['role_ids']);
            $department = Department::create($data);
            if(!$department){
                DB::rollback();
                return $this->returnJson(false,'添加部门失败','all');
            }

            foreach($roles as $key=>$item){
                $departmentRole = DepartmentRole::create(['department_id'=>$department->id,'role_id'=>$item]);
                if(!$departmentRole){
                    DB::rollback();
                    return $this->returnJson(false,'添加角色关联失败','all');
                }
            }

            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            $roles = Role::get();
            foreach($roles as $item){
                $this->form['field']['role_ids']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加部门','form'=>$this->form]);
    }

    public function updateDepartment(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Department::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','pid'=>'string','role_ids'=>'array'];
            $data = $this->getInput([],$params,$request);

            if(empty($data['name'])){
                return $this->returnJson(false,'请填写部门名称','all');
            }

            if(!empty($detailData->pid)){
                if(empty($data['pid'])){
                    return $this->returnJson(false,'请选择上级部门','all');
                }
            }

            if(!isset($data['role_ids']) || empty($data['role_ids'])){
                return $this->returnJson(false,'请选择角色','all');
            }

            DB::beginTransaction();

            $arr =  [];
            $departmentRole = DepartmentRole::select(['id','role_id'])->where('department_id','=',$detailData->id)->get()->toArray();
            if(!empty($departmentRole)){
                foreach($departmentRole as $key=>$item){
                    $arr[$item['role_id']] = $item['id'];
                }
            }

            foreach($arr as $key=>$item){
                if(!in_array($key,array_values($data['role_ids']))){
                    if(!DepartmentRole::destroy($item)){
                        DB::rollback();
                        return $this->returnJson(false,'删除原有角色关联失败','all');
                    }
                }
            }

            foreach($data['role_ids'] as $key=>$item){
                if(!in_array($item,array_keys($arr))){
                    $departmentRole = DepartmentRole::create(['department_id'=>$detailData->id,'role_id'=>$item]);
                    if(!$departmentRole){
                        DB::rollback();
                        return $this->returnJson(false,'添加角色关联失败','all');
                    }
                }
            }

            $detailData->name = $data['name'];
            $detailData->pid = $data['pid'];
            $department = $detailData->save();
            if(!$department){
                DB::rollback();
                return $this->returnJson(false,'修改部门信息失败','all');
            }

            DB::commit();

            return $this->returnJson(true,'','all');
        }else{
            if(empty($detailData->pid)){
                unset($this->form['field']['pid']);
            }else{
                $p = Department::find($detailData->pid);
                $detailData->pname = $p->name;
            }
            $roles = Role::get();
            foreach($roles as $item){
                $this->form['field']['role_ids']['value'][$item->id] = $item->name;
            }

            $departmentRole = DepartmentRole::select(['role_id'])->where('department_id','=',$detailData->id)->get();
            $arr = [];
            foreach($departmentRole as $key=>$item){
                $arr[] = $item->role_id;
            }
            $detailData->role_ids = $arr;

        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改部门','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function deleteDepartment(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的用户','all');
            }
            $idArray = explode(',',$data['ids']);
            $userCount = User::whereIn('dept_id',$idArray)->count();
            if($userCount > 0){
                return $this->returnJson(false,'该部门下有管理员，不可删除','all');
            }

            $departmentCount = Department::whereIn('pid',$idArray)->count();
            if($departmentCount > 0){
                return $this->returnJson(false,'该部门下有子部门，不可删除','all');
            }

            DB::beginTransaction();
            $return = Department::whereIn('id',array_values($idArray))->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'部门删除失败','all');
            }
            $return = DepartmentRole::whereIn('department_id',$idArray)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除部门所拥有角色失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }
    }

    public function seeDepartment(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Department::where('id','=',$paramsData['id'])->first();
        if(!$data){
            abort(404);
        }

        if($data->pid == 0){
            $data->pid = '-';
        }else{
            $data->pid =  $this->getDeptPath('',$data->pid);
        }

        $departmentRole = DepartmentRole::where('department_id','=',$data->id)->get();

        $data->role = '';
        foreach($departmentRole as $key=>$item){
            $role = Role::find($item->role_id);
            $data->role .= $role->name.'&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        return view('admin/common/view',['title'=>WEBNAME.' - 查看部门','form'=>$this->form,'data'=>$data]);
    }

    protected function getDeptPath($strPid,$pid){
        if($pid != 0){
            $dept = Department::find($pid);
            $strPid = $dept->name.'/'.$strPid;
            $strPid = $this->getDeptPath($strPid,$dept->pid);
        }
        return $strPid;
    }
}