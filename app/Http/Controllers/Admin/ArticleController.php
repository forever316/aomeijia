<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\OverseaHouse;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Message\Article as wxArticle;

/*
 * $typeArr = ['1'=>'公司简介','2'=>'加入我们',3=>'联系我们',4=>'集团动态',5=>'项目动态',6=>'投资主题',,7,考察团内容，8往期考察团回顾，9往期活动回顾'];
*/
class ArticleController extends Controller
{
    private $form = [];

    public function __construct(){
        $action = $this->getCurrentAction();
        $formUrl = 'models.article.'.$action['method'];
        $this->form = Config::get($formUrl);
    }
    public function articleList(Request $request){
        $type = isset($_GET['type']) && $_GET['type'] ? $_GET['type'] : 0;
        if($request->ajax()){
            //获取要搜索的字段
            $params = ['id'=>'string','title'=>'string','status'=>'string','type'=>'string'];
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
            }
            return response()->json($arr);
        }else{
            return view('admin/common/list',['title'=>WEBNAME.' - 图文列表','form'=>$this->form]);
        }
    }

    public function addArticle(Request $request){
        $user = Session::get('user');
        $type = isset($_GET['type']) && $_GET['type'] ? $_GET['type'] : 0;
        if($type==7){
            $this->form['field']['close_date'] = ['text'=>'截止时间','type'=>'date','value'=>'','verify'=>['required']];
        }
        if($_POST){
            //获取参数
            $params = ['type'=>'string','thumb'=>'string','title'=>'string','content'=>'string','sort'=>'int','status'=>'string','describe'=>'string','read'=>'string','publish_date'=>'string','project_id'=>'int','close_date'=>'string'];
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
        }
        if($type==5){
            $bannerTypes = OverseaHouse::select(['id','title'])->get();//->where('access_key','=',$user->access_key)
            $typeArray = [];
            foreach($bannerTypes as $item){
                $typeArray[$item->id] = $item->title;
            }
            $this->form['field']['project_id'] = ['text'=>'关联项目','type'=>'select','value'=>$typeArray,'verify'=>['required']];
        }
        return view('admin/common/add',['title'=>WEBNAME.' - 添加图文','form'=>$this->form]);
    }

    public function updateArticle(Request $request){
        $user = Session::get('user');
        $params = ['id'=>'int'];
        $paramsData = $this->getInput([],$params,$request);

        $detailData = Article::where('id','=',$paramsData['id'])->first();
        if(!$detailData){
            abort(404);
        }
        if($detailData->type==7){
            $this->form['field']['close_date'] = ['text'=>'截止时间','type'=>'date','value'=>'','verify'=>['required']];
        }

        if($_POST){
            //获取参数
            $params = ['thumb'=>'string','title'=>'string','content'=>'string','sort'=>'int','status'=>'string','describe'=>'string','read'=>'string','publish_date'=>'string','project_id'=>'int','close_date'=>'string'];
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
            $detailData->sort = $data['sort'];
            $detailData->read = $data['read'];
            $detailData->publish_date = $data['publish_date'];
            $detailData->project_id = $data['project_id'];
            $detailData->close_date = $data['close_date'];
            $return = $detailData->save();
            if ($return) {
                return $this->returnJson(true, '', 'all');
            } else {
                return $this->returnJson(false, '', 'all');
            }

        }else{
            if($detailData->type==5){
                $bannerTypes = OverseaHouse::select(['id','title'])->get();
                $typeArray = [];
                foreach($bannerTypes as $item){
                    $typeArray[$item->id] = $item->title;
                }
                $this->form['field']['project_id'] = ['text'=>'关联项目','type'=>'select','value'=>$typeArray,'verify'=>['required']];
            }
        }
        return view('admin/common/edit',['title'=>WEBNAME.' - 修改图文','form'=>$this->form,'detailData'=>$detailData]);
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
            if($data->type==5){
                $project = OverseaHouse::select('title')->where('id',$data->project_id)->first();
                $data['project_id'] = $project->title;
                $this->form['field']['project_id'] = ['text'=>'关联海外项目','type'=>'span'];
            }
            if($data->type==7){
                $this->form['field']['close_date'] = ['text'=>'截止时间','type'=>'span'];
            }
            return view('admin/common/view',['title'=>WEBNAME.' - 查看图文','form'=>$this->form,'data'=>$data]);
        }
    }
}