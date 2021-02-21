<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CompanyConfig extends Model
{

    protected $table = 'company_config';//指定表名

    //public $timestamps  = false;//设置不需要updated_at与created_at这两个字段

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name','synopsis', 'custom_service_phone','access_key','img','app_version','download_url','version_des','qr_receiver',
        'bonus_customer','plate_revenue','po_base_cash','po_base_min','po_base_max','sign_text','po_base_transfei_customer','po_base_untransfei_customer'
        ,'spread_first_po_base','spread_second_po_base','distributor_po_base_per','agency_po_base_per','store_amount','store_num','user_num'
    ];//设置哪些属性可以批量赋值
}
