<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ApiModular extends Model
{

    protected $table = 'api_modular';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','status', 'sort','access_key','thumb'
    ];//设置哪些属性可以批量赋值
}
