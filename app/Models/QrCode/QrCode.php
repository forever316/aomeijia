<?php

namespace App\Models\QrCode;
use Illuminate\Database\Eloquent\Model;
class QrCode extends Model
{

    protected $table = 'qr_code';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id','number','integral', 'status','access_key','goods_name','user_id','user_nickname','batch','operation_user','type','user_type','province','city'
    ];//设置哪些属性可以批量赋值

    //OLK
    //要在QrCode 中查询  stockHolder 表的信息
    public function stockHolder()
    {
        return $this->hasOne('App\Models\StockHolder', 'id','stock_id');
    }

    public function userInfo()
    {
        return $this->belongsTo('App\Models\Userinfo','user_id','user_id');
    }
}
