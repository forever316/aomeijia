<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enum;
use App\Models\City;
use App\Models\Link;
use App\Models\WechatMember;
use App\Models\CompanyConfig;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\OverseaHouse;
use App\Models\Migrate;
use App\Models\Information;
use App\Models\Faqs;
use App\Models\Article;
use App\Models\Active;

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
    protected function getInput($form, $data = [], $request)
    {
        $return = [];
        //类型验证，避免数据库注入以及数据错误
        foreach ($data as $key => $item) {
            $value = $request->input($key);
            $bool = settype($value, $item);
            if ($bool) {
                $return[$key] = $value;
            }
        }
        //是否需要表单验证
        if (!empty($form)) {
            $error = $this->verifyForm($form, $return);
            if (!empty($error)) {
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
    protected function verifyForm($form, $data)
    {
        $error = [];
        foreach ($data as $key => $value) {
            if (isset($form['field'][$key]['verify'])) {
                foreach ($form['field'][$key]['verify'] as $k => $item) {

                    //必填
                    if ($item == 'required') {
                        if (is_array($value)) {
                            if (!isset($value) || empty($value)) {
                                $error[$key] = '请选择' . $form['field'][$key]['text'];
                                break;
                            }
                        } else {
                            if ((string)$value != '0') {
                                if (!isset($value) || empty($value) || $value == '') {
                                    $error[$key] = $form['field'][$key]['text'] . '不能为空';
                                    if (in_array($form['field'][$key]['type'], ['radio', 'select'])) {
                                        if ((string)$value == '0') {
                                            unset($error[$key]);
                                            $error[$key] = '请选择' . $form['field'][$key]['text'];
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    }

                    //只能为数字
                    if ($item == 'number') {
                        if (!is_numeric($value)) {
                            $error[$key] = $form['field'][$key]['text'] . '只能为数字';
                            break;
                        }
                    }

                    //手机号
                    if ($item == 'phone') {
                        $pattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
                        if (!preg_match($pattern, $value)) {
                            $error[$key] = $form['field'][$key]['text'] . '不正确';
                            break;
                        }
                    }

                    //邮箱
                    if ($item == 'email') {
                        $pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
                        if (!preg_match($pattern, $value)) {
                            $error[$key] = $form['field'][$key]['text'] . '不正确';
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
    protected function abslength($str)
    {
        if (empty($str)) {
            return 0;
        }
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, 'utf-8');
        } else {
            preg_match_all("/./u", $str, $ar);
            return count($ar[0]);
        }
    }

    /**
     **json格式返回
     **wlf
     */
    protected function returnJson($bool = true, $msg = '', $type = "input")
    {
        $return = [];
        if ($bool) {
            $return['status'] = 200;//成功的状态
            if ($msg == '') {
                $msg = '操作成功';
            }
        } else {
            $return['status'] = 500;//失败的状态
            if ($msg == '') {
                $msg = '操作失败';
            }
        }
        $return['msg'] = $msg;
        $return['type'] = $type;
        return json_encode($return);
    }

    //返回成功
    protected function returnTrue($msg = '', $status = 200)
    {
        $return['msg'] = $msg;
        $return['status'] = $status;
        return json_encode($return);
    }

    //返回失败
    protected function returnError($error = '')
    {
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
    function getAdminUserIdName()
    {
        $userArray = array();
        $user = DB::table('admin_user')->get(array('id', 'name'));
        foreach ($user as $item) {
            $userArray[$item->id] = $item->name;
        }
        return $userArray;
    }

    function findChild(&$arr, $id)
    {
        $childs = array();
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $id) {
                $childs[] = $v;
            }
        }
        return $childs;
    }

    function build_tree($rows, $root_id)
    {
        $childs = $this->findChild($rows, $root_id);
        if (empty($childs)) {
            return null;
        }
        foreach ($childs as $k => $v) {
            $rescurTree = $this->build_tree($rows, $v['id']);
            if (null != $rescurTree) {
                $childs[$k]['childs'] = $rescurTree;
            }
        }
        return $childs;
    }

    //得到城市的id与name对应关系
    function getCityIdName()
    {
        $cityData = array();
        $_cityData = City::select(['id', 'name'])->orderBy('sort', 'desc')->orderBy('id', 'desc')->get();
        if ($_cityData) {
            foreach ($_cityData as $item) {
                $cityData[$item->id] = $item->name;
            }
        }
        return $cityData;
    }

    //得到某个类型的所有枚举数据
    function getEnumByType($type)
    {
        $objType = Enum::select(['id', 'name'])->where('status', 1)->whereIn('type', $type)->orderBy('sort', 'desc')->get();
        $typeData = array();
        foreach ($objType as $item) {
            $typeData[$item->id] = $item->name;
        }
        return $typeData;
    }
    ///////////////////////////前台模块
    /*
    * 得到公司信息
    */
    function getCompanyData()
    {
        return CompanyConfig::where('id', 1)->first()->toArray();
    }

    /*
    * 得到所有的友情链接
    */
    function getLinkData()
    {
        $_linkData = Link::where('status', 1)->orderBy('sort', 'desc')->get()->toArray();
        $linkData = array();
        foreach ($_linkData as $key => $val) {
            $linkData[$val['type']][] = $val;
        }
        return $linkData;
    }

    /*
     * 得到其他页面显示的四个热门海外房产项目
     * $limit取出n条数据
     * $condition为检索条件
     */
    function getShowHouseData($limit, $condition = array())
    {
        $date = date('Y-m-d');
        $query = OverseaHouse::where('status', 1)->where('home_show', 1)->where('publish_date', '<=', $date);
        if ($condition) {
            foreach ($condition as $key => $val) {
                if (is_array($val)) {
                    $query = $query->whereIn($key, $val);
                } else {
                    $query = $query->where($key, $val);
                }
            }
        }
        $data = $query->orderBy('sort', 'desc')->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->take($limit)->get()->toArray();
        $cityData = City::getCityAllData();//得到城市所有数据
        $typeData = Enum::getEnumAllData();//得到类型所有数据
        foreach ($data as $key => $val) {
            $imgArr = array_filter(explode(';', $val['images']));
            $data[$key]['img'] = $imgArr ? current($imgArr) : '';
            //min_img为其他页面显示的图片，一行4条数据
            $data[$key]['min_img'] = $this->crop_img($data[$key]['img'],292,254);

            $data[$key]['city_name'] = isset($cityData[$val['city_id']]) ? $cityData[$val['city_id']] : $val['city_id'];
            $data[$key]['type_name'] = isset($typeData[$val['type_id']]) ? $typeData[$val['type_id']] : $val['type_id'];
            $tagArr = array_filter(explode(';', $val['tag_id']));
            $data[$key]['tag_name'] = array();
            foreach ($tagArr as $k => $v) {
                $data[$key]['tag_name'][$k] = isset($typeData[$v]) && $typeData[$v] ? $typeData[$v] : $v;
            }
        }
        return $data;
    }

    /*
     * 得到其他页面显示的n个热门移民项目
     * $limit取出n条数据
     * $condition为检索条件
     */
    function getShowMigrateData($limit, $condition = array())
    {
        $date = date('Y-m-d');
        $query = Migrate::where('status', 1)->where('publish_date', '<=', $date);
        if ($condition) {
            foreach ($condition as $key => $val) {
                if (is_array($val)) {
                    $query = $query->whereIn($key, $val);
                } else {
                    $query = $query->where($key, $val);
                }
            }
        }
        $data = $query->orderBy('sort', 'desc')->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->take($limit)->get()->toArray();
        foreach($data as $key=>$val){
            $data[$key]['max_img'] = $this->crop_img($data[$key]['img'],789,419);
            $data[$key]['middle_img'] = $this->crop_img($data[$key]['img'],390,419);
            $data[$key]['min_img'] = $this->crop_img($data[$key]['img'],288,288);
        }
        return $data;
    }

    /*
     * 得到其他页面显示的n个热门资讯项目
     * $limit取出n条数据
     * $condition为检索条件
     * category = 1为热门资讯
     * category = 2为成功案例
     */
    function getShowInfoData($limit, $condition = array())
    {
        $date = date('Y-m-d');
        $query = Information::where('status', 1)->where('publish_date', '<=', $date);
        if ($condition) {
            foreach ($condition as $key => $val) {
                if (is_array($val)) {
                    $query = $query->whereIn($key, $val);
                } else {
                    $query = $query->where($key, $val);
                }
            }
        }
        if($limit>0){
            $data = $query->orderBy('sort', 'desc')->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->take($limit)->get()->toArray();
        }else{
            $data = $query->orderBy('sort', 'desc')->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->get()->toArray();
        }
        foreach($data as $key=>$val){
            $data[$key]['max_thumb'] = $this->crop_img($data[$key]['thumb'],547,362);
            $data[$key]['min_thumb'] = $this->crop_img($data[$key]['thumb'],140,91);
        }

        return $data;
    }

    /*
     * 取出7个最新资讯
     */
    function getInfoData($countryIds = array())
    {
        $conditions['category'] = 1;
        if($countryIds){
            $conditions['city_id'] = $countryIds;
        }
        $data['info'] = $this->getShowInfoData(7, $conditions);
        $i = 1;
        $data['info_top'] = $data['info_inner'] = $data['right_top'] = array();
        foreach ($data['info'] as $key => $val) {
            if ($i == 1) {
                $data['info_top'] = $val;
            } elseif ($i <= 3) {
                $data['info_inner'][] = $val;
            } else {
                $data['info_right'][] = $val;
            }
            $i++;
        }
        return $data;
    }

    /*
     * 得到热门主题数据
     */
    public function getThemeData($limit)
    {
        $date = date('Y-m-d');
        $data = Article::where('type', 6)->where('status', 1)->where('publish_date', '<=', $date)->orderBy('sort', 'desc')->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->take($limit)->get()->toArray();
        return $data;
    }

    /*
     * 得到投资问答数据
     */
    public function getFaqData($limit)
    {
        $data = Faqs::where('status', 1)->orderBy('sort', 'desc')->orderBy('id', 'desc')->take($limit)->get()->toArray();
        return $data;
    }

    /*
     * 得到城市列表中，某个id下的所有子类，例如选亚洲得到所有的国家和所有的城市
     */
    function get_all_child($array, $id)
    {
        $arr = array();
        foreach ($array as $v) {
            if ($v['pid'] == $id) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, $this->get_all_child($array, $v['id']));
            };
        };
        return $arr;
    }
    /*
     * 通过城市id得到该城市下所有的子城市
     */
    public function getSonCityByCity($city)
    {
        $cityList = City::orderBy('sort','desc')->orderBy('id','desc')->get();
        return $this->get_all_child($cityList,$city);
    }

    /*
     * 获取热门展会数据
     */
    public function getActive($limit)
    {
        $date = date('Y-m-d');
        $data = Active::where('status',1)->where('show_start_date','<=',$date)->where('show_end_date','>=',$date)->orderBy('sort','desc')->orderBy('show_end_date','asc')->orderBy('id','desc')->take($limit)->get()->toArray();
        return $data;
    }

    /*
     * 外部链接直接返回图片地址
     */
    public function crop_img($img, $width = 200, $height = 200) {

        $source_img = $img;
        $img_info = parse_url($img);

        /* 外部链接直接返回图片地址 */

        if (!empty($img_info['host']) && $img_info['host'] != $_SERVER['HTTP_HOST']) {

            //$img

        } else {

            $pos = strrpos($img, '.');

            $img = substr($img, 0, $pos) . '_' . $width . '_' . $height . substr($img, $pos);

        }

        //图片不存在，裁剪生成新的图片
        if (!file_exists($img)) {
            $this->imageCropper($source_img, $width, $height,$img);
        }

        return $img;

    }


    /**
     * imageCropper
     * @param string $source_path
     * @param string $target_width
     * @param string $target_height
     * 裁切,如果要求的宽高比 大于原图宽高比,那么就保持最大显示宽度,居中裁切上下多余部分,如果要求宽高比小于原图宽高比,那么就保持最大高度,居中裁切左右多余部分,总而言之,在保持不变形的前提下 ,把图片缩小,而且最大保留图片的内容
     */
    public function imageCropper($source_path, $target_width, $target_height,$target_filename)
    {
        $source_info = getimagesize($source_path);
        $source_width = $source_info[0];
        $source_height = $source_info[1];
        $source_mime = $source_info['mime'];
        $source_ratio = $source_height / $source_width;//原图比例
        $target_ratio = $target_height / $target_width;//目标图比例
        if ($source_ratio > $target_ratio) {//原图比例大于目标图比例，全高度
            // image-to-height
            $cropped_width = $source_width;
            $cropped_height = $source_width * $target_ratio;
            $source_x = 0;
            $source_y = ($source_height - $cropped_height) / 2;
        } elseif ($source_ratio < $target_ratio) {//原图比例小于目标图比例，全宽度
            //image-to-widht
            $cropped_width = $source_height / $target_ratio;
            $cropped_height = $source_height;
            $source_x = ($source_width - $cropped_width) / 2;
            $source_y = 0;
        } else {//原图比例等于目标图比例
            //image-size-ok
            $cropped_width = $source_width;
            $cropped_height = $source_height;
            $source_x = 0;
            $source_y = 0;
        }
        switch ($source_mime) {
            case 'image/gif':
                $source_image = imagecreatefromgif($source_path);
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source_path);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($source_path);
                break;
            default:
                return;
                break;
        }
        $target_image = imagecreatetruecolor($target_width, $target_height);
        $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);
        // copy
        imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
        // zoom
        imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);
//        header('Content-Type: image/jpeg');
        imagejpeg($target_image,$target_filename,100);
        imagedestroy($source_image);
        imagedestroy($target_image);
        imagedestroy($cropped_image);
    }

}
