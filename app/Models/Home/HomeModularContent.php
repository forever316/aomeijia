<?php

namespace App\Models\Home;
use Illuminate\Database\Eloquent\Model;
class HomeModularContent extends Model
{

    protected $table = 'home_modular_content';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','desc', 'modular_id','img','goods_type_id','access_key','sort','goods_id'
    ];//设置哪些属性可以批量赋值
}
