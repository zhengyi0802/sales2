<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;
use App\Models\EcpayLoveCode;

class EcpayCheckLoveCode extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:checkLoveCode';

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
        $this->CheckLoveCode();
    }

    public function CheckLoveCode()
    {
        $Invoice = new ECPayInvoice('test');

        $lovecode = "1680000";
        $postData = $Invoice->CheckLoveCode($lovecode);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name' => 'CheckLoveCode',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'love_code'      => $lovecode,
                          'organ_name'     => $response['Data']->OrganName,
                          'is_exist'       => $response['Data']->IsExist,
                          'log_id'         => $log->id,
                        ];
                EcpayLoveCode::create($data);
            }
        }
        dd($response);
    }
}
