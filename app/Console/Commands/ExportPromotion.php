<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HpPromotion;
use App\Models\HpProduct;

class ExportPromotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gas:export';

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
        $bundles[0] = [
               '商品名稱' => 'Z5000W備用電池',
               '數量'     => 1,
               '單價'     => 0,
        ];
        $bundles[1] = [
               '商品名稱' => '智能涼風扇',
               '數量'     => 1,
               '單價'     => 0,
        ];
        $bundles[2] = [
               '商品名稱' => 'DC2500 2.5KW變頻冷暖空調',
               '數量'     => 1,
               '單價'     => 0,
        ];
        $bundles[3] = [
               '商品名稱' => '超魔刀',
               '數量'     => 1,
               '單價'     => 0,
        ];

        $arr = array(
            '訂購日期' => date('Y/m/d h:i:s'),
            '姓名'     => 'test',
            '電話'     => '0912345678',
            '地址'     => '台北市內湖區新湖二路100號',
            '進件單位' => '禾昌國際事業股份有限公司',
            '備註說明' => '測試單,由業務管理系統發出',
            '商品名稱' => '驚天一夏專案方案一',
            '訂購數量' => 1,
            '訂購方案' => '驚天一夏專案方案一:門鎖Z5000W + 2.5K冷氣',
            '收款方式' => '綠界多元支付',
            '訂單編號' => '1',
            '建立人員' => null,
            '建立日期' => now(),
            '附加商品' => $bundles,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
             CURLOPT_URL => config('gas.checkout_project_url'),
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
