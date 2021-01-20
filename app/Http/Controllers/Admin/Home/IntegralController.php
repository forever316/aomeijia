<?php

namespace App\Http\Controllers\Admin\Home;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsType;
use App\Http\Controllers\Controller;
use App\Models\Home\IntegralProportion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class IntegralController extends Controller
{
    private $form = [];
    private $access_key = 0;

    public function __construct(){
        $user = Session::get('user');
        $this->access_key = $user->access_key;
    }

    public function integralProportionSet(Request $request){
        if($_POST){
            $proportion = Input::get('proportion',0);
            if(empty($proportion)){
                return $this->returnJson(false,'不允许设置空值','all');
            }else{
                if(!preg_match('/^\d*$/',$proportion)){
                    return $this->returnJson(false,'比例请填写数字','all');
                }
            }
            $a = IntegralProportion::updateOrCreate(['access_key'=>$this->access_key], [
                'access_key'=>$this->access_key,
                'proportion'=>$proportion
            ]);
            if(!$a){
                return $this->returnJson(false,'比例设置失败','all');
            }
            return $this->returnJson(true,'比例设置成功','all');
        }else{
            $detailData = IntegralProportion::where('access_key','=',$this->access_key)->first();
        }
        return view('admin/home/integral_proportion_set',['title'=>WEBNAME.' - 积分比例设置','detailData'=>$detailData]);
    }
}