<?php

namespace App\Models\Authority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Resources extends Model
{

    protected $table = 'resources';//指定表名

    public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modular_id','resources_key','resources_title'
    ];//设置哪些属性可以批量赋值


    public function getResources(){
        $resources = [];
        $user = Session::get('user');
        $access_key = $user->access_key;
        if(!Session::has('resources')){
            $modularList = Modular::orderBy('sort','asc')->get();

            $ids = [];
            foreach($modularList as $item){
                $ids[] = $item->id;
            }
            $menuList = Menu::whereIn('modular_id',array_values($ids))->orderBy('sort','asc')->get();
            $resourcesList = Resources::whereIn('modular_id',array_values($ids))->get();

            foreach($modularList as $item){
                $resources[$item->modular_key] = [
                    'ico' => $item->modular_ico,
                    'title' => $item->modular_title,
                    'menu' => [],
                    'resources' => []
                ];
                foreach($menuList as $menu){
                    if($item->id == $menu->modular_id) {
                        $resources[$item->modular_key]['menu'][$menu->menu_key] = [
                            'title' => $menu->menu_title,
                            'url' => $menu->menu_url,
                        ];
                    }
                }
                foreach($resourcesList as $r){
                    if($item->id == $r->modular_id){
                        $resources[$item->modular_key]['resources'][$r->resources_key] = $r->resources_title;
                    }
                }
            }
            Session::put('resources',$resources);
        }else{
            $resources = Session::get('resources');
        }
//        echo "<pre>";print_r($resources);die;
        return $resources;
    }
}
