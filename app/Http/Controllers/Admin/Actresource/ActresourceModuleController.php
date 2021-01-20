<?php

namespace App\Http\Controllers\Admin\Actresource;

use App\Models\Actresource\ActresourceModule;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;

class ActresourceModuleController extends Controller
{   
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.actresource.actresourceModule.'.$action['method'];
        $this->form = Config::get($formUrl);
    }


    public function moduleList(Request $request)
    {

        if($request->ajax()){

            //获取要搜索的字段
            $params = ['name'=>'string','id'=>'int'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            //数据获取与处理
            $order = new ActresourceModule();
            $ordercount = new ActresourceModule();
            $query = $order->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    $query = $query->where($k,$v);
                    $ordercount = $ordercount->where($k,$v);
                }
            }
            $ordercount = $ordercount;
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $ordercount->count();
            $dataList1 = $dataList1->toArray();
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    $arr['rows'][$key][$k] = $row[$k];
                }
            }
            return response()->json($arr);
            
        }else{
            // dd($this->form);
            return view('admin/common/list',['title'=>WEBNAME.' - 订单列表','form'=>$this->form]);
        }
    }


    public function moduleAdd(Request $request){
        $params = array(
            'name' => 'string',
            'sort' => 'int',
            'status' => 'string',
        );
        $data = $this->getInput([],$params,$request);
        if($_POST){

            if($data['name'] == ''){
                return $this->returnJson(false,'类型名称不能为空','all');
            }
           
            $orderType = ActresourceModule::create($data);
            if(!$orderType){
                return $this->returnJson(false,'类型创建失败','all');
            }else{
                return $this->returnJson(true,'','all');
            }

        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加最新资源类型','form'=>$this->form]);
    }
    //修改最新活动类型
    public function moduleUpdate(Request $request){
       $params = array(
            'id' => 'int',
        );
        $data = $this->getInput([],$params,$request);
        $detailData  = ActresourceModule::where('id','=',$data['id'])->first();
        if(!$detailData){
            abort('404');
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','status'=>'int','sort'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            
            $detailData->name = $data['name'];
            $detailData->status = $data['status'];
            $detailData->sort = $data['sort'];
            $bannerType = $detailData->save();
            if($bannerType){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
       
        return view('admin/common/edit',['title'=>WEBNAME.' - 最新活动类型修改','form'=>$this->form,'detailData'=>$detailData]);
   }
   //查看最新活动类型
   public function moduleDetail(Request $request)
   {
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $order = ActresourceModule::where('id','=',$paramsData['id'])->first();
        if(!$order){
            abort(404);
        }
        $data['id'] = $order->id;
        $data['name'] = $order->name;
        $data['sort'] = $order->sort; 
        $data['status'] = $order->status; 
        $data['created_at'] = $order->created_at;
        $data['updated_at'] = $order->updated_at;
        // dd($data);
        return view('admin/common/view',['title'=>WEBNAME.' - 查看订单详情','form'=>$this->form,'data'=>$data]);
   }
   //删除最新活动类型
   public function moduleDel(Request $request)
   {
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            $return = ActresourceModule::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
   }
}