<?php
/*
 *price 是在 9.25-15.45之间，不断的去刷新
 * Tprice 是一天刷新一次,晚上12点之前 更新这个数据(23点更新)
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;
use App\Models\Stocks;

class UpdatePrice extends Command
{

    protected $signature = 'update:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }
    //动态更新商品表的价格字段
    function handle()
    {
        $hour = date('H');
        $minutes = date('i');
        $num = 200;
        set_time_limit(0);
        $nowTime = date('Y-m-d H:i:s');
        DB::connection()->enableQueryLog(); // 开启查询日志
        $codeArray = DB::table('stocks')->where('status',0)->get(array('scode','prefix'));
        set_time_limit(0);


        //通过新浪的接口得到标牌价
        if($hour>=9 && $hour<=16){
            if(($hour==9 && $minutes<25) || ($hour==16 && $minutes>45)){
                exit;
            }
            echo 'Execution updatePrice script start time:'.$nowTime."\n";
            $codestr = '';
            foreach($codeArray as $key=>$val){
                $codestr.=$val->prefix.$val->scode.',';
            }
            $codestr = rtrim($codestr,',');
            $getInfo = file_get_contents('http://hq.sinajs.cn/list='.$codestr);
            $getInfo = explode('var',$getInfo);
            $updateData = array();
            foreach($getInfo as $key=>$val){
                $data = explode(',',$val);
                if(isset($data[3]) && $data[3]>0){
                    $scode = substr($data[0],10,strrpos(substr($data[0],10),'='));
                    Stocks::where('scode',$scode)->update(array('price' => $data[3],'updated_at'=>$nowTime));
                    // $updateData[] = array(
                    //     'scode' => $scode,
                    //     'price' => $data[3],
                    //     'updated_at'=>$nowTime
                    // );
                }
            }
            // batchInsert('stocks',$updateData);
        }

        //通过tprice宏得到最新目标价（GetTprice函数）
        if($hour==23 && $minutes==59) {
            echo 'Execution updateTprice script start time:'.$nowTime."\n";
            foreach ($codeArray as $key => $val) {
                $scode = $val->scode;
                $data = DB::connection('tprice')->select("SELECT GetTprice($scode) as tprice");
                //返回的价格>0才更新
                if (isset($data[0]) && $data[0]->tprice > 0) {
                    $tprice = $data[0]->tprice;
                    // $updateTprice[] = array('scode' => $scode, 'tprice' => $tprice, 'updated_at' => $nowTime);
                    Stocks::where('scode',$scode)->update(array('tprice' => $tprice, 'updated_at' => $nowTime));
                }
            }
            // batchInsert('stocks', $updateTprice);
        }

        $queries = DB::getQueryLog(); // 获取查询日志
        var_dump($queries); // 即可查看执行的sql，传入的参数等等
        echo 'Execution script end';
    }
}



