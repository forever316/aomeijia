<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ArticleType extends Model
{

    protected $table = 'article_type';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','access_key',
    ];//设置哪些属性可以批量赋值
}
