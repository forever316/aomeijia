<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InvestCountry extends Model
{

    protected $table = 'invest_country';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','tag_id','thumb','hot','advantage_img','title','sort','status','read','real_read','publish_date','describe','content'
    ];//设置哪些属性可以批量赋值
}
