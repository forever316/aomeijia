<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enum;
use App\Models\City;
use App\Models\Link;
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
     **wlf
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
     **wlf
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
     * wlf
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
     **wlf
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
     *wlf
     */
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }
    /*
     * 获取后台用户数组
     * id=>name 
    */
    function getAdminUserIdName(){
        $userArray = array();
        $user = DB::table('admin_user')->get(array('id','name'));
        foreach($user as $item){
            $userArray[$item->id] = $item->name;
        }
        return $userArray;
    }

    function findChild(&$arr,$id){
        $childs=array();
        foreach ($arr as $k => $v){
            if($v['pid']== $id){
                $childs[]=$v;
            }
        }
        return $childs;
    }

    function build_tree($rows,$root_id){
        $childs=$this->findChild($rows,$root_id);
        if(empty($childs)){
            return null;
        }
        foreach ($childs as $k => $v){
            $rescurTree=$this->build_tree($rows,$v['id']);
            if( null != $rescurTree){
                $childs[$k]['childs']=$rescurTree;
            }
        }
        return $childs;
    }

    //得到城市的id与name对应关系
	function getCityIdName()
	{
		$cityData = array();
		$_cityData = City::select(['id','name'])->orderBy('sort','desc')->get();
		if($_cityData){
			foreach($_cityData as $item){
				$cityData[$item->id] = $item->name;
			}
		}
		return $cityData;
	}

	//得到某个类型的所有枚举数据
	function getEnumByType($type)
	{
		$objType = Enum::select(['id','name'])->where('status',1)->whereIn('type',$type)->orderBy('sort','desc')->get();
		$typeData = array();
		foreach($objType as $item){
			$typeData[$item->id] = $item->name;
		}
		return $typeData;
	}
    ///////////////////////////前台模块
    /*
    * 得到所有的友情链接
    */
    function getLinkData()
    {
        $_linkData = Link::where('status',1)->orderBy('sort','desc')->get()->toArray();
        $linkData = array();
        foreach($_linkData as $key=>$val){
            $linkData[$val['type']][] = $val;
        }
        return $linkData;
    }


}
