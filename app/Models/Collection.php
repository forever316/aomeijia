<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Collection extends Model
{

    protected $table = 'collection';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'goods_id','goods_name', 'access_token', 'access_key',
    ];//设置哪些属性可以批量赋值

    //商品表
    public function goodsInfo()
    {
        return $this->hasOne('App\Models\Goods\Goods', 'id','goods_id');
    }
}
