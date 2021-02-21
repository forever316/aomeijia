<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use App\Models\PartnerType;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class PartnerController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.partner.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function partnerList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $obj = new Partner();
            $objCount = new Partner();

            $query = $obj->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'title'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $objCount = $objCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $objCount = $objCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);

            //查询类型
            $typeids = '';
            foreach($dataList1 as $item){
                $typeids.= $item->type.',';
            }
            $typeids = trim($typeids,',');
            $tokenArray = explode(',',$typeids);
            $ArticleType = PartnerType::select(['id','name'])->whereIn('id',$tokenArray)->get();
            foreach($ArticleType as $item){
                $this->form['field']['type']['options'][$item->id] = $item->name;
            }
            
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
                $arr['rows'][$key]['logo'] = '<img src="/'.$row['logo'].'" width="150px" height="60px">';
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 合作伙伴列表','form'=>$this->form]);
        }
    }

    public function addPartner(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['type'=>'string','title'=>'string','logo'=>'string','sort'=>'int','status'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            $obj = Partner::create($data);
            if ($obj) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }else{

            $objType = PartnerType::select(['id','name'])->get();
            foreach($objType as $item){
                $this->form['field']['type']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加合作伙伴','form'=>$this->form]);
    }


    public function updatePartner(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = Partner::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['type'=>'string','title'=>'string','logo'=>'string','sort'=>'int','status'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
                $detailData->type = $data['type'];
                $detailData->title = $data['title'];
                $detailData->logo = $data['logo'];
                $detailData->status = $data['status'];        
                $detailData->sort = $data['sort'];
                $return = $detailData->save();
                if ($return) {
                    return $this->returnJson(true, '', 'all');
                } else {
                    return $this->returnJson(false, '', 'all');
                }

        }else{
            $objType = PartnerType::select(['id','name'])->get();
            foreach($objType as $item){
                $this->form['field']['type']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改合作伙伴','form'=>$this->form,'detailData'=>$detailData]);
    }


    public function deletePartner(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Partner::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }


    public function seePartner(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Partner::find($paramsData['id']);
        if(!$data){
            abort(404);
        }else{
            $objType = PartnerType::select(['id','name'])->where('id','=',$data->type)->first();
            //获取微信链接
            $data->type = $objType->name;
            return view('admin/common/view',['title'=>WEBNAME.' - 查看合作伙伴','form'=>$this->form,'data'=>$data]);
        }
    }


    public function partnerTypeList(Request $request){
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
            $obj = new PartnerType();
            $objCount = new PartnerType();

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
                    if(in_array($k,['type','status'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 合作伙伴类型列表','form'=>$this->form]);
        }
    }

    public function addPartnerType(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['name'=>'string','sort'=>'int','status'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            $obj = PartnerType::create($data);
            if ($obj) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加合作伙伴类型','form'=>$this->form]);
    }


    public function updatePartnerType(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = PartnerType::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['name'=>'string','sort'=>'int','status'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->name = $data['name'];
            $detailData->status = $data['status'];        
            $detailData->sort = $data['sort'];
            $return = $detailData->save();
            if ($return) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }

        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改合作伙伴类型','form'=>$this->form,'detailData'=>$detailData]);
    }

}