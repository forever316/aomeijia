<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/1
 * Time: 11:19
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHolder extends Model{

    protected $table ='stockholder';

    protected $fillable = [
            'name','access_key','id'
    ];
}