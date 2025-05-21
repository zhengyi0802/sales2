<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HpPromotion;
use App\Models\HpProduct;
use App\Models\Process;

class Checkout2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gas:imports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '匯入所有已轉單資料';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $epromotions = HpPromotion::select('id', 'proj_id')
                          ->where('flow', 10)
                          ->where('flow1', '<', 14)
                          ->get();

        foreach($epromotions as $epromotion) {
          if (config('gas.use_get')) {
              //$string = '?action=queryData&name='.$eapply->name.'&phone='.$eapply->phone;
              $amount = $epromotion->amount;
              $amount_id = 1;
              if ($epromotion->proj_id == 1) {
                  $string = '?orderid='.'91'.sprintf('%06d', $epromotion->id);
              } else if ($epromotion->proj_id == 2) {
                  $string = '?orderid='.'92'.sprintf('%06d', $epromotion->id);
              } else {
                  $string = '?orderid='.$epromotion->id;
              }
              echo "GET 參數 ".$string."\r\n";
          } else {
              $data = [ "orderid" => $epromotion->id ];
              $jdata = json_encode($data);
              $contentLength = strlen($jdata);
          }
          $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => (config('gas.use_get')) ? config('gas.export_project_url').$string : config('gas.checkout_project_url'),
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_ENCODING => "",
               CURLOPT_TIMEOUT => 30000,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => config('gas.use_get') ? "GET" : "POST",
               CURLOPT_POSTFIELDS => config('gas.use_get') ? null :$jdata,
               CURLOPT_HTTPHEADER => array(
                   'Content-Type: application/json',
                   //'Content-Length: '.(env('USE_GET') ? 0 : $contentLength)
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);

          $proms = json_decode($response, true);
          if(!isset($proms['回傳結果'])) {
              foreach($proms as $prom) {
                  $id = $prom['訂單編號'];
                  $str = substr($id, 0, 2);
                  $id = sprintf('%d', substr($id, 2));
                  $case_name = '';
                  if ($str == '91') {
                      $case_name = '驚天一夏專案';
                  } else if ($str == '92') {
                      $case_name = '感恩母親回饋季專案';
                  }
                  $flow = 10;
                  if ($prom['處理狀態'] == '已收單') {
                      $flow = 11;
                  } else if ($prom['處理狀態'] == '已取消') {
                      $flow = 7;
                  } else if ($prom['處理狀態'] == '待安排') {
                      $flow = 12;
                  } else if ($prom['處理狀態'] == '已交付') {
                      $flow = 13;
                  } else if ($prom['處理狀態'] == '已完成') {
                      $flow = 14;
                  }
                  $data = [
                      'case_name'           => $case_name,
                      'prom_id'             => $id,
                      'create_date'         => $prom['訂購日期'],
                      'name'                => $prom['姓名'],
                      'phone'               => $prom['電話'],
                      'address'             => $prom['地址'],
                      'reseller'            => $prom['進件單位'],
                      'memo'                => $prom['備註'],
                      'project'             => $prom['商品名稱'],
                      'flow'                => $flow,
                      'shipping_date'       => $prom['預計出貨日期'],
                      'finish_date'         => $prom['安裝完成日期'],
                  ];
                  $promotion->flow1 = $flow;
                  if ($flow == 14) {
                      $promotion->flow = 14;
                  }
                  $promotion->save();
                  $process = Process::where('prom_id',$id)->first();
                  if ($process == null) {
                      $process = Process::create($data);
                  } else {
                      $process->update($data);
                  }
              }
          } else {
            var_dump($proms);
          }

        } // endforeach
    } // end of function
}
