<?php

namespace App\Models;
use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'message';//指定表名
    public $timestamps  = false;

    protected $fillable = [
        'access_key', 'user_id','content','status','add_time'
    ];//设置哪些属性可以批量赋值

    public function add_message($user_id,$content){

        $member = User::where('id','=',$user_id)->first();
        if(!$member){
            return false;
        }
        $memberDetail = Userinfo::where('user_id','=',$member->id)->lockForUpdate()->first();
        
        if(!$memberDetail){
            return false;
        }
        $this->user_id = $user_id;
        $this->content = $content;
        $this->status = -1;
        $this->add_time = time();
        if(!$this->save()){
            return false;
        }
        return true;
    }
}
