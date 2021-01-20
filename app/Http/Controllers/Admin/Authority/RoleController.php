<?php

namespace App\Http\Controllers\Admin\Authority;

use App\Http\Controllers\Controller;
use App\Models\Authority\AdminUserRole;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Menu;
use App\Models\Authority\MenuRole;
use App\Models\Authority\Resources;
use App\Models\Authority\ResourcesRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Authority\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.authority.role.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function roleList(Request $request){
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
            $departmentType = new Role();
            $departmentTypeCount = new Role();
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

            //对应的唯一key
            $departmentTypeCount = $departmentTypeCount;

            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $departmentTypeCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    $arr['rows'][$key][$k] = $row[$k];
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 角色列表','form'=>$this->form]);
        }
    }

    public function addRole(Request $request){
        //$authority = Config::get('authority');
        $r = new Resources();
        $authority = $r->getResources();
        if($_POST){
            //获取参数
            $params = ['name'=>'string','menu'=>'array','resources'=>'array'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            set_time_limit(0);
            DB::beginTransaction();
            $user = Session::get('user');
            $role = Role::create(['name'=>$data['name']]);
            if(!$role){
                DB::rollback();
                return $this->returnJson(false,'角色添加失败','all');
            }

            $keyArray = [];
            foreach($data['menu'] as $item){
                $keyArray[] = $item;
            }

            $menuList = Menu::select(['menu_key','sort'])->whereIn('menu_key',$keyArray)->get();
            $newArray = [];
            foreach($menuList as $item){
                $newArray[$item->menu_key] = $item->sort;
            }

            foreach($data['menu'] as $key=>$item){
                if(!isset($newArray[$item])){
                    DB::rollback();
                    return $this->returnJson(false,'存在数据错误，请联系管理员','all');
                }
                $menuRole = MenuRole::create(['sort'=>$newArray[$item],'role_id'=>$role->id,'menu_key'=>$item]);
                if(!$menuRole){
                    DB::rollback();
                    return $this->returnJson(false,'角色所属菜单添加失败','all');
                }
            }

            foreach($data['resources'] as $key=>$item){
                $resourcesRole = ResourcesRole::create(['role_id'=>$role->id,'resources_key'=>$item]);
                if(!$resourcesRole){
                    DB::rollback();
                    return $this->returnJson(false,'角色所属资源添加失败','all');
                }
            }

            DB::commit();
            return $this->returnJson(true,'','all');
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加角色','form'=>$this->form,'authority' => $authority]);
    }

    public function updateRole(Request $request){
        //$authority = Config::get('authority');
        $r = new Resources();
        $authority = $r->getResources();
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Role::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','menu'=>'array','resources'=>'array'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            set_time_limit(0);
            DB::beginTransaction();
            $menu = [];$resources = [];
            $menu_return = MenuRole::where('role_id','=',$detailData->id)->get()->toArray();
            foreach($menu_return as $key=>$item){
                $menu[$item['id']] = $item['menu_key'];
            }

            $resources_return = ResourcesRole::where('role_id','=',$detailData->id)->get()->toArray();
            foreach($resources_return as $key=>$item){
                $resources[$item['id']] = $item['resources_key'];
            }

            //删除原有菜单
            foreach($menu as $key=>$item){
                if(!in_array($item,array_values($data['menu']))){
                    if(!MenuRole::destroy($key)){
                        DB::rollback();
                        return $this->returnJson(false,'删除原有菜单失败','all');
                    }
                }
            }
            //新增菜单
            foreach($data['menu'] as $key=>$item){
                if(!in_array($item,array_values($menu))){
                    $menuObject = Menu::where('menu_key','=',$item)->first();
                    if(!$menuObject){
                        DB::rollback();
                        return $this->returnJson(false,'存在数据错误，请联系管理员','all');
                    }
                    if(!MenuRole::create(['sort'=>$menuObject->sort,'role_id'=>$detailData->id,'menu_key'=>$item])){
                        DB::rollback();
                        return $this->returnJson(false,'新增菜单失败','all');
                    }
                }
            }

            //删除原有资源
            foreach($resources as $key=>$item){
                if(!in_array($item,array_values($data['resources']))){
                    if(!ResourcesRole::destroy($key)){
                        DB::rollback();
                        return $this->returnJson(false,'删除原有资源失败','all');
                    }
                }
            }
            //新增资源
            foreach($data['resources'] as $key=>$item){
                if(!in_array($item,array_values($resources))){
                    if(!ResourcesRole::create(['role_id'=>$detailData->id,'resources_key'=>$item])){
                        DB::rollback();
                        return $this->returnJson(false,'新增资源失败','all');
                    }
                }
            }

            $detailData->name = $data['name'];
            $role = $detailData->save();
            if(!$role){
                DB::rollback();
                return $this->returnJson(false,'修改角色失败','all');
            }

            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            $menu = [];$resources = [];
            $menu_return = MenuRole::where('role_id','=',$detailData->id)->get()->toArray();
            foreach($menu_return as $key=>$item){
                $menu[] = $item['menu_key'];
            }

            $resources_return = ResourcesRole::where('role_id','=',$detailData->id)->get()->toArray();
            foreach($resources_return as $key=>$item){
                $resources[] = $item['resources_key'];
            }
        }
        return view('admin/common/edit',[
            'title'=>WEBNAME.' - 修改角色',
            'form'=>$this->form,
            'detailData'=>$detailData,
            'authority' => $authority,
            'menu_return' => $menu,
            'resources_return' => $resources
        ]);
    }

    public function seeRole(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Role::where('id','=',$paramsData['id'])->first();
        if(!$data){
            abort(404);
        }

        $authority = Config::get('authority');

        //数据库资源
        $menuRole = MenuRole::where('role_id','=',$data->id)->get();
        $resourcesRole = ResourcesRole::where('role_id','=',$data->id)->get();
        $data->menu = '';
        $data->resources = '';
        //本地资源
        foreach($authority as $key=>$item){
            foreach($menuRole as $k=>$menu){
                if(in_array($menu->menu_key,array_keys($item['menu']))){
                    $data->menu .= $item['menu'][$menu->menu_key]['title'].'&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }

            foreach($resourcesRole as $k=>$resources){
                if(in_array($resources->resources_key,array_keys($item['resources']))){
                    $data->resources .= $item['resources'][$resources->resources_key].'&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
        }
        return view('admin/common/view',['title'=>WEBNAME.' - 查看角色','form'=>$this->form,'data'=>$data]);
    }

    public function deleteRole(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的角色','all');
            }
            $idArray = explode(',',$data['ids']);
            $userCount = AdminUserRole::whereIn('role_id',$idArray)->count();
            if($userCount > 0){
                return $this->returnJson(false,'该角色有管理员拥有，不可删除','all');
            }

            $departmentCount = DepartmentRole::whereIn('role_id',$idArray)->count();
            if($departmentCount > 0){
                return $this->returnJson(false,'该角色有部门拥有，不可删除','all');
            }

            DB::beginTransaction();
            $return = Role::whereIn('id',array_values($idArray))->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'角色删除失败','all');
            }
            MenuRole::whereIn('role_id',$idArray)->delete();
            ResourcesRole::whereIn('role_id',$idArray)->delete();
            DB::commit();
            return $this->returnJson(true,'','all');
        }
    }
}