<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;
use App\Models\EcpayInvoiceWordSetting;

class EcpayGetInvoiceWordSetting extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:getInvoiceWordSetting';

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
        $this->GetInvoiceWordSetting();
    }

    public function GetInvoiceWordSetting()
    {
        $Invoice = new ECPayInvoice('test');

        $term = 3;
        $year = date('Y')-1911;
        $status = 0;
        $postData = $Invoice->GetInvoiceWordSetting($term, $year,  $status);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'       => 'GetInvoiceWordSetting',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            $infos = $response['Data']->InvoiceInfo;
            if ($response['Data']->RtnCode == 1) {
                foreach($infos as $info) {
                    $data = [
                        'year'         => $year,
                        'term'         => $term,
                        'header'       => $info->InvoiceHeader,
                        'start'        => $info->InvoiceStart,
                        'end'          => $info->InvoiceEnd,
                        'rtn_code'     => $response['Data']->RtnCode,
                        'track_id'     =>  $info->TrackID,
                        'status'       => $info->UseStatus,
                        'invoice_no'   => $info->InvoiceNo,
                        'command'      => 'Get',
                        'log_id'       => $log->id,
                    ];
                    EcpayInvoiceWordSetting::create($data);
                }
            }
        }
        dd($response);
    }


}
