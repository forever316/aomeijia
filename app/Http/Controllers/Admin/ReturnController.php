<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderReturn;
use App\Models\OrderInfo;
use App\Models\User;
use App\Models\Finance\BankCard;
use App\Models\Message;
use App\Models\Finance\UserIntegralLog;
use App\Models\Finance\UserAmountLog;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ReturnController  extends Controller
{
    private $form = [];
    private $user = [];
    private $status = [
        '-1'=>'待审核','1'=>'审核通过','-2'=>'审核失败',
    ];
    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.return.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    public function returnList(Request $request){
        if($request->ajax()){

            //获取要搜索的字段
            $params = ['order_sn'=>'string','start_time'=>'string','end_time'=>'string','status'=>'int'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];
            //数据获取与处理
            $commodities = new OrderReturn();
            $commoditiesCount = new OrderReturn();
            $commoditiesCount = $commoditiesCount;
            $query = $commodities->select(['*']);
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'order_sn'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $commoditiesCount = $commoditiesCount->where($k,'like','%'.$v.'%');
                    }else if($k == 'start_time'){
                        $query = $query->where('created_at','>',$v.' 00:00:00');
                        $commoditiesCount = $commoditiesCount->where('created_at','>',$v.' 00:00:00');
                    }else if($k == 'end_time'){
                        $query = $query->where('created_at','<',$v.' 23:59:59');
                        $commoditiesCount = $commoditiesCount->where('created_at','<',$v.' 23:59:59');
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
                      $arr['rows'][$key][$k] = $this->status[$row['status']];
                     }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                    $arr['rows'][$key]['id'] = $row['id'];
                }
            }
//            dd($arr);
            return response()->json($arr);
        }else{

            return view('admin/common/list',['title'=>WEBNAME.' - 退货申请列表','form'=>$this->form]);
        }
    }

    public function updateReturn(Request $request){
        $params = array(
            'id' => 'int',
        );
        $data = $this->getInput([],$params,$request);
        $detailData  = OrderReturn::where('id','=',$data['id'])->first();
        if(!$detailData){
            abort('404');
        }
        if($_POST){
            //获取参数
            $params = ['varify_status'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            if(!$data['varify_status']){
                return $this->returnJson(true,'','all');
            }
            $OrderInfo = OrderInfo::select(['order_sn','order_status','shipping_status','pay_status','money_paid'])->where(['order_sn'=>$detailData->order_sn])->first();
            if(!$OrderInfo || $OrderInfo['order_status']!=4){
                return $this->returnJson(false,'订单状态有误，请稍候重试','all');
            }
            //审核通过
            if($data['varify_status'] == 1){
                DB::beginTransaction();
                $bannerType = $OrderInfo->where(['order_sn'=>$detailData->order_sn])->update(['shipping_status'=>4]);
                if(!$bannerType){
                    DB::rollback();
                    return $this->returnJson(false,'审核失败','all');
                 }

                $user_id = User::select(['*'])->first();
                if(!$user_id){
                    return $this->returnJson(false,'用户信息有误','all');
                }
                if($OrderInfo->yuanbao_paid>0){
                    $userIntegralLog = new UserIntegralLog();
                    $return = $userIntegralLog->integralRechargePlate(3,$user_id,$OrderInfo->yuanbao_paid,'[退货]成功，返还宝分：'.$OrderInfo->yuanbao_paid);
                    if($return != 'success'){
                        DB::rollback();
                        return $this->returnJson(false,$return,'all');
                    }
                }

                $Message = new Message();

                $ret = $Message->add_message($detailData->user_id,'订单号['.$OrderInfo->order_sn.']退货申请，审核成功,退款'.$OrderInfo->money_paid.'元');

                if(!$ret){
                    DB::rollback();
                    return $this->returnJson(false,'审核失败','all');
                }
                $detailData->status = $data['varify_status'];
                $detailData->save();
                DB::commit();
                return $this->returnJson(true,'审核成功','all');
            }else{
                DB::beginTransaction();
                $bannerType = $OrderInfo->where(['order_sn'=>$detailData->order_sn])->update(['order_status'=>1]);
                if(!$bannerType){
                    DB::rollback();
                    return $this->returnJson(false,'审核失败','all');
                }
                $Message = new Message();
                $ret = $Message->add_message($detailData->user_id,'订单号['.$OrderInfo->order_sn.']退货申请，审核失败！如有疑问请联系工作人员。');
                if(!$ret){
                    DB::rollback();
                    return $this->returnJson(false,'审核失败','all');
                }
                $detailData->status = $data['varify_status'];
                $detailData->save();
                DB::commit();
                return $this->returnJson(true,'审核成功','all');
            }
        }
        if($detailData->status != -1){
            $this->form['field']['varify_status']['type'] = 'span';
            $detailData['varify_status'] = $this->status[$detailData->status];
            $this->form['field']['varify_status']['desc'] = '';
        }
        $bankCard = BankCard::where('user_id','=',$detailData->user_id)->first();
        if(!$bankCard){
            $detailData->bank_name = '还未绑定银行卡';
            $detailData->bank_card_number = '还未绑定银行卡';
            $detailData->real_name = '还未绑定银行卡';
            $detailData->id_card_no = '还未绑定银行卡';
        }else{
            $detailData->bank_name = $bankCard->bank_name;
            $detailData->bank_card_number = $bankCard->bank_card_number;
            $detailData->real_name = $bankCard->real_name;
            $detailData->id_card_no = $bankCard->id_card_no;
        }
        $detailData['status'] = $this->status[$detailData->status];
        $detailData['return_user'] = '<a href="javascript:void(0)" class="lookuser">'.$detailData['return_user'].'</a>';
        return view('admin/common/edit',['title'=>WEBNAME.' - 退货审核','form'=>$this->form,'detailData'=>$detailData]);
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
            //数据获取与处理
            $commodities = new OrderGoods();
            $commoditiesCount = new OrderGoods();
            $query = $commodities->select(['*'])->where('id','=',$order_id);
            $dataList1 = $query->orderBy($sort,$order)->paginate(100);
            $arr['total'] = $commoditiesCount->where('id','=',$order_id)->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            if($dataList1['data']) {
                $amount = 0.00;
                foreach ($dataList1['data'] as $key => $row) {
                    foreach ($row as $k => $item) {
                        if ($k == 'tender_time') {
                            $arr['rows'][$key][$k] = date('Y-m-d H:i', $row[$k]);
                        } else if ($k == 'goods_price') {
                            $arr['rows'][$key][$k] = $row[$k] . '元';
                        } else {
                            $arr['rows'][$key][$k] = $row[$k];
                        }
                        $arr['rows'][$key]['id'] = $row['id'];
                        $arr['rows'][$key]['all_amount'] = number_format($row['goods_price'] * $row['goods_number'], 2, '.', '') . '元';
                    }
                    $amount += $arr['rows'][$key]['all_amount'];
                }
                $key = count($arr['rows']);
                $arr['rows'][$key]['goods_number'] = '合计：';
                $arr['rows'][$key]['all_amount'] = $amount.'元';
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
}