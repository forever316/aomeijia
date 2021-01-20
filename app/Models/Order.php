<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'order';//指定表名
    public $timestamps  = false;

    public function OrderGoods()
    {
        return $this->hasOne('App\Models\OrderGoods','order_sn','order_sn');
    }
    public function User(){
        return $this->hasOne('App\Models\User','access_token','access_token');
    }
}
