<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiModular;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class ApiController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.api_modular.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function apiList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $article = new ApiModular();
            $articleCount = new ApiModular();
            $query = $article->select(array_keys($this->form['field']));
            $user = Session::get('user');
            $query = $query->where('access_key','=',$user->access_key);
            $articleCount = $articleCount->where('access_key','=',$user->access_key);
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'name'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $articleCount = $articleCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $articleCount = $articleCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);

            $arr['total'] = $articleCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['type','status','wx_token'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 文章列表','form'=>$this->form]);
        }
    }

    public function addApi(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['name'=>'string','thumb'=>'string','status'=>'string','sort'=>'int','status'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $data['access_key'] = $user->access_key;
            $Article = ApiModular::create($data);
            if ($Article) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加api模块','form'=>$this->form]);
    }


    public function updateApi(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = ApiModular::where('id','=',$paramsData['id'])->where('access_key','=',$user->access_key)->first();
        if(!$detailData){
            abort(404);
        }
        if($_POST){
            //获取参数
            $params = ['name'=>'string','thumb'=>'string','status'=>'string','sort'=>'int','status'=>'int'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

                $detailData->name = $data['name'];
                $detailData->thumb = $data['thumb'];
                $detailData->status = $data['status'];
                $detailData->sort = $data['sort'];
                $return = $detailData->save();
                if ($return) {
                    return $this->returnJson(true, '', 'all');
                } else {
                    return $this->returnJson(false, '', 'all');
                }

        }else{
            $this->form['field']['thumb']['value'] = $detailData->thumb;
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改文章','form'=>$this->form,'detailData'=>$detailData]);
    }


    public function deleteApi(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = ApiModular::where('access_key','=',$user->access_key)->whereIn('id',$ids)->delete();
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }


    public function seeArticle(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);
        $data = Article::find($paramsData['id']);
        if(!$data){
            abort(404);
        }else{
            $ArticleType = ArticleType::select(['id','name'])->where('id','=',$data->type)->first();
            //获取微信链接
            $data->type = $ArticleType->name;
            return view('admin/common/view',['title'=>WEBNAME.' - 查看文章','form'=>$this->form,'data'=>$data]);
        }
    }


    public function articleTypeList(Request $request){
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','name'=>'string'];
            $search_params = $this->getInput([],$params,$request);

            //获取要排序的字段 默认按创建时间倒序
            $sort = Input::get('sort','created_at');
            $order = Input::get('order','desc');

            //要返回的数组
            $arr = ['total'=>0,'rows'=>[]];

            //数据获取与处理
            $article = new ArticleType();
            $articleCount = new ArticleType();

            $query = $article->select(array_keys($this->form['field']));
            $user = Session::get('user');
            $query = $query->where('access_key','=',$user->access_key);
            foreach($search_params as $k=>$v){
                if(!empty($v)){
                    if($k == 'title'){
                        $query = $query->where($k,'like','%'.$v.'%');
                        $articleCount = $articleCount->where($k,'like','%'.$v.'%');
                    }else{
                        $query = $query->where($k,'=',$v);
                        $articleCount = $articleCount->where($k,'=',$v);
                    }
                }
            }
            $dataList1 = $query->orderBy($sort,$order)->paginate(10);
            $arr['total'] = $articleCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['type','status','wx_token'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 文章类型列表','form'=>$this->form]);
        }
    }

    public function addArticleType(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['name'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }
            $data['access_key'] = $user->access_key;
            $Article = ArticleType::create($data);
            if ($Article) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加文章','form'=>$this->form]);
    }


    public function updateArticleType(Request $request){
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = ArticleType::find($paramsData['id']);
        if(!$detailData){
            abort(404);
        }
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['name'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            $detailData->name = $data['name'];
            $return = $detailData->save();
            if ($return) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }

        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改文章','form'=>$this->form,'detailData'=>$detailData]);
    }


    public function deleteArticleType(Request $request){
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = ArticleType::destroy($ids);
            if($return){
                return $this->returnJson(true,'','all');
            }else{
                return $this->returnJson(false,'','all');
            }
        }
    }


}