<?php

namespace App\Models\Authority;
use Illuminate\Database\Eloquent\Model;
class MenuRole extends Model
{

    protected $table = 'menu_role';//指定表名

    public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','menu_key','access_key','sort'
    ];//设置哪些属性可以批量赋值
}
