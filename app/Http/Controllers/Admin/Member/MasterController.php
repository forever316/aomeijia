<?php

namespace App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Controller;
use App\Models\QrCode\QrCode;
use App\Models\User;
use App\Models\Userinfo;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MasterController  extends Controller
{
    private $form = [];
    private $access_key = '';

    public function __construct(){
        $user = Session::get('user');
        $this->access_key = $user->access_key;
        $action = $this->getCurrentAction();
        $formUrl = 'models.member.master.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function masterList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','nickname'=>'string','phone'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $user = new User();
            $userCount = new User();
            $query = $user->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    $query = $query->where($k,'=',$v);
                    $userCount = $userCount->where($k,'=',$v);
                }
            }

            $query = $query->where('user_type','=',2);
            $userCount = $userCount->where('user_type','=',2);
            $query = $query->where('access_key','=',$this->access_key);
            $userCount = $userCount->where('access_key','=',$this->access_key);

            $dataList1 = $query->orderBy($sort,$order)->with('workType')->with('userInfo')->paginate(10);
            $arr['total'] = $userCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'distributor_id'){
                        $distributor = User::find($row[$k]);
                        if($distributor){
                            $arr['rows'][$key][$k] = $distributor->nickname;
                        }else{
                            $arr['rows'][$key][$k] = '数据错误';
                        }
                    }elseif($k == 'work_type_id'){
                        if(!empty($row['work_type']['name'])){
                            $arr['rows'][$key][$k] = $row['work_type']['name'];
                        }else{
                            $arr['rows'][$key][$k] = '普通用户';
                        }
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
                $arr['rows'][$key]['balance'] = $row['user_info']['balance'];
                $arr['rows'][$key]['integral'] = $row['user_info']['integral'];
                $arr['rows'][$key]['xiaoliang'] = QrCode::where('user_id',$row['id'])->count();
                $arr['rows'][$key]['huodejifen'] = QrCode::where('user_id',$row['id'])->sum('integral');
            }
            return response()->json($arr);
        }else{
            $this->form['field']['balance'] = ['text'=>'余额'];
            $this->form['field']['xiaoliang'] = ['text'=>'销量'];
            $this->form['field']['huodejifen'] = ['text'=>'获得积分'];
            $this->form['field']['integral'] = ['text'=>'剩余积分'];
            return view('admin/common/list',['title'=>WEBNAME.' - 师傅列表','form'=>$this->form]);
        }
    }

    public function masterAdd(Request $request){
        if($_POST){
            $recommend_id = Input::get('recommend_id');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $password2 = Input::get('password2');
            $distributor_id = Input::get('distributor_id',0);
            $work_type_id = Input::get('work_type_id',0);
            $head_portrait = Input::get('head_portrait',0);
            $city = Input::get('city',0);
            $province = Input::get('province',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
            }
            if(empty($work_type_id)){
                return $this->returnJson(false,'请选择师傅工种','all');
            }
            if(empty($distributor_id)){
                return $this->returnJson(false,'请选择经销商','all');
            }
            if(empty($password) || empty($password2)){
                return $this->returnJson(false,'密码与确认密码不可为空','all');
            }else{
                if($this->abslength($password) < 6 || $this->abslength($password) > 15){
                    return $this->returnJson(false,'密码长度为6-15位','all');
                }else{
                    if($password != $password2){
                        return $this->returnJson(false,'密码与确认密码不相同','all');
                    }
                }
            }
            if(empty($phone)){
                return $this->returnJson(false,'手机号码不可为空','all');
            }else{
                $pattern='/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
                if(!preg_match($pattern, $phone)){
                    return $this->returnJson(false,'手机号码格式不正确','all');
                }else{
                    $memberCount = User::where('access_key','=',$this->access_key)->where('phone','=',$phone)->count();
                    if($memberCount > 0){
                        return $this->returnJson(false,'该手机号码已被使用','all');
                    }
                }
            }

            if(empty($province)){
                return $this->returnJson(false,'请选择省份','all');
            }
            if(empty($city)){
                return $this->returnJson(false,'请选择城市','all');
            }

            $sex = Input::get('sex',0);
            $birthday = Input::get('birthday',0);
            if(empty($sex)){
                return $this->returnJson(false,'请选择性别','all');
            }
            if(empty($birthday)){
                return $this->returnJson(false,'请选择出生日期','all');
            }

            if(!empty($recommend_id)){
                $user = User::where('access_key','=',$this->access_key)->where(function($query)use($recommend_id){
                        $query->where('id', '=', $recommend_id)
                        ->orWhere('phone', '=', $recommend_id);
                })->first();
                if(!$user){
                    return $this->returnJson(false,'该推荐人不存在','all');
                }
                if($user->phone == $recommend_id){
                    $recommend_id = $user->id;
                }
            }
            $distributor = Userinfo::where('user_id','=',$distributor_id)->where('access_key','=',$this->access_key)->first();
            if(!$distributor){
                return $this->returnJson(false,'经销商不存在','all');
            }
            DB::beginTransaction();
            $member['sex'] = $sex;
            $member['birthday'] = $birthday;
            $member['head_portrait'] = $head_portrait;
            $member['nickname'] = $nickname;
            $member['work_type_id'] = $work_type_id;
            $member['phone'] = $phone;
            $member['password'] = bcrypt($password);
            $member['user_type'] = 2;
            $member['recommend_id'] = $recommend_id;
            $member['distributor_id'] = $distributor_id;
            $member['access_key'] = $this->access_key;
            $memberModel = User::create($member);
            if(!$memberModel){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }

            $memberModel->access_token = create_token($memberModel->id);
            if(!$memberModel->save()){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }

            $memberInfo['province'] = $province;
            $memberInfo['city'] = $city;
            $memberInfo['user_id'] = $memberModel->id;
            $memberInfo['access_key'] = $this->access_key;
            $memberInfoModel = Userinfo::create($memberInfo);
            if(!$memberInfoModel){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            $workTypeList = WorkType::where('access_key','=',$this->access_key)->get();
            foreach($workTypeList as $item){
                $this->form['field']['work_type_id']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加师傅','form'=>$this->form]);
    }

    public function masterUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = User::where('id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            $recommend_id = Input::get('recommend_id');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $distributor_id = Input::get('distributor_id',0);
            $work_type_id = Input::get('work_type_id',0);
            $head_portrait = Input::get('head_portrait',0);
            $city = Input::get('city',0);
            $province = Input::get('province',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
            }
            if(empty($work_type_id)){
                return $this->returnJson(false,'请选择师傅工种','all');
            }
            if(empty($distributor_id)){
                return $this->returnJson(false,'请选择经销商','all');
            }
            if(!empty($password) || !empty($password2)){
                if($this->abslength($password) < 6 || $this->abslength($password) > 15){
                    return $this->returnJson(false,'密码长度为6-15位','all');
                }else{
                    if($password != $password2){
                        return $this->returnJson(false,'密码与确认密码不相同','all');
                    }
                }
            }
            if(empty($phone)){
                return $this->returnJson(false,'手机号码不可为空','all');
            }else{
                $pattern='/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
                if(!preg_match($pattern, $phone)){
                    return $this->returnJson(false,'手机号码格式不正确','all');
                }else{
                    $memberCount = User::where('access_key','=',$this->access_key)->where('phone','=',$phone)->where('id','!=',$detailData->id)->count();
                    if($memberCount > 0){
                        return $this->returnJson(false,'该手机号码已被使用','all');
                    }
                }
            }

            if(empty($province)){
                return $this->returnJson(false,'请选择省份','all');
            }
            if(empty($city)){
                return $this->returnJson(false,'请选择城市','all');
            }

            $sex = Input::get('sex',0);
            $birthday = Input::get('birthday',0);
            if(empty($sex)){
                return $this->returnJson(false,'请选择性别','all');
            }
            if(empty($birthday)){
                return $this->returnJson(false,'请选择出生日期','all');
            }

            if(!empty($recommend_id)){
                $user = User::where('access_key','=',$this->access_key)->where(function($query)use($recommend_id){
                    $query->where('id', '=', $recommend_id)
                        ->orWhere('phone', '=', $recommend_id);
                })->first();
                if(!$user){
                    return $this->returnJson(false,'该推荐人不存在','all');
                }
                if($user->phone == $recommend_id){
                    $recommend_id = $user->id;
                }
            }

            $detailData->sex = $sex;
            $detailData->birthday = $birthday;
            $detailData->head_portrait = $head_portrait;
            $detailData->recommend_id = $recommend_id;
            $detailData->nickname = $nickname;
            $detailData->work_type_id = $work_type_id;
            $detailData->phone = $phone;
            $detailData->distributor_id = $distributor_id;
            if(!empty($password)){
                $detailData->password = bcrypt($password);
            }
            $distributor = Userinfo::where('user_id','=',$distributor_id)->where('access_key','=',$this->access_key)->first();
            if(!$distributor){
                return $this->returnJson(false,'经销商不存在','all');
            }
            $userInfo = Userinfo::where('user_id','=',$detailData->id)->where('access_key','=',$this->access_key)->first();
            if(!$distributor){
                return $this->returnJson(false,'用户信息不存在','all');
            }
            DB::beginTransaction();
            if(!$detailData->save()){
                DB::rollback();
                return $this->returnJson(false,'用户修改失败','all');
            }
            $userInfo->province = $province;
            $userInfo->city = $city;
            if(!$userInfo->save()){
                DB::rollback();
                return $this->returnJson(false,'用户信息修改失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            $distributor = User::where('id','=',$detailData->distributor_id)->where('access_key','=',$this->access_key)->first();
            if($distributor){
                $detailData->distributor = $distributor->nickname;
            }
            $detailData->password = '';

            $workTypeList = WorkType::where('access_key','=',$this->access_key)->get();
            foreach($workTypeList as $item){
                $this->form['field']['work_type_id']['value'][$item->id] = $item->name;
            }
            $detailInfoData = Userinfo::where('user_id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
            if(!$detailInfoData){
                abort(404);
            }
            $detailData['city'] = $detailInfoData->city;
            $detailData['province'] = $detailInfoData->province;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改师傅','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function masterDetail(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $user = User::where('id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
        if(!$user){
            abort(404);
        }
        $userInfo = Userinfo::where('user_id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
        if(!$userInfo){
            abort(404);
        }
        $data['id'] = $user->id;
        $data['nickname'] = $user->nickname;
        $data['phone'] = $user->phone;
        $data['sex'] = $user->sex;
        $data['birthday'] = $user->birthday;
        $data['recommend_id'] = '无推荐人';
        $data['recommend'] = '无推荐人';
        $data['distributor_id'] = '无推荐人';
        $data['distributor'] = '无推荐人';
        $data['balance'] = $userInfo->balance;
        $data['updated_at'] = $userInfo->updated_at;
        $data['created_at'] = $user->created_at;
        $data['head_portrait'] = $user->head_portrait;
        if(!empty($user->recommend_id)){
            $recommend = User::find($user->recommend_id);
            if($recommend){
                $data['recommend_id'] = $user->recommend_id;
                $data['recommend'] = $recommend->nickname;
            }
        }
        if(!empty($user->distributor_id)){
            $distributor = User::find($user->distributor_id);
            if($distributor){
                $data['distributor_id'] = $user->distributor_id;
                $data['distributor'] = $distributor->nickname;
            }
        }
        return view('admin/common/view',['title'=>WEBNAME.' - 查看Banner','form'=>$this->form,'data'=>$data]);
    }

    public function masterDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            DB::beginTransaction();
            $return = User::whereIn('id',$ids)->where('access_key','=',$this->access_key)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除失败（用户）','all');
            }
            $affectedRows = Userinfo::whereIn('user_id',$ids)->where('access_key','=',$this->access_key)->delete();
            if(!$affectedRows){
                DB::rollback();
                return $this->returnJson(false,'删除失败（信息）','all');
            }
            DB::commit();
            $affectedRows = UserReceipt::whereIn('user_id',$ids)->where('access_key','=',$this->access_key)->delete();
            return $this->returnJson(true,'','all');
        }
    }
}