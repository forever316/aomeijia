<?php
/*
 * 普通用户权限
 * 1.持仓列表，只有查看权限，列表只展示某些列，无增删改权限；
 * 2.只能查看未结算，数据；
 */

namespace App\Http\Controllers\Admin;

use App\Models\Holds;
use App\Models\Stocks;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class HoldsController extends Controller
{
    private $form = [];
    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.holds.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    /**
     **持仓列表
     **账面盈亏（=(现价-成本）*数量）
     * 盈利预测（=(最新目标价-成本）*数量）
     * 比例% （=（现价-成本）/ 成本 * 100）
     */
    public function holdsList(Request $request){
        $adminId = session('user')->id;//登录的账号id
        $authority = session('authority');
        $addRole = 0;
        if(in_array('/stocks/addStocks',$authority['resources'])){
            $addRole = 1;
            //选择用户
            $userArray = $this->getAdminUserIdName();
            $this->form['search'][1]['uid']['value'] = array(0=>'请选择')+$userArray;
        }
        $this->form['field'] = $this->form['field'][$addRole];//不同的角色不同的列表展示
        $this->form['search'] = $this->form['search'][$addRole];

        //选择商品
        $model = new Stocks();
        $scodeArray = $model->getStocksIdName();
        $this->form['search']['sid']['value'] = array(0=>'请选择')+$scodeArray;

        if($request->ajax()){
            //获取要搜索的字段
            $params = ['status'=>'int','uid'=>'int','sid'=>'int','start_time'=>'string','end_time'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','account_profit');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $model = new Holds();
            $modelCount = new Holds();
            $query = DB::table('holds as a')
                ->leftJoin('stocks as b', 'b.id', '=', 'a.sid')
                ->select(DB::raw('a.id as id,a.uid as uid,a.sid as sid,scode as scode,hdate,hprice,hnum,in_date,a.status as status,sdate,sname,b.price as s_price,b.tprice as s_tprice,a.created_at as created_at,
                    round((b.price-a.hprice)*a.hnum,2) as account_profit,
                    round((b.tprice-a.hprice)*a.hnum,2) as profit_forecast,
                     round((b.price-a.hprice)/a.hprice*100,2) as percent,
                    if(a.status=0,round((b.price-a.hprice)*a.hnum*0.5,2),a.amount) as amount'));
            foreach($search_params as $k=>$v){
                if($k=='status'){
                    if($v != '-1'){
                        $query = $query->where('a.'.$k,'=',$v);
                        $modelCount = $modelCount->where($k,'=',$v);
                    }
                }else{
                    if(!empty($v)){
                        if($k=='start_time'){
                            if($search_params['status']==1){
                                $query = $query->where('in_date','>=',$v);
                                $modelCount = $modelCount->where('in_date','>=',$v);
                            }
                        }elseif($k=='end_time') {
                            if($search_params['status']==1) {
                                $query = $query->where('in_date', '<=', $v);
                                $modelCount = $modelCount->where('in_date', '<=', $v);
                            }
                        }else{
                            $query = $query->where($k,'=',$v);
                            $modelCount = $modelCount->where($k,'=',$v);
                        }
                    }
                }
            }

            if($addRole==0){//普通角色只能查看自己账号的未结算的数据
                $query = $query->where('a.status',0)->where('uid',$adminId);
                $modelCount = $modelCount->where('status',0)->where('uid',$adminId);
            }

            $sortConfig = array(
                'id'=>'a.id',
                's_price' => 'b.price',
                's_tprice' => 'b.tprice',
                'created_at' => 'a.created_at',
            );
            $sort = isset($sortConfig[$sort]) ? $sortConfig[$sort] : $sort;
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $modelCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            $userArray = $this->getAdminUserIdName();
            $model = new Stocks();
            $scodeArray = $model->getStocksIdCode();
            $snameArray = $model->getStocksIdName();
            $statusArray = array(0 => '未结算', 1 => '已结算');

            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k=='uid'){
                        $arr['rows'][$key][$k] = isset($userArray[$row->$k]) ? $userArray[$row->$k] : $row->$k;
                    }elseif($k=='status'){
                        $arr['rows'][$key][$k] = isset($statusArray[$row->$k]) ? $statusArray[$row->$k] : $row->$k;
                    }else{
                        $arr['rows'][$key][$k] = $row->$k;
                    }
                }
                if($row->account_profit>0){
                    $arr['rows'][$key]['account_profit'] = '<span style="color:red">'.$row->account_profit.'</span>';
                }else{
                    $arr['rows'][$key]['account_profit'] = '<span style="color:green">'.$row->account_profit.'</span>';
                }
                if($row->status==0){
                    //amount未结算情况下，Getrich金额默认=账面盈亏*50/100显示
                    $arr['rows'][$key]['cdate'] = '-';
                }


                $arr['rows'][$key]['percent'] = isset($arr['rows'][$key]['percent']) ? sprintf("%.2f",$arr['rows'][$key]['percent']).'%' : '';//比例保留2位小数并添加百分号
                $arr['rows'][$key]['hprice'] = isset($arr['rows'][$key]['hprice']) ? sprintf("%.3f",$arr['rows'][$key]['hprice']) : '';//持仓成本保留3位小数
            }
            return response()->json($arr);
        }else{
            return view('admin/common/holdsList',['title'=>WEBNAME.' - 持仓列表','form'=>$this->form]);
        }
    }

    /**
     **添加持仓
     **
     */
    public function addHolds(Request $request){
        if($_POST){
            //获取参数
            $params = ['sid'=>'int','uid'=>'int','hdate'=>'string','hprice'=>'string','hnum'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $model = Holds::create($data);

            if($model){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            //选择用户
            $userArray = $this->getAdminUserIdName();
            $this->form['field']['uid']['value'] = $userArray;
            //选择商品
            $model = new Stocks();
            $scodeArray = $model->getStocksIdName(1);
            $this->form['field']['sid']['value'] = $scodeArray;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加持仓','form'=>$this->form]);
    }

    /**
     **修改持仓
     **
     */
    public function updateHolds(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Holds::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['sid'=>'int','uid'=>'int','hdate'=>'string','hprice'=>'string','hnum'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->sid = $data['sid'];
            $detailData->uid = $data['uid'];
            $detailData->hdate = $data['hdate'];
            $detailData->hprice = $data['hprice'];
            $detailData->hnum = $data['hnum'];
            $res = $detailData->save();
            if($res){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            //选择用户
            $userArray = $this->getAdminUserIdName();
            $this->form['field']['uid']['value'] = $userArray;
            //选择商品
            $model = new Stocks();
            $scodeArray = $model->getStocksIdName(1);
            $this->form['field']['sid']['value'] = $scodeArray;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改商品','form'=>$this->form,'detailData'=>$detailData]);
    }

    /**
     **删除持仓
     **
     * @param Request $request
     * @return string
     */
    public function deleteHolds(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Holds::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
    /*
     * 结算持仓
     */
    public function settlementHolds(Request $request)
    {
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Holds::where('id','=',$paramsData['id'])->first();
        //选择用户
        $userArray = $this->getAdminUserIdName();
        $this->form['field']['uid']['value'] = $userArray;
        //选择商品
        $model = new Stocks();
        $scodeArray = $model->getStocksIdName();
        $this->form['field']['sid']['value'] = $scodeArray;

        if(!$detailData){
            abort(404);
        }
        if($_POST){
            $params = ['amount'=>'string','in_date'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->amount = $data['amount'];
            $detailData->in_date = $data['in_date'];
            $detailData->sdate = date('Y-m-d H:i:s');
            $detailData->updated_at = date('Y-m-d H:i:s');
            $detailData->status = 1;
            $res = $detailData->save();
            if($res){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }

        return view('admin/common/edit',['title'=>WEBNAME.' - 结算持仓','form'=>$this->form,'detailData'=>$detailData]);
    }

    /*
     * 一元结算
     */
    public function settleOneHolds(Request $request)
    {
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要一元结算的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Holds::whereIn('id',$ids)->update(['amount'=>1,'in_date'=>date('Y-m-d'),'sdate'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'status'=>1]);
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
}