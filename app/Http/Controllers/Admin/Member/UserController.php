<?php

namespace App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Controller;
use App\Models\Goods\DistributorLevel;
use App\Models\User;
use App\Models\Distributor_apply_log;
use App\Models\Userinfo;
use App\Models\User_relations;
use App\Models\UserReceipt;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    private $form = [];
    private $status = [
        '-1'=>'待审核',
        '1'=>'审核成功',
        '-2'=>'审核失败'
    ];
   // private $access_key = '';

    public function __construct(){
        $user = Session::get('user');
       // $this->access_key = $user->access_key;
        $action = $this->getCurrentAction();
        $formUrl = 'models.member.user.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function userList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','nickname'=>'string','phone'=>'string','type'=>'string','number'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $user = new User();
            $userCount = new User();
            $query = $user->select(['*']);

            //搜索功能
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k=='type'){
                        if($v==2){
                            $query = $query->where('agent_status','=',1);
                            $userCount = $userCount->where('agent_status','=',1);
                        }elseif($v==3){
                            $query = $query->where('channel_status','=',1);
                            $userCount = $userCount->where('channel_status','=',1);
                        }elseif($v==4){
                            $query = $query->where('business_status','=',1);
                            $userCount = $userCount->where('business_status','=',1);
                        }elseif($v==1){
                            $query = $query->where('business_status','=',0)->where('agent_status','=',0)->where('channel_status','=',0);
                            $userCount = $userCount->where('business_status','=',0)->where('agent_status','=',0)->where('channel_status','=',0);
                        }else{
                            $query = $query->where($k,'=',$v);
                            $userCount = $userCount->where($k,'=',$v);
                        }
                    }elseif($k=='number'){
                        $query = $query->where('channel_num','like','%'.$v.'%')->orWhere('agent_num','like','%'.$v.'%');
                        $userCount = $userCount->where('channel_num','like','%'.$v.'%')->orWhere('agent_num','like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $userCount = $userCount->where($k,'=',$v);
                    }
                    }
                }


            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $userCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'channel_status'||$k == 'agent_status'||$k=='business_status'){
                        $arr['rows'][$key][$k] = $row[$k]==1?'是':'否';
//                        if($row['channel_status']==1){
//                            $arr['rows'][$key][$k] = '渠道商';
//                        }elseif($row['agent_status']==1){
//                            $arr['rows'][$key][$k] = '代理商';
//                        }elseif($row['business_status']==1){
//                            $arr['rows'][$key][$k] = '商家';
//                        }else{
//                            $arr['rows'][$key][$k] = '普通用户';
//                        }
                    }elseif($k == 'agent_status'){

                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 普通用户列表','form'=>$this->form]);
        }
    }

    public function userAdd(Request $request){
        if($_POST){
            $recommend_id = Input::get('recommend_id','0');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $password2 = Input::get('password2');
            $head_portrait = Input::get('head_portrait',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
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
                    $memberCount = User::where('phone','=',$phone)->count();
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
                $user = User::where(function($query)use($recommend_id){
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
            $member['sex'] = $sex;
            $member['birthday'] = $birthday;
            $member['head_portrait'] = $head_portrait;
            $member['nickname'] = $nickname;
            $member['phone'] = $phone;
            $member['password'] = bcrypt($password);
            $member['pid'] = $recommend_id;
//            $member['access_key'] = $this->access_key;
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
            $memberInfo['province'] = Input::get('province','0');
            $memberInfo['city'] = Input::get('city','0');
//            $memberInfo['access_key'] = $this->access_key;
            $memberInfoModel = Userinfo::create($memberInfo);
            if(!$memberInfoModel){
                DB::rollback();
                return $this->returnJson(false,'用户创建失败','all');
            }

            //分销关系表
            if($recommend_id){
                $first = User_relations::create(['level'=>2,'pid'=>$recommend_id,'child_id'=>$memberModel->id]);
                if(!$first){
                    DB::rollback();
                    return $this->returnJson(false,'推荐关系有误(1)','all');
                }
                $recommendInfo = User::select(['id','pid'])->where('id','=',$recommend_id)->first();
                if($recommendInfo->pid){
                    $second = User_relations::create(['level'=>3,'pid'=>$recommendInfo->pid,'child_id'=>$memberModel->id]);
                    if(!$second){
                        DB::rollback();
                        return $this->returnJson(false,'推荐关系有误(2)','all');
                    }
                }
            }
            $result = increaseConfig('user_num');
            if($result != 'success'){
                DB::rollback();
                return '用户总额更新失败';
            }

            DB::commit();
            return $this->returnJson(true,'','all');
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加普通用户','form'=>$this->form]);
    }

    public function userUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = User::where('id','=',$paramsData['id'])->first();
        $userInfo = Userinfo::where('user_id','=',$detailData->id)->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
//            $recommend_id = Input::get('recommend_id');
            $nickname = Input::get('nickname');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $password2 = Input::get('password2');
            $head_portrait = Input::get('head_portrait',0);
            $cash_password = Input::get('cash_password',0);
            if(empty($head_portrait)){
                return $this->returnJson(false,'请上传头像','all');
            }
            if(empty($nickname)){
                return $this->returnJson(false,'名称不可为空','all');
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
            if(!empty($cash_password)){
                if($this->abslength($cash_password) !=6){
                    return $this->returnJson(false,'兑换密码长度应为6位','all');
                }
            }
            if(empty($phone)){
                return $this->returnJson(false,'手机号码不可为空','all');
            }else{
                $pattern='/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
                if(!preg_match($pattern, $phone)){
                    return $this->returnJson(false,'手机号码格式不正确','all');
                }else{
                    $memberCount = User::where('phone','=',$phone)->where('id','!=',$detailData->id)->count();
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

//            if(!empty($recommend_id)){
//                $user = User::where(function($query)use($recommend_id){
//                    $query->where('id', '=', $recommend_id)
//                        ->orWhere('phone', '=', $recommend_id);
//                })->first();
//                if(!$user){
//                    return $this->returnJson(false,'该推荐人不存在','all');
//                }
//                if($user->phone == $recommend_id){
//                    $recommend_id = $user->id;
//                }
//            }
            $detailData->sex = $sex;
            $detailData->birthday = $birthday;
//            $detailData->pid = $recommend_id;
            $detailData->nickname = $nickname;
            $detailData->phone = $phone;
            $detailData->head_portrait = $head_portrait;
            if(!empty($password)){
                $detailData->password = bcrypt($password);
            }
            if(!empty($cash_password)){
                $detailData->cash_password = bcrypt($cash_password);
            }
            if(!$detailData->save()){
                return $this->returnJson(false,'用户修改失败','all');
            }
            return $this->returnJson(true,'','all');
        }else{
            $detailData->password = '';
            if($detailData->pid){
                $recommendInfo = User::select(['*'])->where('id','=',$detailData->pid)->first();
                $detailData['recommend_id'] = $recommendInfo->nickname;
            }
            $detailData['province']=$userInfo['province'];
            $detailData['city']=$userInfo['city'];
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改普通用户','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function userDetail(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $user = User::where('id','=',$paramsData['id'])->first();
        if(!$user){
            abort(404);
        }
        $userInfo = Userinfo::where('user_id','=',$paramsData['id'])->first();
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

        $data['channel_num'] = '不是渠道商';
        $data['agent_num'] = '不是代理商';

        $data['balance'] = $userInfo->balance;
        $data['updated_at'] = $userInfo->updated_at;
        $data['created_at'] = $user->created_at;
        $data['head_portrait'] = $user->head_portrait;
        if(!empty($user->pid)){
            $recommend = User::find($user->pid);
            if($recommend){
                $data['recommend'] = $recommend->nickname;
            }
        }

        if(!empty($user->channel_status)){
                $data['channel_num'] = $user->channel_num;
        }

        if(!empty($user->agent_status)){
                $data['agent_num'] = $user->agent_num;
        }
        $data['integral'] = $userInfo->integral;
        $data['treasure_num'] = $userInfo->treasure_num;
        $data['bestir_integral'] = $userInfo->bestir_integral;
        $data['un_bestir_integral'] = $userInfo->un_bestir_integral;
        $data['cash_integral'] = $userInfo->cash_integral;
        $data['un_cash_integral'] = $userInfo->un_cash_integral;
        $data['idcard'] = $user->idcard;
        $data['idcard_pho1'] = explode(';', $user->idcard_pho);
        $data['idcard_pho'] = $user->idcard_pho;
        return view('admin/common/view',['title'=>WEBNAME.' - 查看Banner','form'=>$this->form,'data'=>$data]);
    }

    public function userDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            DB::beginTransaction();
            $return = User::whereIn('id',$ids)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除失败（用户）','all');
            }
            $affectedRows = Userinfo::whereIn('user_id',$ids)->delete();
            if(!$affectedRows){
                DB::rollback();
                return $this->returnJson(false,'删除失败（信息）','all');
            }
            DB::commit();
            $affectedRows = UserReceipt::whereIn('user_id',$ids)->delete();
            return $this->returnJson(true,'','all');
        }
    }

    public function memberReceiptList(Request $request){
        $id = Input::get('id','0');
        if(empty($id)){
            abort(404);
        }
        $member = User::where('id','=',$id)->first();
        if(!$member){
            abort(404);
        }
        if($request->ajax()){
            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort');
            if(empty($sort)){
                $sort = 'is_default';
                $order = 'asc';
            }else{
                $order = Input::get('order','asc');
            }
            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $memberReceipt = new UserReceipt();
            $memberReceiptCount = new UserReceipt();
            $query = $memberReceipt->select(array_keys($this->form['field']));
            $query = $query->where('user_id','=',$member->id);
            $memberReceiptCount = $memberReceiptCount->where('user_id','=',$member->id);
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $memberReceiptCount->count();
            $dataList1 = $dataList1->toArray();

            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['is_default'])) {
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            $this->form['data_url'] .= '?id='.$id;
            $this->form['button']['add'] .= '?id='.$id;
            return view('admin/common/list',['title'=>WEBNAME.' - 用户收货地址列表','form'=>$this->form]);
        }
    }

    public function memberReceiptAdd(Request $request){
        $id = Input::get('id',0);
        if(!$id){
            abort(404);
        }
        $member = User::where('id','=',$id)->first();
        if(!$member){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','phone'=>'string','address'=>'string','is_default'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            $province = Input::get('province');
            $city = Input::get('city');
            if(isset($data['error'])){
                unset($data['error']);
                if(empty($province) || empty($city)){
                    $data['city'] = '请选择所在城市';
                }
                return $this->returnJson(false,$data,'input');
            }else{
                if(empty($province) || empty($city)){
                    return $this->returnJson(false,['city'=>'请选择所在城市'],'input');
                }
            }
            //把不是默认修改为默认
            if($data['is_default'] == 1){
                $affectedRows = UserReceipt::where('is_default', '=', 1)->where('user_id','=',$id)->update(['is_default' => 2]);
            }
            $data['user_id'] = $id;
            $data['province'] = $province;
            $data['city'] = $city;
//            $data['access_key'] = $this->access_key;
            $return = UserReceipt::create($data);
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            $this->form['sub_url'] .= '?id='.$id;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 增加收货地址','form'=>$this->form]);
    }

    public function upMemberReceipt(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = UserReceipt::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','phone'=>'string','address'=>'string','is_default'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            $province = Input::get('province');
            $city = Input::get('city');
            if(isset($data['error'])){
                unset($data['error']);
                if(empty($province) || empty($city)){
                    $data['city'] = '请选择所在城市';
                }
                return $this->returnJson(false,$data,'input');
            }else{
                if(empty($province) || empty($city)){
                    return $this->returnJson(false,['city'=>'请选择所在城市'],'input');
                }
            }
            $detailData->province = $province;
            $detailData->city = $city;
            $detailData->name = $data['name'];
            $detailData->phone = $data['phone'];
            $detailData->address = $data['address'];
            //把不是默认修改为默认
            if($data['is_default'] == 1 && $detailData->is_default == 2){
                $affectedRows = UserReceipt::where('is_default', '=', 1)->where('user_id','=',$detailData->user_id)->update(['is_default' => 2]);
            }
            $detailData->is_default = $data['is_default'];
            $return = $detailData->save();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改收货地址','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function memberReceiptDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            $return = UserReceipt::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }


    //修改为渠道商
    public function channelUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = User::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            $data['channel_status'] = Input::get('channel_status');
            if($data['channel_status'] == 1 && $detailData->channel_status!=1){
                //修改
                $RE = User::where('id','=',$paramsData['id'])->update(
                    [
                        'channel_status'=>1,
                        'channel_num' =>userNumber($type='QDS'),
                    ]
                );
                if(!$RE){
                    return $this->returnJson(false,'渠道商修改失败,请重试','all');
                }
            }
            if($data['channel_status']==0){
                //修改
                $RE = User::where('id','=',$paramsData['id'])->update(
                    [
                        'channel_status'=>0,
                        'channel_num' =>'',
                    ]
                );
                if(!$RE){
                    return $this->returnJson(false,'渠道商修改失败,请重试','all');
                }
            }

            return $this->returnJson(true,'','all');
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改为渠道商','form'=>$this->form,'detailData'=>$detailData]);
    }

    //代理商设置
    public function agentUpdate(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = User::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            $data['agent_status'] = Input::get('agent_status');
            if($data['agent_status'] == 1 && $detailData->agent_status!=1){
                //修改
                $RE = User::where('id','=',$paramsData['id'])->update(
                    [
                        'agent_status'=>1,
                        'agent_num' =>userNumber($type='DLS'),
                    ]
                );
                if(!$RE){
                    return $this->returnJson(false,'代理商修改失败,请重试','all');
                }
            }
            if($data['agent_status']==0){
                //修改
                $RE = User::where('id','=',$paramsData['id'])->update(
                    [
                        'agent_status'=>0,
                        'agent_num' =>'',
                    ]
                );
                if(!$RE){
                    return $this->returnJson(false,'代理商修改失败,请重试','all');
                }
            }
            return $this->returnJson(true,'','all');
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改为代理商','form'=>$this->form,'detailData'=>$detailData]);
    }

    public function distributorList(Request $request){
        $this->form = [
            'field' => [
            'id' => ['text'=>'用户编号'],
            'agent_num' => ['text'=>'代理商编号'],
            'user_name' => ['text'=>'姓名'],
            'bank_num' => ['text'=>'银行卡号'],
            'status' => ['text'=>'状态'],
            'created_at' => ['text'=>'申请时间'],
        ],
            'search' => [
                'agent_num' => ['text'=>'代理商编号','type'=>'input'],
                'user_name' => ['text'=>'姓名','type'=>'input'],
                'status' => ['text'=>'状态','type'=>'select','value'=>[''=>'请选择状态','-1'=>'待审核','1'=>'审核通过','-2'=>'审核失败']],
            ],
            'button' => [
                'update' => '/member/updateDistributor',
                'delete' => '/member/distributorDelete',
            ],
            'data_url' => '/member/distributorList'];
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['agent_num'=>'string','user_name'=>'string','status'=>'int'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $user = new Distributor_apply_log();
            $userCount = new Distributor_apply_log();
            $query = $user->select(['*'])->where('status','!=',0);

            //搜索功能
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k=='agent_num' || $k == 'user_name'){

                        $query = $query->where($k,'like','%'.$v.'%');
                        $userCount = $userCount->where($k,'like','%'.$v.'%');

                    }else{
                        $query = $query->where($k,'=',$v);
                        $userCount = $userCount->where($k,'=',$v);
                    }
                }
            }


            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $userCount->where('status','!=',0)->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'status'){
                        $arr['rows'][$key][$k] = $this->status[$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 渠道商申请列表','form'=>$this->form]);
        }
    }


    public function updateDistributor(Request $request){

        $this->form = [
            'field' => [
                'apply_nickname'=> ['text'=>'申请人昵称','type'=>'span'],
                'agent_num'=> ['text'=>'代理商编号','type'=>'span'],
                'user_name' => ['text'=>'姓名','type'=>'span'],
                'idcard_pho' => ['text'=>'身份证正反面','type'=>'imgs'],
                'idcard_hand_pho' => ['text'=>'手持身份证照','type'=>'imgs'],
                'bank_num' => ['text'=>'银行卡号','type'=>'span'],
                'status' => ['text'=>'是否通过','type'=>'radio','value'=>[1=>'通过',-2=>'不通过']],
            ],
            'sub_url'=>'/member/updateDistributor',
        ];
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Distributor_apply_log::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($detailData['status']!=-1){
            $this->form['field']['status'] = ['text'=>'审核结果','type'=>'span'];
            $detailData['status'] = $this->status[$detailData->status];
            $detailData['has_varify'] = 1;
            $this->form['field']['varify_time'] = ['text'=>'审核时间','type'=>'span'];
            $detailData['varify_time'] = date('Y-m-d H:i',$detailData['varify_time']);
        }
        if($_POST){
            //获取参数
            $params = ['status'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            if(!$data['status']){
                return $this->returnJson(false,'请先审核','all');
            }
            if($data['status']==1){
                //修改
                $RE = User::where('id','=',$detailData['user_id'])->update(
                    [
                        'channel_status'=>1,
                        'channel_num' =>userNumber($type='QDS'),
                        'by_agent_num'=>$detailData->agent_num?$detailData->agent_num:''
                    ]
                );
                if(!$RE){
                    return $this->returnJson(false,'审核失败,请重试','all');
                }
            }
            $detailData->status = $data['status'];
            $detailData->varify_time = time();
            $return = $detailData->save();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        $this->form['field']['idcard_pho']['value'] = explode(';',$detailData->idcard_pho);
        $this->form['field']['idcard_hand_pho']['value'] = explode(';',$detailData->idcard_hand_pho);
        $user = User::where('id','=',$detailData->user_id)->first();
        $detailData['apply_nickname'] = $user->nickname;
        return view('admin/common/edit',['title'=>WEBNAME.' - 审核申请','form'=>$this->form,'detailData'=>$detailData]);
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
            $return = Distributor_apply_log::whereIn('id',$ids)->delete();
            if(!$return){
                DB::rollback();
                return $this->returnJson(false,'删除失败','all');
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }
    }
}