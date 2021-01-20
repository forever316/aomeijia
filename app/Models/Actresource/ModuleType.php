<?php

namespace App\Models\Actresource;
use Illuminate\Database\Eloquent\Model;
class ModuleType extends Model
{

    protected $table = 'actresource_module_type';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','status','sort','module_id',
    ];//设置哪些属性可以批量赋值
}
