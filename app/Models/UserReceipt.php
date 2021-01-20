<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserReceipt extends Model
{
    protected $table = 'user_receipt';

    public $timestamps  = false;

    protected $fillable = [
        'user_id','name', 'province', 'city','phone','address','is_default','access_key','access_token','area'
    ];
}
