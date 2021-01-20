<?php

namespace App\Http\Controllers\Admin\QrCode;
use App\Models\Home\CompanyConfig;
use App\Models\QrCode\QrCode;
use App\Http\Controllers\Controller;
use App\Models\StockHolder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class QrCodeController extends Controller
{
    private $form = [];
    private $access_key = 0;

    public function __construct(){
        $user = Session::get('user');
        $this->access_key = $user->access_key;
        $action = $this->getCurrentAction();
        $formUrl = 'models.qrcode.qr_code.'.$action['method'];
        $this->form = Config::get($formUrl);
    }


    public function goodsQrCodeList(Request $request){
        $batchKey = Input::get('batchKey',0);
        if($batchKey){
            $formUrl = 'models.qrcode.qr_code.goodsQrCodeList2';
            $this->form = Config::get($formUrl);
            if($request->ajax()){
                //获取要搜索的字段
                $params = ['goods_name'=>'string','status'=>'string','number'=>'string','batch'=>'string','stock_id'=>'int'];
                $search_params = $this->getInput([],$params,$request);


                //获取要排序的字段 默认按创建时间倒序
                $sort = Input::get('sort','created_at');
                $order = Input::get('order','desc');

                //要返回的数组
                $arr = ['total'=>0,'rows'=>[]];

                //数据获取与处理
                $QrCode = new QrCode();
                $QrCodeCount = new QrCode();
                $this->form['field']['access_key'] = ['text'=>'所属'];
                $query = $QrCode->select(array_keys($this->form['field']));
                foreach($search_params as $k=>$v){
                    if($k != 'batch'){
                        if($k == 'status'){
                            if($v != 3){
                                $query = $query->where($k,'=',$v);
                                $QrCodeCount = $QrCodeCount->where($k,'=',$v);
                            }
                        }else{
                            if(!empty($v)){
                                $query = $query->where($k,'=',$v);
                                $QrCodeCount = $QrCodeCount->where($k,'=',$v);
                            }
                        }
                    }
                }
                $user = Session::get('user');
                $query = $query->where('access_key','=',$user->access_key);
                $QrCodeCount = $QrCodeCount->where('access_key','=',$user->access_key);
                if(!empty($search_params['batch'])){
                    $query = $query->where('batch','=',$search_params['batch']);
                    $QrCodeCount = $QrCodeCount->where('batch','=',$search_params['batch']);
                }
                $dataList1 = $query->orderBy($sort,$order)->with('stockHolder')->paginate(10);

                $arr['total'] = $QrCodeCount->count();
                $dataList1 = $dataList1->toArray();

                //显示隐藏
                foreach ($dataList1['data'] as $key=>$row){
                    foreach($this->form['field'] as $k=>$item){
                        if($k == 'status'){
                            $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                        }elseif($k=='type'){
                            $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                        } elseif($k=='stock_id'){
                            if(!empty($row['stock_holder']['name'])){
                                $arr['rows'][$key][$k] = $row['stock_holder']['name'];
                            }else{
                                $arr['rows'][$key][$k] = '股东未设置';
                            }
                        }else{
                            $arr['rows'][$key][$k] = $row[$k];
                        }
                    }
                     $arr['rows'][$key]['erweima'] = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate('http://tl.youyu333.com/dhjf/'.$row['access_key'].'/'.$row['number']);
                }
                return response()->json($arr);
            }else{
                //增加股东的字段名字
                $this->form['field']['erweima'] = ['text'=>'二维码'];
                $this->form['data_url'] = $this->form['data_url'].'?batchKey='.$batchKey;
                return view('admin/qrcode/list',['title'=>WEBNAME.' - 商品二维码列表','form'=>$this->form,'batchKey'=>$batchKey]);
            }
        }else{
            if($request->ajax()){
                //获取要搜索的字段
                $params = ['goods_name'=>'string','status'=>'string','number'=>'string','batch'=>'string','stock_id'=>'int'];
                $search_params = $this->getInput([],$params,$request);


                //获取要排序的字段 默认按创建时间倒序
                $sort = Input::get('sort','created_at');
                $order = Input::get('order','desc');

                //要返回的数组
                $arr = ['total'=>0,'rows'=>[]];

                //数据获取与处理
                $QrCode = new QrCode();
                $QrCodeCount = new QrCode();
                $query = $QrCode->select(DB::raw('sum(integral) as integral_count,count(*) as integral_number,type,batch,operation_user,goods_name,integral,stock_id,created_at'));
                foreach($search_params as $k=>$v){
                    if($k == 'status'){
                        if($v != 3){
                            $query = $query->where($k,'=',$v);
                            $QrCodeCount = $QrCodeCount->where($k,'=',$v);
                        }
                    }else{
                        if(!empty($v)){
                            $query = $query->where($k,'=',$v);
                            $QrCodeCount = $QrCodeCount->where($k,'=',$v);
                        }
                    }
                }
                $user = Session::get('user');
                $query = $query->where('access_key','=',$user->access_key);
                $QrCodeCount = $QrCodeCount->where('access_key','=',$user->access_key);
                $dataList1 = $query->orderBy($sort,$order)->with('stockHolder')->groupBy('batch')->paginate(10);

                $QrCodeCount = $QrCodeCount->groupBy('batch')->get();
                $arr['total'] = $QrCodeCount->count();
                $dataList1 = $dataList1->toArray();
                //显示隐藏
                foreach ($dataList1['data'] as $key=>$row){
                    foreach($this->form['field'] as $k=>$item){
                        if($k=='type'){
                            $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                        } elseif($k=='stock_id'){
                            if(!empty($row['stock_holder']['name'])){
                                $arr['rows'][$key][$k] = $row['stock_holder']['name'];
                            }else{
                                $arr['rows'][$key][$k] = '股东未设置';
                            }
                        }else{
                            $arr['rows'][$key][$k] = $row[$k];
                        }
                    }
                }
                return response()->json($arr);
            }else{
                return view('admin/qrcode/list2',['title'=>WEBNAME.' - 商品二维码列表','form'=>$this->form]);
            }
        }
    }

    public function goodsQrCodeAdd(Request $request){
        if($_POST){
            $goods_name = Input::get('goods_name','0');
            $integral = Input::get('integral','0');
            $count = Input::get('count','0');
            $batch = Input::get('batch','0');
            //olk
            $stock_id = Input::get('stock_id',0);
            if(empty($stock_id)){
                return $this->returnJson(false,'请选择股东','all');
            }
            //olk

//            if(empty($type)){
//                return $this->returnJson(false,'请选择可领取人类型','all');
//            }

            if(empty($batch)){
                return $this->returnJson(false,'请输入批次','all');
            }
            if(empty($goods_name)){
                return $this->returnJson(false,'请输入商品名称','all');
            }
            if(empty($integral)){
                return $this->returnJson(false,'请输入积分','all');
            }else{
                if (!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$integral)) {
                    return $this->returnJson(false,'请填写正确积分','all');
                }
            }
            if(empty($count)){
                return $this->returnJson(false,'请输入生成条数','all');
            }else{
                if (!preg_match('/^[1-9]\d*$/', $count)) {
                    return $this->returnJson(false,'请填写正确条数','all');
                }else{
                    if($count <= 0 || $count >300){
                        return $this->returnJson(false,'条数范围：1-300','all');
                    }
                }
            }

            $qrCount = QrCode::where('batch','=',$batch)->where('access_key','=',$this->access_key)->first();
            if($qrCount){
                return $this->returnJson(false,'批次必须是唯一值','all');
            }

            $companyConfig = CompanyConfig::where('access_key',$this->access_key)->first();
            if($companyConfig){
                $type = $companyConfig->qr_receiver;
            }else{
                return $this->returnJson(false,'请先设置领取人类型（系统管理->公司资料设置）','all');
            }

            $user = Session::get('user');
            $data['batch'] = $batch;
            $data['type'] = $type;
            $data['operation_user'] = $user->name;
            $data['goods_name'] = $goods_name;
            $data['integral'] = $integral;
            $data['access_key'] = $this->access_key;
            $data['stock_id'] =$stock_id;
            set_time_limit(0);
            DB::beginTransaction();
            for($i=1;$i<=$count;$i++){
                $data['number'] = chr(rand(65, 90)).time().rand(0,9).rand(0,9).rand(0,9).rand(0,9);
                $QrCode = QrCode::create($data);
                if(!$QrCode){
                    DB::rollback();
                    return $this->returnJson(false,'生成失败，请稍后重试','all');
                }
            }
            DB::commit();
            return $this->returnJson(true,'','all');
        }

        //olk
        $stockid = StockHolder::where('access_key',$this->access_key)->get();
        foreach($stockid as $key=>$val){
            $this->form['field']['stock_id']['value'][$val->id] = $val->name;
        }

        $type = [
            1=>'经销商',
            2=>'师傅',
            3=>'普通用户',
            4=>'全部'
        ];
        $companyConfig = CompanyConfig::where('access_key',$this->access_key)->first();
        if($companyConfig){
            $this->form['field']['type']['value'] = $type[$companyConfig->qr_receiver];
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加商品二维码','form'=>$this->form]);
    }



    public function goodsQrCodeDelete(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            $return = QrCode::where('access_key','=',$this->access_key)->whereIn('number',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }

    public function exportGoodsQrCode(Request $request){
        $params = ['number'=>'string','goods_name'=>'string','status'=>'string','batch'=>'string'];
        $search_params = $this->getInput([],$params,$request);
        $qrCode = new QrCode();
        $query = $qrCode->select(['*']);
        $query = $query->where('access_key','=',$this->access_key);
        foreach($search_params as $k=>$v){
            if($k == 'status'){
                if($v != 3){
                    $query = $query->where($k,'=',$v);
                }
            }else{
                if($v != ''){
                    $query = $query->where($k,'=',$v);
                }
            }
        }
        //$dataList1 = $query->orderBy('created_at','desc')->get()->toArray();
        $dataList1 = $query->orderBy('created_at','desc')->with('stockHolder')->get()->toArray();
        $cellData = [
            ['批次','编号','操作人','商品名称','积分','状态','获得者编号','获得者昵称','股东名字','更新时间','创建时间','生成字符串'],
        ];
        if($dataList1 && !empty($dataList1)){
            foreach($dataList1 as $k => $v){
                $v['status'] = $v['status']==0?'未兑换':'已兑换';
                $cellData[] = [
                    $v['batch'],
                    $v['number'],
                    $v['operation_user'],
                    $v['goods_name'],
                    $v['integral'],
                    $v['status'],
                    $v['user_id'],
                    $v['user_nickname'],
                    $v['stock_holder']['name'],
                    $v['updated_at'],
                    $v['created_at'],
                    'http://tl.youyu333.com/dhjf/'.$v['access_key'].'/'.$v['number']
                ];
            }//tl.youyu333.com www.shopping.com
            Excel::create('二维码：'.date("Y-m-d H-i-s",time()),function($excel) use ($cellData){
                $excel->sheet('score', function($sheet) use ($cellData){
                    $sheet->rows($cellData);
                });
            })->export('xls');
        }else{
            echo "<script>alert('暂无记录');history.back();</script>";
        }
    }
}