<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Migrate extends Model
{

    protected $table = 'migrate';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','type_id','invest_id','title','project_charac','live_require','identity','transact_period','total_price','user_id','project_brief','project_advantage','apply_condition','apply_process','sort','status','read','real_read','publish_date','img'
    ];//设置哪些属性可以批量赋值
}
