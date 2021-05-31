<?php

namespace App\Http\Controllers\Front;

use App\Models\CustomerConsult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CommonController  extends Controller
{
    //客户咨询操作，添加数据到数据库中
    public function consultAdd()
    {
        $data = $_POST;
        $res = CustomerConsult::create($data);
        $return['status'] = 0;
        $return['msg'] = '失败';
        if($res){
            $return['status'] = 1;
            $return['msg'] = '成功';
        }
        return json_encode($return);
    }


}