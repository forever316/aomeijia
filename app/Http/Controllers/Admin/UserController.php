<?php

namespace App\Http\Controllers\Admin;

use App\Models\Authority\AdminUserRole;
use App\Models\Authority\Department;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Role;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $form = [];
    private $access_key = 0;

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.user.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    /**
     * 用户列表
     *
     */
    public function userList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $user = new User();
            $userCount = new User();
            $query = $user->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $userCount = $userCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $userCount = $userCount->where($k,'=',$v);
                    }
                }
            }
            $userCount = $userCount;
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $userCount->count();
            $dataList1 = $dataList1->toArray();
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'dept_id'){
                        $dept = Department::find($row[$k]);
                        $arr['rows'][$key][$k] = isset($dept->name)?$dept->name:'';
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 用户列表','form'=>$this->form]);
        }
    }

    /**
     **添加用户
     **
     */
    public function addUser(Request $request){
        if($_POST){
            //获取参数
            $params = ['name'=>'string','email'=>'string','dept_id'=>'string','role_ids'=>'array'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('dept_id',array_keys($data))){
                    unset($data['dept_id']);
                    $data['dept_id_show'] = '请选择所属部门';
                }
                return $this->returnJson(false,$data,'input');
            }

            if(!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u",$data['name'])){
                $error['name'] = '用户名只能为字母或数字，且长度为6至15位';
                return $this->returnJson(false,$error,'input');
            }

            //查看是否存在相同用户
            $count = User::where('name','=',$data['name'])->count();
            if($count > 0){
                return $this->returnJson(false,'该用户名已被使用','all');
            }

            $data['password'] = bcrypt('123456');
            $user = User::create($data);
            if(!$user){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }

            foreach($data['role_ids'] as $key=>$item){
                $adminUserRole = AdminUserRole::create(['admin_user_id'=>$user->id,'role_id'=>$item]);
                if(!$adminUserRole){
                    DB::rollback();
                    return $this->returnJson(false,'私有角色创建失败','all');
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
        return view('admin/common/add',['title'=>WEBNAME.' - 添加用户','form'=>$this->form]);
    }

    /**
     **修改用户
     **
     */
    public function updateUser(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

//        $user = Auth::user();
//        if($user->id != $paramsData['id']){
//            Session::flash('error', '只能修改自己的密码');
//            return redirect()->back();
//        }

        $detailData = User::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['password'=>'string','password2'=>'string','dept_id'=>'string','role_ids'=>'array'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                if(in_array('dept_id',array_keys($data))){
                    unset($data['dept_id']);
                    $data['dept_id_show'] = '请选择所属部门';
                }
                return $this->returnJson(false,$data,'input');
            }

            $passwordLength = $this->abslength($data['password']);
            if($passwordLength < 6 || $passwordLength > 15){
                $error['password'] = '密码长度错误';
                return $this->returnJson(false,$error,'input');
            }
            if($data['password'] != $data['password2']){
                return $this->returnJson(false,'两次密码输入不一致','all');
            }
            DB::beginTransaction();
            $arr =  [];
            $adminUserRole = AdminUserRole::select(['id','role_id'])->where('admin_user_id','=',$detailData->id)->get()->toArray();
            if(!empty($adminUserRole)){
                foreach($adminUserRole as $key=>$item){
                    $arr[$item['role_id']] = $item['id'];
                }
            }

            foreach($arr as $key=>$item){
                if(!in_array($key,array_values($data['role_ids']))){
                    if(!AdminUserRole::destroy($item)){
                        DB::rollback();
                        return $this->returnJson(false,'删除原有角色关联失败','all');
                    }
                }
            }

            foreach($data['role_ids'] as $key=>$item){
                if(!in_array($item,array_keys($arr))){
                    $departmentRole = AdminUserRole::create(['admin_user_id'=>$detailData->id,'role_id'=>$item]);
                    if(!$departmentRole){
                        DB::rollback();
                        return $this->returnJson(false,'添加角色关联失败','all');
                    }
                }
            }

            $detailData->password = bcrypt($data['password']);
            $detailData->dept_id = $data['dept_id'];
            $user = $detailData->save();
            if(!$user){
                DB::rollback();
                return $this->returnJson(false,'修改管理员信息失败','all');
            }

            DB::commit();
            return $this->returnJson(true,'','all');
            //                Auth::logout();
//                Session::forget('user');
//                Cookie::queue('is_login', null , -1); // 销毁
        }else{
            $dept = Department::find($detailData->dept_id);
            if($dept){
                $detailData['dept_name'] = $dept->name;
            }else{
                $detailData['dept_name'] = '';
            }
            $detailData['password'] = '';

            $roles = Role::get();
            foreach($roles as $item){
                $this->form['field']['role_ids']['value'][$item->id] = $item->name;
            }

            $departmentRole = AdminUserRole::select(['role_id'])->where('admin_user_id','=',$detailData->id)->get();
            $arr = [];
            foreach($departmentRole as $key=>$item){
                $arr[] = $item->role_id;
            }
            $detailData->role_ids = $arr;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改用户','form'=>$this->form,'detailData'=>$detailData]);
    }

    /**
     **删除用户
     **
     * @param Request $request
     * @return string
     */
    public function deleteUser(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的用户','all');
            }

            $idArray = explode(',',$data['ids']);
            DB::beginTransaction();
            $return = User::whereIn('id',array_values($idArray))->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'用户删除失败','all');
            }
            AdminUserRole::whereIn('admin_user_id',$idArray)->delete();
            DB::commit();
            return $this->returnJson(true,'','all');
        }
    }


    /**
     **重置密码
     **
     */
    public function resetPass(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = User::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            $detailData->password = bcrypt('123456');
            $bannerType = $detailData->save();
            if($bannerType){
                $user = Auth::user();
                if($user->id == $paramsData['id']){
                    Auth::logout();
                    Session::forget('user');
                    Cookie::queue('is_login', null , -1); // 销毁
                }
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }

    public function seeUser(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = User::where('id','=',$paramsData['id'])->first();
        if(!$data){
            abort(404);
        }

        $dept = Department::find($data->dept_id);

        if($dept->pid == 0){
            $data->dept = $dept->name;
        }else{
            $data->dept =  $this->getDeptPath('',$dept->pid);
            $data->dept .= $dept->name;
        }

        $adminUserRole = AdminUserRole::where('admin_user_id','=',$data->id)->get();

        $data->role = '';
        foreach($adminUserRole as $key=>$item){
            $role = Role::find($item->role_id);
            $data->role .= $role->name.'&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        return view('admin/common/view',['title'=>WEBNAME.' - 查看用户','form'=>$this->form,'data'=>$data]);
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