<?php

namespace App\Models\Actresource;
use Illuminate\Database\Eloquent\Model;
class ActresourceModule extends Model
{

    protected $table = 'actresourse_module';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','status','sort',
    ];//设置哪些属性可以批量赋值
}
