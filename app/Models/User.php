<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{

    protected $table = 'user';//指定表名

    public function userInfo()
{
    return $this->hasOne('App\Models\Userinfo', 'user_id');
}

    public function workType()
    {
        return $this->belongsTo('App\Models\WorkType','work_type_id','id');
    }
    public function bankCard()
    {
        return $this->hasOne('App\Models\Finance\BankCard');
    }
    protected $fillable = [
        'by_agent_num','idcard','idcard_pho','pid','cash_password','sex','birthday','level_id','nickname','phone', 'password', 'user_type','access_key','recommend_id', 'distributor_id','access_token','work_type_id','head_portrait','user_source','real_name'
    ];//设置哪些属性可以批量赋值
}
