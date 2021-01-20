<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stocks;
use App\Models\Holds;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use DB;

class StocksController extends Controller
{
    private $form = [];
    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.stocks.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    /**
     **商品列表
     **
     */
    public function stocksList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','scode'=>'string','sname'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $model = new Stocks();
            $modelCount = new Stocks();
            $query = $model->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if($k=='status'){
                    $query = $query->where($k,'=',$v);
                    $modelCount = $modelCount->where($k,'=',$v);
                }else{
                    if(!empty($v)){
                        if($k=='sname'){
                            $query = $query->where($k,'like','%'.$v.'%');
                            $modelCount = $modelCount->where($k,'like','%'.$v.'%');
                        }else{
                            $query = $query->where($k,'=',$v);
                            $modelCount = $modelCount->where($k,'=',$v);
                        }
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $modelCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    $arr['rows'][$key][$k] = $row[$k];
                }
                $arr['rows'][$key]['status'] = $arr['rows'][$key]['status']==0 ? '启用' : '禁用';
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 商品列表','form'=>$this->form]);
        }
    }

    /**
     **添加商品
     **
     */
    public function addStocks(Request $request){
        if($_POST){
            //获取参数
            $params = ['scode'=>'string','sname'=>'string','price'=>'float','tprice'=>'float','prefix'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $model = Stocks::create($data); // 要查看的sql

            if($model){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加商品','form'=>$this->form]);
    }

    /**
     **修改商品
     **
     */
    public function updateStocks(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Stocks::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['scode'=>'string','sname'=>'string','price'=>'float','tprice'=>'float','prefix'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->scode = $data['scode'];
            $detailData->sname = $data['sname'];
            $detailData->price = $data['price'];
            $detailData->tprice = $data['tprice'];
            $detailData->prefix = $data['prefix'];
            $res = $detailData->save();
            if($res){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改商品','form'=>$this->form,'detailData'=>$detailData]);
    }

    /**
     **删除商品
     **
     * @param Request $request
     * @return string
     */
    public function deleteStocks(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            //查holds表，看是否有这些code的持仓数据
            $holdInfo = Holds::whereIn('sid',$ids)->get(array('id'))->toArray();
            if($holdInfo){
                return $this->returnJson(false,'删除失败，有code存在持仓数据！','all');
            }

            $return = Stocks::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }

    /*
     * 启用状态
     */
    public function startStocks(Request $request)
    {
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要启用的数据','all');
            }
            $ids = explode(',',$data['ids']);
            $return = Stocks::whereIn('id',$ids)->update(array('status'=>0));
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
    /*
    * 禁用状态
     * 禁用的时候需要判断下是否没有了未结算的数据
    */
    public function stopStocks(Request $request)
    {
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要禁用的数据','all');
            }
            $ids = explode(',',$data['ids']);

            //查holds表，看是否有code还有未结算的持仓数据
            $holdInfo = Holds::whereIn('sid',$ids)->where('status',0)->get(array('id'))->toArray();
            if($holdInfo){
                return $this->returnJson(false,'禁用失败，有code存在未结算的持仓数据！','all');
            }

            $return = Stocks::whereIn('id',$ids)->update(array('status'=>1));
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
}