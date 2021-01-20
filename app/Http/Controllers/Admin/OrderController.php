<?php

namespace App\Http\Controllers\Admin;
use App\Models\Store;
use App\Models\User;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController  extends Controller
{
    private $form = [];
    private $user = [];
    private $order_status = [
        '0'=>'未确认','1'=>'已确认','2'=>'已取消','3'=>'无效','4'=>'退货'
    ];
    private $shipping_status = [
        '0'=>'未发货','1'=>'已发货','2'=>'已收货','3'=>'备货中','4'=>'退货成功'
    ];
    private $pay_status = [
        '0'=>'未付款','1'=>'付款中','2'=>'已付款',
    ];
    private $pay_name = [
       '0'=>'', '1'=>'余额支付','2'=>'支付宝支付','3'=>'微信消费','4'=>'积分消费'
    ];
    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.order.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function orderList(Request $request){
        if($request->ajax()){

            //获取要搜索的字段
            $params = ['order_sn'=>'string','start_time'=>'string','end_time'=>'string','order_status'=>'int'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','add_time');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            //数据获取与处理
            $commodities = new OrderInfo();
            $commoditiesCount = new OrderInfo();
            $commoditiesCount = $commoditiesCount->where('source_id','=','1');
            $query = $commodities->select(['*'])->where('source_id','=','1');

            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'order_sn'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $commoditiesCount = $commoditiesCount->where($k,'like','%'.$v.'%');
                    }else if($k == 'start_time'){
                        $query = $query->where('add_time','>',strtotime($v.' 00:00:00'));
                        $commoditiesCount = $commoditiesCount->where('add_time','>',strtotime($v.' 00:00:00'));
                    }else if($k == 'end_time'){
                        $query = $query->where('add_time','<',strtotime($v.' 23:59:59'));
                        $commoditiesCount = $commoditiesCount->where('add_time','<',strtotime($v.' 23:59:59'));
                    }else if($k == 'order_status'){
                        if($v==1){
                            //待付款
                            $query = $query->where('pay_status','=',0);
                            $commoditiesCount = $commoditiesCount->where('pay_status','=',0);
                        }
                        if($v==2){
                            //待发货
                            $query = $query->where('pay_status','=',2)->where('shipping_status','=',0);
                            $commoditiesCount = $commoditiesCount->where('pay_status','=',2)->where('shipping_status','=',0);
                        }
                        if($v==3){
                            //待收货
                            $query = $query->where('pay_status','=',2)->where('shipping_status','=',1);
                            $commoditiesCount = $commoditiesCount->where('pay_status','=',2)->where('shipping_status','=',1);
                        }
                        if($v==4){
                            //退货
                            $query = $query->where('shipping_status','=',4);
                            $commoditiesCount = $commoditiesCount->where('shipping_status','=',4);
                        }
                    }else{
                        $query = $query->where($k,'=',$v);
                        $commoditiesCount = $commoditiesCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $commoditiesCount->count();
            $dataList1 = $dataList1->toArray();
            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                  if($k == 'add_time'){
                        $arr['rows'][$key][$k] = date('Y-m-d H:i',$row[$k]);
                    }elseif($k == 'status'){
                      if($row['pay_status']==0){
                          if($row['order_status']==2){
                              $arr['rows'][$key][$k] = '已取消';
                          }elseif($row['order_status']==3){
                              $arr['rows'][$key][$k] = '过期无效';
                          }else{
                              $arr['rows'][$key][$k] = '待付款';
                          }


                      }
                      elseif($row['pay_status']==2){
                          if($row['shipping_status']==0){
                              $arr['rows'][$key][$k] = '待发货';
                          }elseif($row['shipping_status']==1){
                              $arr['rows'][$key][$k] = '待收货';
                          }elseif($row['shipping_status']==4){
                              $arr['rows'][$key][$k] = '退货';
                          }
                      }
                     // $arr['rows'][$key][$k] = $row['shipping_status'];
                     // $arr['rows'][$key][$k] = $this->order_status[$row['order_status']].','.$this->shipping_status[$row['shipping_status']].','.$this->pay_status[$row['pay_status']];
                     }elseif($k == 'goods_amount' || $k == 'money_paid'){
                      $arr['rows'][$key][$k] = $row[$k].'元';
                  }elseif($k == 'yuanbao_paid' ){
                    $arr['rows'][$key][$k] = $row[$k].'宝分';
                }
                  elseif($k == 'source_id'){
                      $arr['rows'][$key][$k] = $row['source_id']==1?'线上':'线下';
                  }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                    $arr['rows'][$key]['id'] = $row['id'];
                }
            }
//            dd($arr);
            return response()->json($arr);
        }else{

            return view('admin/common/list',['title'=>WEBNAME.' - 订单列表','form'=>$this->form]);
        }
    }

    public function updateOrder(Request $request){
        $params = array(
            'id' => 'int',
        );
        $data = $this->getInput([],$params,$request);
        $detailData  = OrderInfo::where('id','=',$data['id'])->first();
        if(!$detailData){
            abort('404');
        }
        if($_POST){
            //获取参数
            $params = ['title'=>'string','desc'=>'string','status'=>'int','out_time'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->title = $data['title'];
            $detailData->desc = $data['desc'];
            $detailData->status = $data['status'];
            $detailData->out_time = $data['out_time'];
            $bannerType = $detailData->save();
            if($bannerType){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        $detailData['status'] = $this->order_status[$detailData->order_status].','.$this->shipping_status[$detailData->shipping_status].','.$this->pay_status[$detailData->pay_status];
        $detailData['consignee'] = '<a href="javascript:void(0)" class="lookuser">'.$detailData['consignee'].'</a>';
        $detailData['add_time'] = date('Y-m-d H:i:s',$detailData['add_time']);
        $detailData['pay_name'] = $this->pay_name[$detailData['pay_id']];
        return view('admin/common/edit',['title'=>WEBNAME.' - 订单浏览','form'=>$this->form,'detailData'=>$detailData]);
    }


    //编号
    public function makeOrder(){
        $count = Commoditieslist::orderBy('id','desc')->first()->id;
        if($count){
            $ddnumber = str_pad($count+1,8,"0",STR_PAD_LEFT);
        }else{
            $ddnumber = str_pad(1,8,"0",STR_PAD_LEFT);
        }
        return $ddnumber;
    }

    //商品记录列表
    public function goodList(Request $request){
        $order_id = Input::get('id');

        if($request->ajax()){
            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','id');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            //订单信息
            $orderInfo  = OrderInfo::where('id','=',$order_id)->first();

            if($orderInfo->source_id == 1){
                $am = '元';
            }else{
                $am = '积分';
            }
            //数据获取与处理
            $commodities = new OrderGoods();
            $commoditiesCount = new OrderGoods();
            $query = $commodities->select(['*'])->where('order_sn','=',$orderInfo->order_sn);
            $dataList1 = $query->orderBy($sort,$order)->paginate(100);
            $arr['total'] = $commoditiesCount->where('order_sn','=',$orderInfo->order_sn)->count();
            $dataList1 = $dataList1->toArray();
            //显示隐藏
            if($dataList1['data']) {
                $amount = 0.00;
                foreach ($dataList1['data'] as $key => $row) {
                    foreach ($row as $k => $item) {
                        if ($k == 'tender_time') {
                            $arr['rows'][$key][$k] = date('Y-m-d H:i', $row[$k]);
                        } else if ($k == 'goods_price') {
                            $arr['rows'][$key][$k] = $row[$k] .$am;
                        } else {
                            $arr['rows'][$key][$k] = $row[$k];
                        }
                        $arr['rows'][$key]['id'] = $row['id'];
                        $arr['rows'][$key]['all_amount'] = number_format($row['goods_price'] * $row['goods_number'], 2, '.', '') . $am;
                    }
                    $amount += $arr['rows'][$key]['all_amount'];
                }
                $key = count($arr['rows']);
                $arr['rows'][$key]['goods_number'] = '合计：';
                $arr['rows'][$key]['all_amount'] = $amount.$am;
            }
            return response()->json($arr);
        }
    }

    public function deliverGoodsSet(Request $request){
        if($_POST){
            $id = Input::get('id',0);
            if(empty($id)){
                return $this->returnJson(false,'参数错误','all');
            }
            $orderInfo = OrderInfo::where('id','=',$id)->first();
            if(!$orderInfo){
                return $this->returnJson(false,'订单不存在','all');
            }else{
                if($orderInfo->order_status == 1 && $orderInfo->pay_status == 2 && $orderInfo->shipping_status == 0){
                    $orderInfo->shipping_status = 1;
                    if($orderInfo->save()){
                        return $this->returnJson(true,'设置成功','all');
                    }else{
                        return $this->returnJson(false,'设置失败','all');
                    }
                }else{
                    return $this->returnJson(false,'订单状态错误','all');
                }
            }
//            echo "<pre>";print_r($orderInfo);die;
        }else{
            return $this->returnJson(false,'设置失败','all');
        }
    }

    public function downOrderList(Request $request){
        if($request->ajax()){

            //获取要搜索的字段
            $params = ['order_sn'=>'string','start_time'=>'string','end_time'=>'string'];
            $search_params = $this->getInput([],$params,$request);
            $search_params['order_status'] = Input::get('order_status');
            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','add_time');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            //数据获取与处理
            $commodities = new OrderInfo();
            $commoditiesCount = new OrderInfo();
            $commoditiesCount = $commoditiesCount->where('source_id','=','2');
            $query = $commodities->select(['*'])->where('source_id','=','2');

            foreach($search_params as $k=>$v){
                if(!empty($v)||$v==='0'){

                    if($k == 'order_sn'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $commoditiesCount = $commoditiesCount->where($k,'like','%'.$v.'%');
                    }else if($k == 'start_time'){
                        $query = $query->where('add_time','>',strtotime($v.' 00:00:00'));
                        $commoditiesCount = $commoditiesCount->where('add_time','>',strtotime($v.' 00:00:00'));
                    }else if($k == 'end_time'){
                        $query = $query->where('add_time','<',strtotime($v.' 23:59:59'));
                        $commoditiesCount = $commoditiesCount->where('add_time','<',strtotime($v.' 23:59:59'));
                    }else if($k == 'order_status'){
                        if($v==2){
                            //待付款
                            $query = $query->where('pay_status','=',2);
                            $commoditiesCount = $commoditiesCount->where('pay_status','=',2);
                        }
                        if($v==0){
                            //待付款
                            $query = $query->where('pay_status','=',0);
                            $commoditiesCount = $commoditiesCount->where('pay_status','=',0);
                        }
                    }else{
                        $query = $query->where($k,'=',$v);
                        $commoditiesCount = $commoditiesCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $commoditiesCount->count();
            $dataList1 = $dataList1->toArray();
            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'add_time'){
                        $arr['rows'][$key][$k] = date('Y-m-d H:i',$row[$k]);
                    }elseif($k == 'status'){
                        if($row['pay_status']==0){
                            $arr['rows'][$key][$k] = '未付款';
                        }elseif($row['pay_status']==2){
                            $arr['rows'][$key][$k] = '已付款';
                        }
                        // $arr['rows'][$key][$k] = $row['shipping_status'];
                        // $arr['rows'][$key][$k] = $this->order_status[$row['order_status']].','.$this->shipping_status[$row['shipping_status']].','.$this->pay_status[$row['pay_status']];
                    }elseif($k == 'goods_amount' || $k == 'money_paid' ||$k=='plate_amount'){
                        $arr['rows'][$key][$k] = $row[$k].'元';
                    }elseif($k == 'yuanbao_paid' ){
                        $arr['rows'][$key][$k] = $row[$k].'宝分';
                    }
                    elseif($k == 'source_id'){
                        $arr['rows'][$key][$k] = $row['source_id']==1?'线上':'线下';
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                    $arr['rows'][$key]['id'] = $row['id'];
                }
            }
//            dd($arr);
            return response()->json($arr);
        }else{

            return view('admin/common/list',['title'=>WEBNAME.' - 订单列表','form'=>$this->form]);
        }
    }

    public function seedownOrder(Request $request){
        $params = array(
            'id' => 'int',
        );
        $data = $this->getInput([],$params,$request);
        $detailData  = OrderInfo::where('id','=',$data['id'])->first();
        if(!$detailData){
            abort(404);
        }
        $detailData['status'] =  "<span style='color:red'>[".$this->pay_status[$detailData['pay_status']]."]</span>";
        $detailData['add_time'] = date('Y-m-d H:i:s',$detailData->add_time);
        $user = User::select(['nickname'])->where('access_token','=',$detailData->access_token)->first();
        $detailData['goods_amount'] = $detailData->goods_amount.'元';
        $detailData['yuanbao_paid'] = $detailData->yuanbao_paid.'宝分';
        $detailData['money_paid'] = $detailData->money_paid.'元';
        $detailData['plate_amount'] = $detailData->plate_amount.'元';  $detailData['nick_name'] = $user->nickname;
        //商家信息查询
        if($detailData->store_id){
            $storeInfo = Store::select(['*'])->where('id','=',$detailData->store_id)
                ->first();
            //平台提成配置
            $detailData['img1'] = $detailData['img'] = explode(';', trim($storeInfo->store_img,';'));
            $detailData['store_name'] = $detailData['store_name'].'( ' ."<a href='/seeStore?id=".$storeInfo->id."'>".$storeInfo->name.'</a>'.' )';
        }

        return view('admin/common/view',['title'=>WEBNAME.' - 线下订单浏览','form'=>$this->form,'data'=>$detailData]);
    }
}