<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WechatMember;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     **获取请求参数
     **ljf
     * @param array $data
     * @param Request $request
     * @return array
     */
    protected function getInput($form,$data = [],$request){
        $return = [];
        //类型验证，避免数据库注入以及数据错误
        foreach($data as $key=>$item){
            $value = $request->input($key);
            $bool = settype($value,$item);
            if($bool){
                $return[$key] = $value;
            }
        }
        //是否需要表单验证
        if(!empty($form)){
            $error = $this->verifyForm($form,$return);
            if(!empty($error)){
                $error['error'] = true;
                return $error;
            }
        }
        //快闪数据缓存
        $request->flash();
        return $return;
    }
    /**
     **验证表单
     **ljf
     */
    protected function verifyForm($form,$data){
        $error = [];
        foreach($data as $key=>$value){
            if(isset($form['field'][$key]['verify'])){
                foreach($form['field'][$key]['verify'] as $k=>$item){

                    //必填
                    if($item == 'required'){
                        if(is_array($value)){
                            if(!isset($value) || empty($value)){
                                $error[$key] = '请选择'.$form['field'][$key]['text'];
								break;
                            }
                        }else{
                            if((string)$value != '0'){
                                if(!isset($value) || empty($value) || $value == ''){
                                    $error[$key] = $form['field'][$key]['text'].'不能为空';
                                    if(in_array($form['field'][$key]['type'],['radio','select'])){
                                        if((string)$value == '0'){
                                            unset($error[$key]);
                                            $error[$key] = '请选择'.$form['field'][$key]['text'];
											break;
                                        }
                                    }
									break;
                                }
                            }
                        }
                    }

                    //只能为数字
                    if($item == 'number'){
                        if(!is_numeric($value)){
                            $error[$key] = $form['field'][$key]['text'].'只能为数字';
                            break;
                        }
                    }

                    //手机号
                    if($item == 'phone'){
                        $pattern='/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
                        if(!preg_match($pattern, $value)){
                            $error[$key] = $form['field'][$key]['text'].'不正确';
                            break;
                        }
                    }

                    //邮箱
                    if($item == 'email'){
                        $pattern='/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
                        if(!preg_match($pattern, $value)){
                            $error[$key] = $form['field'][$key]['text'].'不正确';
                            break;
                        }
                    }
                }
            }
        }
        return $error;
    }

    /**
     * 计算字符串的长度
     * ljf
     * @param $str
     * @return int
     */
    protected function abslength($str){
        if(empty($str)){
            return 0;
        }
        if(function_exists('mb_strlen')){
            return mb_strlen($str,'utf-8');
        }
        else {
            preg_match_all("/./u", $str, $ar);
            return count($ar[0]);
        }
    }



    /**
     **json格式返回
     **ljf
     */
    protected function returnJson($bool=true,$msg='',$type="input"){
        $return = [];
        if($bool){
            $return['status'] = 200;//成功的状态
            if($msg == ''){
                $msg = '操作成功';
            }
        }else{
            $return['status'] = 500;//失败的状态
            if($msg == ''){
                $msg = '操作失败';
            }
        }
        $return['msg'] = $msg;
        $return['type'] = $type;
        return json_encode($return);
    }

    //返回成功
    protected function returnTrue($msg='',$status=200){
        $return['msg'] = $msg;
        $return['status'] = $status;
        return json_encode($return);
    }
    //返回失败
    protected function returnError($error=''){
        $return['error'] = $error;
        $return['status'] = 500;
        return json_encode($return);
    }

    /**
     *获取当前控制器与方法
     *ljf
     */
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }
    //微商城中获得access_key
    public function getAccess_key()
    {
        $urlArray = explode('.', $_SERVER['HTTP_HOST']);
        return $urlArray[0];
    }
    //微商城中获得用户access_token
    public function getAccess_token()       
    {
        // $request->session()->forget('user');
        $user = Session::get('wechat_user');
        $openid = $user['id'];
        $data = WechatMember::where('openid',$openid)->first();
        $data = User::where('id',$data['user_id'])->first();
        return $data['access_token'];
    }

    function getAdminUserIdName(){
        $userArray = array();
        $user = DB::table('admin_user')->get(array('id','name'));
        foreach($user as $item){
            $userArray[$item->id] = $item->name;
        }
        return $userArray;
    }


}
