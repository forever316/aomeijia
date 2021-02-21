<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerType;
use App\Models\Banner;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    private $form = [];
    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.banner.'.$action['method'];
        $this->form = Config::get($formUrl);
    }

    /**
     **banner类型列表
     **wlf
     */
    public function bannerTypeList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $bannerType = new BannerType();
            $bannerTypeCount = new BannerType();
            $query = $bannerType->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'title'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $bannerTypeCount = $bannerTypeCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $bannerTypeCount = $bannerTypeCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $bannerTypeCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'status'){
                        $arr['rows'][$key][$k] = $row[$k]== 1?'显示':'隐藏';
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - Banner类型列表','form'=>$this->form]);
        }
    }

    /**
     ** 查看详情
     ** wlf
     * @param Request $request
     */
    public function seeType(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = BannerType::where('id','=',$paramsData['id'])->first();
        if(!$data){
            abort(404);
        }
        return view('admin/common/view',['title'=>WEBNAME.' - 查看Banner','form'=>$this->form,'data'=>$data->toArray()]);
    }
    /**
     **修改Banner类型
     **wlf
     */
    public function updateType(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = BannerType::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['status'=>'string','desc'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->desc = $data['desc'];
            $detailData->status = $data['status'];
            $bannerType = $detailData->save();
            if($bannerType){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改Banner类型','form'=>$this->form,'detailData'=>$detailData]);
    }
    /**
     **banner列表页面
     **wlf
     */
    public function bannerList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $banner = new Banner();
            $bannerCount = new Banner();
            $query = $banner->select(array_keys($this->form['field']));
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'title'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $bannerCount = $bannerCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $bannerCount = $bannerCount->where($k,'=',$v);
                    }
                }
            }
            $bannerCount = $bannerCount;
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $bannerCount->count();
            $dataList1 = $dataList1->toArray();

            //查询类型
            $typeIDstr = '';
            foreach($dataList1['data'] as $item){
                $typeIDstr.= $item['type'].',';
            }
            $typeIDstr = trim($typeIDstr,',');
            $typeArray = explode(',',$typeIDstr);
            $bannerTypes = BannerType::select(['id','title'])->whereIn('id',$typeArray)->get();
            $typeArray = [];
            foreach($bannerTypes as $item){
                $typeArray[$item->id] = $item->title;
            }

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if($k == 'type'){
                        $arr['rows'][$key][$k] = $typeArray[$row[$k]];
                    }elseif($k == 'status'){
                        $arr['rows'][$key][$k] = $row[$k]==1?'显示':'隐藏';
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }

                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - Banner列表','form'=>$this->form]);
        }
    }

    //ajax获取banner列表数据
    public function ajaxBannerList(Request $request){

        //获取要显示的字段
        $formUrl = 'model.banner.bannerList';
        $this->form = Config::get($formUrl);

        //获取要搜索的字段
        $params = ['id'=>'string','title'=>'string','status'=>'string'];
        $search_params = $this->getInput([],$params,$request);

        //获取要排序的字段 默认按创建时间倒序
        $sort = Input::get('sort','created_at');
        $order = Input::get('order','desc');

        //要返回的数组
        $arr = ['total'=>0,'rows'=>[]];

        //数据获取与处理
        $banner = new Banner();
        $bannerCount = new Banner();
        $query = $banner->select(array_keys($this->form['field']));
        foreach($search_params as $k=>$v){
            if(!empty($v)){
                if($k == 'title'){
                    $query = $query->where($k,'like','%'.$v.'%');
                    $bannerCount = $bannerCount->where($k,'like','%'.$v.'%');
                }else{
                    $query = $query->where($k,'=',$v);
                    $bannerCount = $bannerCount->where($k,'=',$v);
                }
            }
        }
        $dataList1 = $query->orderBy($sort,$order)->paginate(2);
        $arr['total'] = $bannerCount->count();
        $dataList1 = $dataList1->toArray();

        //查询类型
        $typeIDstr = '';
        foreach($dataList1['data'] as $item){
            $typeIDstr.= $item['type'].',';
        }
        $typeIDstr = trim($typeIDstr,',');
        $typeArray = explode(',',$typeIDstr);
        $bannerTypes = BannerType::select(['id','title'])->whereIn('id',$typeArray)->get();
        $typeArray = [];
        foreach($bannerTypes as $item){
            $typeArray[$item->id] = $item->title;
        }

        //显示隐藏

        foreach ($dataList1['data'] as $key=>$row){
            foreach($this->form['field'] as $k=>$item){
                if($k == 'type'){
                    $arr['rows'][$key][$k] = $typeArray[$row[$k]];
                }elseif($k == 'status'){
                    $arr['rows'][$key][$k] = $row[$k]==1?'显示':'隐藏';
                }else{
                    $arr['rows'][$key][$k] = $row[$k];
                }

            }
        }

        return response()->json($arr);
    }

    /**
     ** 查看详情
     ** wlf
     * @param Request $request
     */
    public function seeBanner(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Banner::where('id','=',$paramsData['id'])->first();
        if(!$data){
            abort(404);
        }
        return view('admin/common/view',['title'=>WEBNAME.' - 查看Banner','form'=>$this->form,'data'=>$data->toArray()]);
    }

    /**
     ** 添加Banner
     ** wlf
     */
    public function addBanner(Request $request){
        if($_POST){
            //获取参数
            $params = ['title'=>'string','type'=>'int','status'=>'string','img_url'=>'string','link'=>'string','sort'=>'string','describe'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $bannerType = Banner::create($data);
            if($bannerType){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            //类型
            $user = Session::get('user');
            $bannerTypes = BannerType::select(['id','title'])->where('status',1)->get();//->where('access_key','=',$user->access_key)
            $typeArray = [];
            foreach($bannerTypes as $item){
                $typeArray[$item->id] = $item->title;
            }
            $this->form['field']['type']['value'] = $typeArray;
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加Banner类型','form'=>$this->form]);
    }

    /**
     ** 修改Banner
     ** wlf
     */
    public function updateBanner(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $detailData = Banner::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['title'=>'string','type'=>'string','status'=>'string','img_url'=>'string','link'=>'string','sort'=>'string','describe'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $detailData->title = $data['title'];
            $detailData->type = $data['type'];
            $detailData->status = $data['status'];
            $detailData->img_url = $data['img_url'];
            $detailData->link = $data['link'];
            $detailData->sort = $data['sort'];
            $detailData->describe = $data['describe'];
            $banner = $detailData->save();
            if($banner){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }else{
            $user = Session::get('user');
            $bannerTypes = BannerType::select(['id','title'])->where('status',1)->get();//->where('access_key','=',$user->access_key)
            $typeArray = [];
            foreach($bannerTypes as $item){
                $typeArray[$item->id] = $item->title;
            }
            $this->form['field']['type']['value'] = $typeArray;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改Banner','form'=>$this->form,'detailData'=>$detailData]);
    }

    /**
     ** 删除banner
     ** wlf
     * @param Request $request
     * @return string
     */
    public function deleteBanner(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);
            $banners = Banner::whereIn('id',$ids)->get();
            foreach($banners as $key=>$item){
                if(file_exists($item->img_url)){
                    @unlink($item->img_url);
                }
            }
            $return = Banner::whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }
}