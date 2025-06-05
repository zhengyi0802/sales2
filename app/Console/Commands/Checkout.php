<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EApply;
use App\Models\Process;
use App\Models\EProject;

class Checkout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:imports';

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
        $eapplies = EApply::select('id')
                          ->where('status', true)
                          ->where('flow', 10)
                          ->where('flow1', '<', 14)
                          ->get();

        foreach($eapplies as $eapply) {
          if (config('gas.use_get')) {
              //$string = '?action=queryData&name='.$eapply->name.'&phone='.$eapply->phone;
              $amount = $eapply->amount;
              $amount_id = 1;
              $string = '?orderid='.$eapply->id;
              echo "GET 參數 ".$string."\r\n";
          } else {
              $data = [ "orderid" => $eapply->id ];
              $jdata = json_encode($data);
              $contentLength = strlen($jdata);
          }
          $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => (config('gas.use_get')) ? config('gas.export_url').$string : config('gas.checkout_url'),
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

          $applies = json_decode($response, true);
          if(!isset($applies['回傳結果'])) {
              $amount_id = 1;
              foreach($applies as $apply) {
                      $data['case_name'] = '門鎖申請書';
                      $data['apply_id'] = $apply['單號'] ?? 0;
                      $data['name']  = $apply['姓名'];
                      $data['phone'] = $apply['電話'];
                      $data['address'] = $apply['地址'];
                      $data['project'] = $apply['申請方案'];
                      $data['memo'] = $apply['備註'] ?? "";
                      $data['create_date'] = $apply['進件日期'] ?? "";
                      $date['photo_date'] = $apply['相片交付日期'] ?? "";
                      $date['shipping_date'] = $apply['配送完成日期'] ?? "";
                      $date['booking_date'] = $apply['預約安裝日期'] ?? "";
                      $date['finish_date'] = $apply['安裝完成日期'] ?? "";
                      if ($apply['處理狀態'] == '已收單') {
                          $data['flow'] = 11;
                      } else if ($apply['處理狀態'] == '已取消') {
                          $data['flow'] = 15;
                      } else if ($apply['處理狀態'] == '待安排') {
                          $data['flow'] = 12;
                      } else if ($apply['處理狀態'] == '已交付') {
                          $data['flow'] = 13;
                      } else if ($apply['處理狀態'] == '已完成') {
                          $data['flow'] = 14;
                      } else {
                          $data['flow'] = 10;
                      }

                      if (true) {
                          $pprocess = Process::where('apply_id', $eapply->id)
                                             ->where('amount_id', $amount_id)
                                             ->first();
                          if ($pprocess == null) {
                              $data['amount_id'] = $amount_id;
                              $process = Process::create($data);
                          } else {
                              if( $pprocess->flow != $data['flow'] ) {
                                  $pprocess->update($data);
                                  $process = $pprocess;
                              }
                          }
                          $amount_id++;
                      } else {
                          $data['amount_id'] = $amount_id;
                          $process = Process::create($data);
                          $amount_id++;
                      }
                      if ($data['flow'] != 7) {
                          $eapply->flow1 = $data['flow'];
                      }
                      if ($data['flow'] == 14) {
                          $eapply->flow = 14;
                      }
                      $eapply->save();
                      echo "apply_id :".$eapply->id." has changed. name=".$data['name']."&phone=".$data['phone']."&address=",$data['address'];
                      echo "\r\n";
              }
              //var_dump($applies);
          } else {
              $eapply->flow = 9;
              $eapply->save();
          }
        } // endforeach
    } // end of function
}
