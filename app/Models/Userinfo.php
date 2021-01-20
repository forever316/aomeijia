<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Userinfo extends Model
{

    protected $table = 'user_info';//指定表名

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function UserIntegralLog()
    {
        return $this->hasMany('App\Models\Userinfo', 'user_id','user_id');
    }
    protected $fillable = [
        'user_id', 'legal_person','address','discount','province','city','balance','access_key','integral','company_name','treasure_num','has_treasure_num'
        ,'bestir_integral','un_bestir_integral','cash_integral','un_cash_integral','bonus_integral','consumption_amount'
    ];//设置哪些属性可以批量赋值
}
