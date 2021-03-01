<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Faqs extends Model
{

    protected $table = 'faqs';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','questions','answers','sort','status'
    ];//设置哪些属性可以批量赋值
}
