<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Stocks extends Model
{

    protected $table = 'stocks';//指定表名

    // public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scode', 'sname', 'price','tprice','prefix','status'
    ];//设置哪些属性可以批量赋值

    //得到商品的IdCode键值对数组
    public function getStocksIdCode($flag='')
    {
        if($flag){
            $model = self::select(['id','scode'])->where('status',0)->orderBy('created_at','desc')->get();
        }else{
            $model = self::select(['id','scode'])->orderBy('created_at','desc')->get();
        }

        $scodeArray = array();
        foreach($model as $item){
            $scodeArray[$item->id] = $item->scode;
        }
        return $scodeArray;
    }
    //得到商品的IdName键值对数组
    public function getStocksIdName($flag='')
    {
        if($flag){
            $model = self::select(['id','sname'])->where('status',0)->orderBy('created_at','desc')->get();//启用状态的code
        }else{
            $model = self::select(['id','sname'])->orderBy('created_at','desc')->get();
        }

        $snameArray = array();
        foreach($model as $item){
            $snameArray[$item->id] = $item->sname;
        }
        return $snameArray;
    }

}
