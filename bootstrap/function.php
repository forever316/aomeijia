<?php

use EasyWeChat\Foundation\Application;
use App\Models\WechatConfig;
use App\Models\Home\CompanyConfig;

//批量添加或者更新數據，可避免唯一鍵冲突时报错
function batchInsert($table,$data){
    $fields = array_keys(current($data));
    $sql = 'INSERT INTO '.$table.' (`'.join('`,`',$fields).'`) values';//字段用反引号分隔
    foreach($data as $key=>$val){
        $sql .= ' ("'.join('","',$val).'"),';//数据用双引号分隔

    }
    $str = '';
    foreach($fields as $val){
        $str.= $val.'=VALUES('.$val.'),';
    }
    $sql = rtrim($sql,',');
    $sql .=' ON DUPLICATE KEY UPDATE '.rtrim($str,',');
    \DB::insert($sql);
}

     function getAuthority(){
        $user = Session::get('user');

        $roles = [];
        $department_role = \App\Models\Authority\DepartmentRole::select(['role_id'])->where('department_id','=',$user->dept_id)->get();
        $adminUserRole = \App\Models\Authority\AdminUserRole::select(['role_id'])->where('admin_user_id','=',$user->id)->get();
        foreach($department_role as $key=>$item){
            $roles[] = $item->role_id;
        }

        foreach($adminUserRole as $key=>$item){
            if(!in_array($item->role_id,array_values($roles))){
                $roles[] = $item->role_id;
            }
        }

        $menu = \App\Models\Authority\MenuRole::select(['menu_key'])->whereIn('role_id',$roles)->groupBy('menu_key')->get()->toArray();
        $resources = \App\Models\Authority\ResourcesRole::select(['resources_key'])->whereIn('role_id',$roles)->groupBy('resources_key')->get()->toArray();

        $authority['menu'] = [];
        $authority['resources'] = [];
        foreach($menu as $key=>$item){
            $authority['menu'][] = $item['menu_key'];
        }
        foreach($resources as $key=>$item){
            $authority['resources'][] = $item['resources_key'];
        }

         \Illuminate\Support\Facades\Session::put('authority',$authority);
    }

    //获取微信app
    function getWxApp($wx_token,$model = 'wx'){
        $wechatConfig = wechatConfig::where('access_key','=',$wx_token)->first();
        if($model == 'app'){
            $wechatConfig->app_id = $wechatConfig->app_app_id;
            $wechatConfig->secret = $wechatConfig->app_secret;
            $wechatConfig->token = $wechatConfig->app_token;
            $wechatConfig->aes_key = $wechatConfig->app_aes_key;
            $wechatConfig->merchant_id = $wechatConfig->app_merchant_id;
            $wechatConfig->cert_path = $wechatConfig->app_cert_path;
            $wechatConfig->payment_key = $wechatConfig->app_payment_key;
            $wechatConfig->key_path = $wechatConfig->app_key_path;
        }
        if($wechatConfig) {
           $options = [
               'debug' => true,
               'app_id' => $wechatConfig->app_id,
               'secret' => $wechatConfig->secret,
               'token' => $wechatConfig->token,
               'aes_key' => $wechatConfig->aes_key,
               'log' => [
                   'level' => 'debug',
                   'file' => 'tmp/easywechat.log',
               ],
               'oauth' => [
                   'scopes'   => ['snsapi_userinfo'],
                   'callback' => '/oauth_callback',
               ],
               'payment' => [
                    'merchant_id'        => $wechatConfig->merchant_id,
                    'key'                => $wechatConfig->payment_key,
                    'cert_path'          => $wechatConfig->cert_path, // XXX: 绝对路径！！！！
                    'key_path'           => $wechatConfig->key_path,      // XXX: 绝对路径！！！！
                    'notify_url'         => 'http://'.$_SERVER['HTTP_HOST'].'/wxPayCallback',
               ],
           ];
            $app = new Application($options);
            return $app;
        }else{
            return null;
        }
    }



    //短信发送接口
    function smssend($phones,$content){
        $username = "nwquanzhoupa";
        $pwd = "nwquanzhoupa123";
        $password = md5($username."".md5($pwd));
        $mobile = $phones;
        $content = $content;
        $url = "http://120.55.248.18/smsSend.do?";

        $param = http_build_query(
            array(
                'username'=>$username,
                'password'=>$password,
                'mobile'=>$mobile,
                'content'=>$content
            )
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function create_token($userid){
        return md5($userid.date('Y-m-d', time()));
    }
    function makeOrders(){
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

//身份证号验证

 function _checkIdCard($idcard){

    $City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽 宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>" 安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>" 湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>" 贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>" 宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");

    $iSum = 0;

    $idCardLength = strlen($idcard);

//长度验证

    if(!preg_match('/^\d{17}(\d|x)$/i',$idcard) and!preg_match('/^\d{15}$/i',$idcard))

    {

        return false;

    }

//地区验证

    if(!array_key_exists(intval(substr($idcard,0,2)),$City))

    {

        return false;

    }

// 15位身份证验证生日，转换为18位

    if ($idCardLength == 15)

    {

        $sBirthday = '19'.substr($idcard,6,2).'-'.substr($idcard,8,2).'-'.substr($idcard,10,2);

        $d = new DateTime($sBirthday);

        $dd = $d->format('Y-m-d');

        if($sBirthday != $dd)

        {

            return false;

        }

        $idcard = substr($idcard,0,6)."19".substr($idcard,6,9);//15to18

        $Bit18 = getVerifyBit($idcard);//算出第18位校验码

        $idcard = $idcard.$Bit18;

    }

// 判断是否大于2078年，小于1900年

    $year = substr($idcard,6,4);

    if ($year<1900 || $year>2078 )

    {

        return false;

    }



//18位身份证处理

    $sBirthday = substr($idcard,6,4).'-'.substr($idcard,10,2).'-'.substr($idcard,12,2);
//		$d = new DateTime($sBirthday);
//
//
//		$dd = $d->format('Y-m-d');

    if($sBirthday != date('Y-m-d',strtotime($sBirthday)))

    {

        return false;

    }

//身份证编码规范验证

    $idcard_base = substr($idcard,0,17);

    if(strtoupper(substr($idcard,17,1)) != getVerifyBit($idcard_base))

    {

        return false;

    }

    return true;

}



// 计算身份证校验码，根据国家标准GB 11643-1999

 function getVerifyBit($idcard_base)

{

    if(strlen($idcard_base) != 17)

    {

        return false;

    }

//加权因子

    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);

//校验码对应值

    $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4','3', '2');

    $checksum = 0;

    for ($i = 0; $i < strlen($idcard_base); $i++)

    {

        $checksum += substr($idcard_base, $i, 1) * $factor[$i];

    }

    $mod = $checksum % 11;

    $verify_number = $verify_number_list[$mod];

    return $verify_number;

}
//银行卡验证
 function luhm($no) {
     $arr_no = str_split($no);
     $last_n = $arr_no[count($arr_no)-1];
     krsort($arr_no);
     $i = 1;
     $total = 0;
     foreach ($arr_no as $n){
         if($i%2==0){
             $ix = $n*2;
             if($ix>=10){
                 $nx = 1 + ($ix % 10);
                 $total += $nx;
             }else{
                 $total += $ix;
             }
         }else{
             $total += $n;
         }
         $i++;
     }
     $total -= $last_n;
     $x = 10 - ($total % 10);
     if($x == $last_n){
         return true;
     }
     return false;
}
//支付宝验证数据
function alipay(){
    $option=[
        'app_id'=>'2017022005778017',
        'biz_content'=>'',//业务请求参数的集合
        'charset'=>'utf-8',
     //   'format'=>'json',
        'method'=>'alipay.trade.app.pay',
        'notify_url'=>'http://tl.youyu333.com/recharge_notify',//回调地址
        'sign_type'=>'RSA2',
        'timestamp'=>'2017-04-26 10:59:58',//date('Y-m-d H:i:s',time()),//'2017-02-22 14:22:22',
        'version'=>'1.0',
        'sign'=>'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCqLzSzP0JGPdwvriKNX5pLnC3eMcljMi0DyPKPLkL1eF8d/die1x+XpxFdCCrOKFjtP9/idSpG35Nl79T0GANijGldpQHR+e5ClH8zrKM2AjdMAyrYfsohyLUj0TeacXWvUZjPR4h+33u/CZggP1XqqsmN/+oAcMqmbS8eFyq+u1r2j5cVWXnM/qgNfWdnCYHqOMEY3BhvAvRrHFVoxADBTh3CJOGjt1IcVycbB/kOBri/RLANYqx6unKdfqRtlgUvaPRyj4rwBpuN3SwJTpmspg/hsQDZhJhTssMSwC9w4O3muArws0efDTmvg4+QUszsRUexlm5JJ15SHau/s6fhAgMBAAECggEBAJEyw2jnYPkjEDiR/qLV3YQDFVNM8QC0L5naGbE1jCV49NZW3TnwWuD9xp+0Nyk7XVvWMoM46cAcQtsm+27jCghLuh4OiXYIIlMl9T02Xu3WiC1PSn/59SVL49hSSXl4sirJmHHJG1j7/c1pNyTURM55totzu8dydEP4RcoLhAnD1Gkl3PPWQx5psTVKR99xld23Ukw+MyaZX6iw9X1uQ3EidhCLMwTIb/0CXDCHbh/TA215BfA9cY/s+NlnJ4hYOTgE4CxORRoS4Z4lEP0Wvh1tLnBZDdj80qo73K8O6bLAMtAZHj09U7ky/8QkKy3OO0G+qplT0MKhEzsxi8BIxt0CgYEA5D0H7RdBwWt6t8R64aupHLpGu4ZvyE6oPHYUU9kDniPCMKgXOfCvAZCFqKiq0BH5pNrmtsxBWexwtTOm/4HSLNXJoixw2AEgcVRXyhbPI6+0sJ8rwR+p5Hl8kvzMRXsc91EsLY1OP1e6Jv3Sek1+dzVXzbkMpKNCZhsZ6habgOMCgYEAvuJ38i03h/BHe51OAV9OzuxtXPrSUnB7lLxC2eWyrG5HpLHX+uzYnRJbYUmdDrn2KWmsdE5n3MoBhrM6qmmoZSlceedMuAzdWTCH0VROmE1er6KrM+ng4DPvsebFFl4D/5fSdjsvS8xRiOvBSNKnGHg+0/yCp3fo8bsOXWY/Y2sCgYEAvlkMADbSNz6tBRAPL6BblMLh9Mlk9phrBKmxwFAQDVZjQPMfE8pgGhzu679nXcpv+oY5viBRLG7dfLHMR/F8WLofxGnt3qfp57pg0QD+1hNWzaqh8hm3Nf3/4BKHRjcr7DM9dewQYxGGBbjQTgHNRBwv0znOioxB9ygJD8q0++MCgYEAgqJUeh2t2k97bEK8Zr4GHiC5u59AHwEx4hlxGtRTEiSqzTCU4foDSIOOnCcX4EMuDyttxW7/L5/jqX6xUHzcrNbAngDIhVDwjyBiYsTywNJ6UXLe/bk6l9WTXcnT6bnPvLT3aMiaVqJuzmihr6fSiTGJteQiul+awQxGCW93RB8CgYBjV0zCngYruutn9Sc2x4rh/KRwywjYUYtKE78ajQGUA/5Qd3/v2Ux7f/fJU/+B5jn9Ht5bfLm11bJMcsRyNXl3oxRZQvAnRpMAej4ajw0UEnYusApHa1RR4IR8pLjj6rGDmCu1f/OUg7QKWA1nIh536zfrvclquF6BYujaIld8pA==',
    ];
    return $option;
}

function build_query($query_data, $encoding = false) {
    $res = '';
    $count = count ( $query_data );
    $i = 0;
    foreach ( $query_data as $k => $v ) {
        if ($encoding === true) {
            $v = urlencode ( $v );
        }
        if ($i < $count - 1) {
           // $res .= $k . '=' . $v . '&';
            $res.=$k."=".'"'.$v.'"'."&";
        } else {
           // $res .= $k . '=' . $v;
            $res.=$k."=".'"'.$v.'"';
        }
        $i ++;
    }
    dd($res);
    return $res;
}

/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstring($para) {
    $arg  = "";
    while (list ($key, $val) = each ($para)) {
        $arg.=$key."=".'"'.$val.'"'."&";
    }
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}
function userNumber($type='HK'){
    return $type.date('Ymd',time()).mt_rand(1,1000000);
}

function getConfig($field=['*']){
    $config = CompanyConfig::select($field)->where('id','=',1)->first()->toArray();
    return $config;
}


/*
 * 基数增长
 * */
function increaseConfig($field='user_num',$num=1){
    if(!in_array($field,['user_num','store_num','store_amount'])){
        return 'fail';
    }
    $result = CompanyConfig::where('id','=',1)->increment($field,$num);
    if($result){
        return 'success';
    }
    return 'fail';
}