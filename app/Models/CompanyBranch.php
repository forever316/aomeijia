<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CompanyBranch extends Model
{

    protected $table = 'company_branch';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name','company_address','sort'
    ];//设置哪些属性可以批量赋值
}
