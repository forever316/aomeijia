<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User_relations extends Model
{

    protected $table = 'user_relations';//指定表名
    protected $fillable = [
        'level', 'pid','child_id'
    ];//设置哪些属性可以批量赋值

}
