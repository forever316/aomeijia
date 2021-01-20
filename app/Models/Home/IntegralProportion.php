<?php

namespace App\Models\Home;
use Illuminate\Database\Eloquent\Model;
class IntegralProportion extends Model
{

    protected $table = 'integral_proportion';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proportion', 'access_key'
    ];//设置哪些属性可以批量赋值
}
