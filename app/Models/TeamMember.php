<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model
{

    protected $table = 'team_member';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','job', 'phone', 'sort','status','photo','describe','wechat_id','wechat_code'
    ];//设置哪些属性可以批量赋值

    //得到团队成员的列表
    public static function getTeamMemberList()
    {
        $_data = self::where('status',1)->orderBy('sort','desc')->get();
        $data = array();
        foreach($_data as $item){
            $data[$item->id] = $item->name;
        }
        return $data;
    }
}
