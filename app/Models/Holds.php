<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Holds extends Model
{

    protected $table = 'holds';//指定表名

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'amount', 'status', 'cdate'
    ];//设置哪些属性可以批量赋值
}
