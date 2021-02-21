<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OverseaHouse extends Model
{

    protected $table = 'oversea_house';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id','type_id','feature_id','images','project_atlas','unit_price','title','describe','home_show','complete_date','area','house_type','total_price','property_year','first_payment','year_return','house_standard','address','sort','status','watch_number','publish_date','basic_info','main_door','surround_facility','program_feature','invest_analysis','tag_id'
    ];//设置哪些属性可以批量赋值
}
