<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'cart';//指定表名
    public $timestamps  = false;

    protected $fillable = [
        'access_key', 'access_token','goods_id','goods_name','goods_price','goods_number','good_attr','status','add_time'
    ];//设置哪些属性可以批量赋值
}
