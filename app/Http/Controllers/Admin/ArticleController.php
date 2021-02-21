<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleType;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;


class ArticleController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.article.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function articleList(Request $request){
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
            $article = new Article();
            $articleCount = new Article();

            $query = $article->select(array_keys($this->form['field']));
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
            //查询类型
            $typeids = '';
            foreach($dataList1 as $item){
                $typeids.= $item->type.',';
            }
            $typeids = trim($typeids,',');
            $tokenArray = explode(',',$typeids);
            $ArticleType = ArticleType::select(['id','name'])->whereIn('id',$tokenArray)->get();
            foreach($ArticleType as $item){
                $this->form['field']['type']['options'][$item->id] = $item->name;
            }
            $arr['total'] = $articleCount->count();
            $dataList1 = $dataList1->toArray();

            //显示隐藏
            foreach ($dataList1['data'] as $key=>$row){
                foreach($this->form['field'] as $k=>$item){
                    if(in_array($k,['type','status'])){
                        $arr['rows'][$key][$k] = $item['options'][$row[$k]];
                    }else{
                        $arr['rows'][$key][$k] = $row[$k];
                    }
                }
                $arr['rows'][$key]['link'] = '#';
                // $arr['rows'][$key]['link'] = 'http://'.APIWEBSITE.'/api/viewArticle?id='.$row['id'];
            }
            return response()->json($arr);
        }else{
            $ArticleType = ArticleType::select(['id','name'])->get();
            foreach($ArticleType as $item){
                $this->form['field']['type']['options'][$item->id] = $item->name;
            }
            return view('admin/common/list',['title'=>WEBNAME.' - 文章列表','form'=>$this->form]);
        }
    }

    public function addArticle(Request $request){
        $user = Session::get('user');
        if($_POST){
            //获取参数
            $params = ['type'=>'string','thumb'=>'string','title'=>'string','content'=>'string','sort'=>'int','status'=>'string','describe'=>'string','read'=>'string','publish_date'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

            $Article = Article::create($data);
            if ($Article) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }
        }else{

            $ArticleType = ArticleType::select(['id','name'])->get();
            foreach($ArticleType as $item){
                $this->form['field']['type']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加文章','form'=>$this->form]);
    }


    public function updateArticle(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = Article::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }

        if($_POST){
            //获取参数
            $params = ['type'=>'string','thumb'=>'string','title'=>'string','content'=>'string','sort'=>'int','status'=>'string','describe'=>'string','read'=>'string','publish_date'=>'string'];
            $data = $this->getInput($this->form,$params,$request);
            if(isset($data['error'])){
                unset($data['error']);
                return $this->returnJson(false,$data,'input');
            }

                $detailData->title = $data['title'];
                $detailData->thumb = $data['thumb'];
                $detailData->content = $data['content'];
                $detailData->status = $data['status'];
                $detailData->describe = $data['describe'];
                $detailData->type = $data['type'];
                $detailData->sort = $data['sort'];
                $detailData->read = $data['read'];
                $detailData->publish_date = $data['publish_date'];
                $return = $detailData->save();
                if ($return) {
                    return $this->returnJson(true, '', 'all');
                } else {
                    return $this->returnJson(false, '', 'all');
                }

        }else{
            $ArticleType = ArticleType::select(['id','name'])->get();
            foreach($ArticleType as $item){
                $this->form['field']['type']['value'][$item->id] = $item->name;
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改文章','form'=>$this->form,'detailData'=>$detailData]);
    }


    public function deleteArticle(Request $request){
        $user = Session::get('user');
        if($_POST){
            $params = ['ids'=>'string'];
            $data = $this->getInput([],$params,$request);
            if(empty($data['ids'])){
                return $this->returnJson(false,'请选择要删除的数据','all');
            }
            $ids = explode(',',$data['ids']);

            $return = Article::whereIn('id',$ids)->delete();
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
            return view('admin/common/list',['title'=>WEBNAME.' - 文章类型列表','form'=>$this->form]);
        }
    }

}