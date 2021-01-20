<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $table = 'store';//指定表名
    protected $fillable = [
        'distributor_num', 'name','longitude','latitude','address','store_img','business_licence','bank_num','contact'
        ,'phone','idcard_positive_img','idcard_img','commitment_img','status','add_time','varify_time','varify_content'
        ,'user_id','type_id','type_path','current limit','remain_limit','origin_limit','province','city','area','achievement','plate_amount'
        ,'treasure_num','has_treasure_num','bonus_integral','bestir_integral','un_bestir_integral','integral'
        ,'store_id','store_name','expenses_store_id','cash_password','balance','main_business','business_hours','bank_name','order_num'
    ];//设置哪些属性可以批量赋值

    public function userIntegral(){
        return $this->hasMany('App\Models\Finance\UserIntegralLog','user_id','user_id');
    }
}
