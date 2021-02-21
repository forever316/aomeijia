<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LinkType extends Model
{

    protected $table = 'link_type';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];//设置哪些属性可以批量赋值
}
