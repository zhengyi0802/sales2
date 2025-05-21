<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:exports';

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         $arr = array(
                    '社區'         => "test1",
                    '姓名'         => "Test Wu",
                    '電話'         => "0123456789",
                    '地址'         => "Taipei",
                    '支付方式'     => '銀行轉帳',
                    '方案選擇'     => "測試用門鎖方案",
                    '備註說明'     => "申請單編號 : test0123456789",
                    '建立日期'     => now()->format('Y/m/d H:i:s'),
                    '進件單位'     => "禾昌國際事業股份有限公司",
        );

        $curl = curl_init();
        var_dump(json_encode($arr));

        curl_setopt_array($curl, array(
             CURLOPT_URL => config('gas.checkout_url'),
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_ENCODING => "",
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS => json_encode($arr),
             CURLOPT_HTTPHEADER => array(
                 'Content-Type: application/json',
                 'Content-Length:'. strlen(json_encode($arr))
            ),
       ));

       $response = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);

       return 0;
    }
}
