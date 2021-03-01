<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Information extends Model
{

    protected $table = 'information';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','type_id','thumb','title','describe','content','sort','status','read','real_read','publish_date','category'
    ];//设置哪些属性可以批量赋值
}
