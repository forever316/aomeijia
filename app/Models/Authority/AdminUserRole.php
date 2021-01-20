<?php

namespace App\Models\Authority;
use Illuminate\Database\Eloquent\Model;
class AdminUserRole extends Model
{

    protected $table = 'admin_user_role';//指定表名

    public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id','role_id'
    ];//设置哪些属性可以批量赋值
}
