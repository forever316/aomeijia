<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Active extends Model
{

    protected $table = 'active';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumb','theme','type','time','address','content','sort','status','show_start_date','show_end_date'
    ];//设置哪些属性可以批量赋值
}
