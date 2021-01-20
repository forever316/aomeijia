<?php

namespace App\Models\Authority;
use Illuminate\Database\Eloquent\Model;
class DepartmentRole extends Model
{

    protected $table = 'department_role';//指定表名

    public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id','role_id'
    ];//设置哪些属性可以批量赋值
}
