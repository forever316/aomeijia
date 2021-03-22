<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Article extends Model
{

    protected $table = 'article';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    //$typeArr = ['1'=>'公司简介','2'=>'加入我们',3=>'联系我们',4=>'集团动态',5=>'项目动态',6=>'投资主题',,7,考察团内容，8往期考察团回顾，9往期活动回顾'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','title', 'content', 'sort','describe','status','thumb','real_read','read','publish_date','close_date'
    ];//设置哪些属性可以批量赋值
}
