<?php

namespace App\Models\Home;
use Illuminate\Database\Eloquent\Model;
class HomeModular extends Model
{

    protected $table = 'home_modular';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modular_name','modular_img', 'access_key','sort','modular_type'
    ];//设置哪些属性可以批量赋值

    public function homeModularContent()
    {
        return $this->hasOne('App\Models\Home\HomeModularContent','modular_id');
    }
}
