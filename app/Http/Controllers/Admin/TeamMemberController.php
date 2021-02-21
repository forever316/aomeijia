<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class TeamMemberController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.team_member.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function teamMemberList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $obj = new TeamMember();
            $objCount = new TeamMember();

            $query = $obj->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $objCount = $objCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $objCount = $objCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            
            $arr['total'] = $objCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['type','status','wx_token'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 团队成员列表','form'=>$this->form]);
        }
    }

    public function addTeamMember(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['name'=>'string','job'=>'string','phone'=>'string','sort'=>'int','status'=>'string','photo'=>'string','describe'=>'string','wechat_id'=>'string','wechat_code'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            $obj = TeamMember::create($data);
            if ($obj) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加团队成员','form'=>$this->form]);
    }


    public function updateTeamMember(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = TeamMember::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['name'=>'string','job'=>'string','phone'=>'string','sort'=>'int','status'=>'string','photo'=>'string','describe'=>'string','wechat_id'=>'string','wechat_code'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
                $detailData->name = $data['name'];
                $detailData->job = $data['job'];
                $detailData->phone = $data['phone'];
                $detailData->status = $data['status'];        
                $detailData->sort = $data['sort'];
                $detailData->photo = $data['photo'];
                $detailData->describe = $data['describe'];
                $detailData->wechat_id = $data['wechat_id'];
                $detailData->wechat_code = $data['wechat_code'];
                $return = $detailData->save();
                if ($return) {
                    return $this->returnJson(true, '', 'all');
                } else {
                    return $this->returnJson(false, '', 'all');
                }

        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改团队成员','form'=>$this->form,'detailData'=>$detailData]);
    }


    public function deleteTeamMember(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = TeamMember::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }


    public function seeTeamMember(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = TeamMember::find($paramsData['id']);
        $data->status = $data->status==1 ? '启用' : '禁用';
        if(!$data){
            abort(404);
        }else{
            return view('admin/common/view',['title'=>WEBNAME.' - 查看合作伙伴','form'=>$this->form,'data'=>$data]);
        }
    }
}