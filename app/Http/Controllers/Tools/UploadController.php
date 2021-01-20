<?php
/**
 * Created by PhpStorm.
 * User: ljf
 * Date: 2016/6/1
 * Time: 14:46
 */
namespace App\Http\Controllers\Tools;
use Illuminate\Http\Request;
use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller {

    /**
     * 图片上传
     *
     * @return Response
     */
    public function uploadImg(Request $request)
    {
        $file = Input::file('file');
        $id = Input::get('id');
        $folder = Input::get('folder','images');
        if($file->getSize()>2097152){
            return response()->json( [
                'success' => false,
                'error' => '文件不超过2M'
            ]);
        }
        $allowed_extensions = ["png", "jpg", "gif",'jpeg','bmp'];
        if ($file->getClientOriginalExtension() && !in_array(strtolower($file->getClientOriginalExtension()), $allowed_extensions)) {
            return response()->json( [
                'success' => false,
                'error' => '文件格式错误'
            ]);
        }

        $destinationPath = 'uploads/'.$folder.'/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        return response()->json( [
            'success' => true,
            'pic' => $destinationPath.$fileName,//asset 方法可以加上网站域名
            'id' => $id
        ]);
    }

    //删除文件
    public function deleteFile(){
        $imgUrl = Input::get('fileUrl');
        $oneStr = substr($imgUrl,0,1);
        if($oneStr == '/'){
            $imgUrl = substr($imgUrl,1);
        }
        if(file_exists($imgUrl)){
            if (unlink($imgUrl)){
                return response()->json( [
                    'success' => true,
                ]);
            }else{
                return response()->json( [
                    'success' => false,
                ]);
            }
        }else{
            return response()->json( [
                'success' => true,
            ]);
        }
    }
}