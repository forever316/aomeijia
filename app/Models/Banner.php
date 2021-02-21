<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Banner extends Model
{

    protected $table = 'banner';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','title', 'link', 'status','img_url','sort','describe'
    ];//设置哪些属性可以批量赋值
}
