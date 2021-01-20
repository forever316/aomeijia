<?php

namespace App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Controller;
use App\Models\Goods\DistributorLevel;
use App\Models\OrderInfo;
use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DistributorController extends Controller
{
    private $form = [];
    private $access_key = '';

    public function __construct(){
        $user = Session::get('user');
        $this->access_key = $user->access_key;
        $action = $this->getCurrentAction();
        $formUrl = 'models.member.distributor.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function ajaxDistributorList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $searchText = Input::get('title',0);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            DB::connection()->enableQueryLog();
            //数据获取与处理
            $user = new User();
            $userCount = new User();
            $query = $user->select(['id','nickname']);
            if(!empty($searchText)){
                $query = $query->where(function($query)use($searchText){
                        $query->where('nickname', '=', $searchText)
                        ->orWhere('id', '=', $searchText)
                        ->orWhere('phone', '=', $searchText);
                });
                $userCount = $userCount->where(function($userCount)use($searchText){
                        $userCount->where('nickname', '=', $searchText)
                        ->orWhere('id', '=', $searchText)
                        ->orWhere('phone', '=', $searchText);
                });
            }

            $query = $query->where('user_type','=',1);
            $userCount = $userCount->where('user_type','=',1);
            $query = $query->where('access_key','=',$this->access_key);
            $userCount = $userCount->where('access_key','=',$this->access_key);

            $dataList1 = $query->orderBy($sort,$order)->with('userInfo')->paginate(5);
            $arr['total'] = $userCount->count();
            $dataList1 = $dataList1->toArray();
            foreach ($dataList1['data'] as $key=>$row){
                $arr['rows'][$key]['id'] = $row['id'];
                $arr['rows'][$key]['nickname'] = $row['nickname'];
                $arr['rows'][$key]['city'] = $row['user_info']['province'].'-'.$row['user_info']['city'];
            }
            return response()->json($arr);
        }
    }

    public function distributorList(Request $request){
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
            $query = $user->select(['id','nickname','phone','created_at','access_token']);
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    $query = $query->where($k,'=',$v);
                    $userCount = $userCount->where($k,'=',$v);
                }
            }

            $query = $query->where('user_type','=',1);
            $userCount = $userCount->where('user_type','=',1);
            $query = $query->where('access_key','=',$this->access_key);
            $userCount = $userCount->where('access_key','=',$this->access_key);

            $dataList1 = $query->orderBy($sort,$order)->with('userInfo')->paginate(10);
            $arr['total'] = $userCount->count();
            $dataList1 = $dataList1->toArray();
            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    $arr['rows'][$key][$k] = $row[$k];
                }
                $arr['rows'][$key]['city'] = $row['user_info']['province'].'-'.$row['user_info']['city'];
                $arr['rows'][$key]['discount'] = $row['user_info']['discount'];
                $arr['rows'][$key]['created_at'] = $row['created_at'];
                $arr['rows'][$key]['balance'] = $row['user_info']['balance'];
                $arr['rows'][$key]['integral'] = $row['user_info']['integral'];
                $arr['rows'][$key]['yeji'] = OrderInfo::where('access_token',$row['access_token'])->where('pay_status',2)->sum('goods_amount');
            }
            return response()->json($arr);
        }else{
            $this->form['field']['city'] = ['text'=>'地区'];
            //$this->form['field']['discount'] = ['text'=>'折扣'];
            $this->form['field']['balance'] = ['text'=>'余额'];
            $this->form['field']['integral'] = ['text'=>'积分'];
            $this->form['field']['yeji'] = ['text'=>'业绩'];
            $this->form['field']['created_at'] = ['text'=>'录入时间'];
            return view('admin/common/list',['title'=>WEBNAME.' - 经销商列表','form'=>$this->form]);
        }
    }

    public function distributorAdd(Request $request){
        if($_POST){
            $recommend_id = Input::get('recommend_id');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $password2 = Input::get('password2');
            $legal_person = Input::get('legal_person');
            $address = Input::get('address');
            //$discount = Input::get('discount',0);
            $province = Input::get('province',0);
            $city = Input::get('city',0);
            $head_portrait = Input::get('head_portrait',0);
            $level_id = Input::get('level_id',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($level_id)){
                return $this->returnJson(false,'请选择经销商等级','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
            }
            if(empty($legal_person)){
                return $this->returnJson(false,'法人代表不可为空','all');
            }
//            if(!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$discount)){
//                return $this->returnJson(false,'折扣范围不正确','all');
//            }else{
//                if($discount > 1 || $discount < 0){
//                    return $this->returnJson(false,'折扣范围不正确','all');
//                }
//            }
            if(empty($province) || empty($city)){
                return $this->returnJson(false,'地区不可为空','all');
            }
            if(empty($address)){
                return $this->returnJson(false,'地址不可为空','all');
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
            DB::beginTransaction();
            $member['birthday'] = $birthday;
            $member['sex'] = $sex;
            $member['head_portrait'] = $head_portrait;
            $member['nickname'] = $nickname;
            $member['phone'] = $phone;
            $member['password'] = bcrypt($password);
            $member['user_type'] = 1;
            $member['recommend_id'] = $recommend_id;
            $member['level_id'] = $level_id;
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

            $memberInfo['user_id'] = $memberModel->id;
            $memberInfo['legal_person'] = $legal_person;
            $memberInfo['address'] = $address;
            //$memberInfo['discount'] = $discount;
            $memberInfo['province'] = $province;
            $memberInfo['city'] = $city;
            $memberInfo['access_key'] = $this->access_key;
            $memberInfoModel = Userinfo::create($memberInfo);
            if(!$memberInfoModel){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }
        $distributorLevel = DistributorLevel::where('access_key',$this->access_key)->get();
        foreach($distributorLevel as $key=>$val){
            $this->form['field']['level_id']['value'][$val->id] = $val->name;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加经销商','form'=>$this->form]);
    }

    public function distributorUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = user::where('id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            $recommend_id = Input::get('recommend_id');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $password2 = Input::get('password2');
            $legal_person = Input::get('legal_person');
            $address = Input::get('address');
            //$discount = Input::get('discount',0);
            $province = Input::get('province',0);
            $city = Input::get('city',0);
            $head_portrait = Input::get('head_portrait',0);
            $level_id = Input::get('level_id',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($level_id)){
                return $this->returnJson(false,'请选择经销商等级','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
            }
            if(empty($legal_person)){
                return $this->returnJson(false,'法人代表不可为空','all');
            }
//            if(!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$discount)){
//                return $this->returnJson(false,'折扣范围不正确','all');
//            }else{
//                if($discount > 1 || $discount < 0){
//                    return $this->returnJson(false,'折扣范围不正确','all');
//                }
//            }
            if(empty($province) || empty($city)){
                return $this->returnJson(false,'地区不可为空','all');
            }
            if(empty($address)){
                return $this->returnJson(false,'地址不可为空','all');
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
            $detailData->phone = $phone;
            $detailData->level_id = $level_id;
            if(!empty($password)){
                $detailData->password = bcrypt($password);
            }
            DB::beginTransaction();
            if(!$detailData->save()){
                DB::rollback();
                return $this->returnJson(false,'用户修改失败','all');
            }
            $memberInfo['legal_person'] = $legal_person;
            $memberInfo['address'] = $address;
            //$memberInfo['discount'] = $discount;
            $memberInfo['province'] = $province;
            $memberInfo['city'] = $city;
            $userInfoUp = Userinfo::where('user_id','=',$detailData->id)->update($memberInfo);
            if(!$userInfoUp){
                DB::rollback();
                return $this->returnJson(false,'用户信息修改失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }else{
            $distributorLevel = DistributorLevel::where('access_key',$this->access_key)->get();
            foreach($distributorLevel as $key=>$val){
                $this->form['field']['level_id']['value'][$val->id] = $val->name;
            }
            $detailData->province = $detailData->Userinfo->province;
            $detailData->city = $detailData->Userinfo->city;
            $detailData->legal_person = $detailData->Userinfo->legal_person;
            $detailData->address = $detailData->Userinfo->address;
            $detailData->discount = $detailData->Userinfo->discount;
            $detailData->password = '';
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改经销商','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function distributorDetail(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $user = User::where('id','=',$paramsData['id'])->where('access_key','=',$this->access_key)->first();
        //$userInfo = Userinfo::where('user_id','=',$paramsData['id'])->first();
        $data['id'] = $user->id;
        $data['nickname'] = $user->nickname;
        $data['sex'] = $user->sex;
        $data['birthday'] = $user->birthday;
        $data['phone'] = $user->phone;
        $data['recommend_id'] = '无推荐人';
        $data['recommend'] = '无推荐人';
        $data['legal_person'] = $user->userInfo->legal_person;
        $data['address'] = $user->userInfo->address;
        $data['discount'] = $user->userInfo->discount;
        $data['city'] = $user->userInfo->province.'-'.$user->userInfo->city;
        $data['balance'] = $user->userInfo->balance;
        $data['updated_at'] = $user->userInfo->updated_at;
        $data['created_at'] = $user->created_at;
        $data['head_portrait'] = $user->head_portrait;
        if(!empty($user->recommend_id)){
            $recommend = User::find($user->recommend_id);
            if($recommend){
                $data['recommend_id'] = $user->recommend_id;
                $data['recommend'] = $recommend->nickname;
            }
        }
        return view('admin/common/view',['title'=>WEBNAME.' - 查看Banner','form'=>$this->form,'data'=>$data]);
    }

    public function distributorDelete(Request $request){
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