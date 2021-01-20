<?php

namespace App\Http\Controllers\Admin;

use App\Models\Authority\AdminUserRole;
use App\Models\Authority\DepartmentRole;
use App\Models\Authority\Menu;
use App\Models\Authority\MenuRole;
use App\Models\Authority\Modular;
use App\Models\Authority\Resources;
use App\Models\Authority\ResourcesRole;
use App\Models\Finance\IntegexchangeLog;
use App\Models\Finance\WithdrawalsLog;
use App\Models\Goods\Goods;
use App\Models\OrderInfo;
use App\Models\OrderReturn;
use App\Models\QrCode\QrCode;
use App\Models\User;
use App\Models\Store;
use App\Models\Userinfo;
use Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     ** 登录
     **
     */
    public function authenticate(Request $request)
    {

        if(Auth::check()){
            return redirect('/');
        }
        if($_POST){
            //获取参数
            $params = ['captcha'=>'string','name'=>'string','password'=>'string'];
            $data = $this->getInput([],$params,$request);

            //验证参数
            $value = Session::get('captcha','default');
            if(empty($data['name'])){
                return view('admin/login4',['data'=>$this->returnJson(false,'用户名不能为空！','all')]);
                //$error['name'] = '用户名不能为空';
            }elseif(empty($data['password'])){
                return view('admin/login4',['data'=>$this->returnJson(false,'密码不能为空！','all')]);
                //$error['password'] = '密码不能为空';
            }
//            elseif(empty($data['captcha'])){
//                return view('admin/login4',['data'=>$this->returnJson(false,'验证码不能为空！','all')]);
//                //$error['captcha'] = '验证码不能为空';
//            }elseif($value != $data['captcha']){
//                return view('admin/login4',['data'=>$this->returnJson(false,'验证码错误！','all')]);
//                //$error['captcha'] = '验证码错误';
//            }
            else{
                if (Auth::attempt(['name' => $data['name'], 'password' => $data['password']],false)){
                    $user = $request->user();
                    Session::put('user',$user);
                    $cookie = Cookie::queue('is_login',$data['name'],60*5);
                    //return redirect()->intended('dashboard');//返回默认路径
                    //return redirect()->intended('/');//返回默认路径
                    $this->getAuthority();
                    return redirect('/');
                }else{
                    return view('admin/login4',['data'=>$this->returnJson(false,'用户名或密码错误！','all')]);
                }
            }
            //return view('admin/login4',['data'=>$this->returnJson(false,$error,'input')]);
        }
        return view('admin/login4');
    }

    /**
     * 加入权限
     */
    public function setAuthority(){
          $r = new Resources();
        $r->getResources();
//        $authority = Config::get('authority');
//        DB::beginTransaction();
//        foreach($authority as $key=>$item){
//            $modular = [
//                'modular_key' => $key,
//                'modular_ico' => $item['ico'],
//                'modular_title' => $item['title'],
//            ];
//            $modular = Modular::create($modular);
//            if(!$modular){
//                DB::rollback();
//                echo "模块失败！";die;
//            }
//            foreach($item['menu'] as $mk=>$m){
//                $menu = [
//                    'modular_id' => $modular->id,
//                    'menu_key' => $mk,
//                    'menu_title' => $m['title'],
//                    'menu_url' => $m['url'],
//                ];
//                $menu = Menu::create($menu);
//                if(!$menu){
//                    DB::rollback();
//                    echo "菜单失败！";die;
//                }
//            }
//            foreach($item['resources'] as $rk=>$r){
//                $resources = [
//                    'modular_id' => $modular->id,
//                    'resources_key' => $rk,
//                    'resources_title' => $r,
//                ];
//                $resources = Resources::create($resources);
//                if(!$resources){
//                    DB::rollback();
//                    echo "菜单失败！";die;
//                }
//            }
//        }
//        DB::commit();
//        echo '导入成功';die;
    }

    public function getAuthority(){
        $user = Session::get('user');

        if(!Session::has('authority')){
            $roles = [];
            $department_role = DepartmentRole::select(['role_id'])->where('department_id','=',$user->dept_id)->get();
            $adminUserRole = AdminUserRole::select(['role_id'])->where('admin_user_id','=',$user->id)->get();
            foreach($department_role as $key=>$item){
                $roles[] = $item->role_id;
            }

            foreach($adminUserRole as $key=>$item){
                if(!in_array($item->role_id,array_values($roles))){
                    $roles[] = $item->role_id;
                }
            }

            $menu = MenuRole::select(['menu_key'])->whereIn('role_id',$roles)->orderBy('sort','asc')->groupBy('menu_key')->get()->toArray();
            $resources = ResourcesRole::select(['resources_key'])->whereIn('role_id',$roles)->groupBy('resources_key')->get()->toArray();

            $authority['menu'] = [];
            $authority['resources'] = [];
            foreach($menu as $key=>$item){
                $authority['menu'][] = $item['menu_key'];
            }
            foreach($resources as $key=>$item){
                $authority['resources'][] = $item['resources_key'];
            }
            Session::put('authority',$authority);
        }
    }

    /**
     **重新登录
     **
     */
    public function login2(Request $request){
        if(Auth::check()){
            return redirect('/');
        }elseif(!Cookie::get('is_login')){
            return redirect('/login');
        }
        if($_POST){
            //获取参数
            $params = ['password'=>'string'];
            $data = $this->getInput([],$params,$request);
            $data['name'] = Cookie::get('is_login');
            //验证参数
            if(empty($data['password'])){
                $error['password'] = '密码不能为空';
            }else{
                if (Auth::attempt(['name' => $data['name'], 'password' => $data['password']],false)){
                    $user = $request->user();
                    Session::put('user',$user);
                    Cookie::queue('is_login',$data['name'],60*5);
                    return redirect('/');
                }else{
                    return view('admin/lockscreen3',['data'=>$this->returnJson(false,'密码错误！','all'),'name'=>$data['name']]);
                }
            }
            return view('admin/lockscreen3',['data'=>$this->returnJson(false,$error,'input'),'name'=>$data['name']]);
        }
        return view('admin/lockscreen3',['name'=>Cookie::get('is_login')]);
    }

    public function index(){
        //$authorityData = Config::get('authority');
        $r = new Resources();
        $authorityData = $r->getResources();
        foreach($authorityData as $key=>$item){
            unset($authorityData[$key]['resources']);
        }
        $this->getAuthority();
        $authority = Session::get('authority');

        $menu = [];
        foreach($authorityData as $key=>$item){
            foreach($authority['menu'] as $k=>$val){
                if(in_array($val,array_keys($item['menu']))){
                    if(!isset($menu[$key])){
                        $menu[$key] = $item;
                        unset($menu[$key]['menu']);
                        $menu[$key]['menu'][$val] = $item['menu'][$val];
                    }else{
                        $menu[$key]['menu'][$val] = $item['menu'][$val];
                    }
                }
            }
        }

        return view('admin/index',['title'=>WEBNAME.' - 首页','menu'=>$menu]);
    }

    /**
     **退出
     **ljf
     */
    public function userOut(){
        $user = Session::get('user');
        $user->access_key;
        Auth::logout();
        Session::forget('authority');
        Session::forget('resources');
        Session::forget('user');
        Session::forget($user->access_key.'tongjiData');
        Cookie::queue('is_login', null , -1); // 销毁
        return redirect('login');
    }

    public function home(){
            return view('admin/tongji',['title'=>WEBNAME.' - 统计数据']);
    }

    public function rankinglist(){
        $user = Session::get('user');
        if(!Session::has($user->access_key.'paihang')){
            //用户剩余总积分
            $data['zongjifen'] = Userinfo::leftJoin('user', 'user_info.user_id', '=', 'user.id')->where('user_type',2)->sum('integral');
            //积分榜
            $data['jifenpaihang'] = QrCode::select(DB::raw('count(tg_qr_code.integral) as integralCount,user_nickname,tg_qr_code.city,sum(tg_qr_code.integral) as integral'))
                ->where('user_type','2')
                ->where('qr_code.access_key','=',$user->access_key)
                ->where('qr_code.user_id','!=','')
                ->where('status','=','1')
                ->leftJoin('user_info', 'qr_code.user_id', '=', 'user_info.user_id')
                ->groupBy('qr_code.user_id')->orderBy('integralCount','desc')->take(5)->get();
            //工种榜
            $data['gongzhongbang'] = DB::table('work_type')
                ->select(DB::raw('sum(tg_user_info.integral) as integralCount,tg_work_type.name'))
                ->leftJoin('user', 'work_type.id', '=', 'user.work_type_id')
                ->leftJoin('user_info', 'user.id', '=', 'user_info.user_id')
                ->where('work_type.access_key','=',$user->access_key)
                ->groupBy('user.work_type_id')
                ->orderBy('integralCount','desc')
                ->take(5)->get();
            //地区榜
            $data['diqubang'] = User::select(DB::raw('sum(integral) as integralCount,city'))
                ->where('city','!=','')
                ->leftJoin('user_info', 'user.id', '=', 'user_info.user_id')
                ->where('user_type',2)
                ->where('user.access_key','=',$user->access_key)
                ->groupBy('city')
                ->orderBy('integralCount','desc')
                ->take(5)->get();
            //业绩榜
            $data['yejibang'] = DB::select('select t.nickname,(select sum(goods_amount) from tg_order_info where access_token = t.access_token and pay_status = 2) as yeji,(select city from tg_user_info where user_id = t.id) as city,(select count(id) from tg_user where distributor_id = t.id) as zong from tg_user as t where t.user_type = 1 and t.access_key = "'.$user->access_key.'" order by yeji desc limit 5');
            //地区榜
            $data['jxs_diqubang'] = DB::select("select t.city,count(k.id) as zong,(select sum(goods_amount) from tg_order_info where pay_status = 2 and access_token in ((select access_token from tg_user where id in(select user_id from tg_user_info where city = t.city) and user_type = 1))) as yeji from tg_user_info as t left join tg_user as k on t.user_id = k.id where k.user_type = 1 and t.access_key = '".$user->access_key."' group by city order by yeji desc limit 5");
            //总业绩（经销商）
            $data['zongjine'] = DB::select("select sum(goods_amount) as zong from tg_order_info where pay_status = 2 and access_token in ((select access_token from tg_user where user_type =1 and access_key = '".$user->access_key."')) and access_key = '".$user->access_key."'");
            Session::put($user->access_key.'paihang',$data);
        }else{
            $data = Session::get($user->access_key.'paihang');
        }
        return view('admin/tongji/rankinglist',['title'=>WEBNAME.' - 排行榜','data'=>$data]);
    }
}