<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MigrateTest extends Model
{

    protected $table = 'migrate_test';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone','email','sex','city','reason','capital','education','oversea_identity','english_level'
    ];//设置哪些属性可以批量赋值
}
