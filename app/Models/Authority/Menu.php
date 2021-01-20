<?php

namespace App\Models\Authority;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{

    protected $table = 'menu';//指定表名

    public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modular_id','menu_key','menu_title','menu_url','sort'
    ];//设置哪些属性可以批量赋值
}
