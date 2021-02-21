<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class City extends Model
{

    protected $table = 'city';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid','name', 'pic','sort','hot','english_name'
    ];//设置哪些属性可以批量赋值

    public function getTypePath($str = '',$pid){
        if($pid != 0){
            $type = $this->where('id','=',$pid)->first();
            if(!$type){
                abort(500,'类型不存在');
            }
            $str = $type->id.','.$str;
            if($type->pid != 0){
                return $this->getTypePath($str,$type->pid);
            }
        }
        return $str;
    }

    public function children(){
        return $this->hasMany(get_class($this), "pid",'id');
    }
}
