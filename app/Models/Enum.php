<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Enum extends Model
{

    protected $table = 'enum';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','name','sort','status'
    ];//设置哪些属性可以批量赋值

    //获取所有数据
    public static function getEnumAllData()
    {
        $data = self::get()->pluck('name','id')->toArray();
        return $data;
    }
}
