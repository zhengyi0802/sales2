<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayGovInvoiceWordSetting;
use App\Models\EcpayApiLog;

class EcpayGetGovInvoiceWordSetting extends Command
{
    private $env="test";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:getGovInvoiceWordSetting';

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
        return $this->GetGovInvoiceWordSetting();
    }

    public function GetGovInvoiceWordSetting()
    {
        $Invoice = new ECPayInvoice('test');

        $postData = $Invoice->GetGovInvoiceWordSetting();

        $response=$Invoice->sendRequest($postData);
        $logData = [
                       'name'       => 'GetGovInvoiceWordSetting',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode,
                       'rtn_msg'    => $response['Data']->RtnMsg,
                   ];
        EcpayApiLog::create($logData);

        if ($response['TransCode'] == '1') {
            $data = $response['Data'];
            if ($data->RtnCode == 1) {
                $results = $data->InvoiceInfo;
                foreach($results as $result) {
                    $data = [
                                'year'   => date('Y')-1911,
                                'term'   => $result->InvoiceTerm,
                                'type'   => $result->InvType,
                                'header' => $result->InvoiceHeader,
                                'start'  => $result->InvoiceStart,
                                'end'    => $result->InvoiceEnd,
                                'number' => $result->Number,
                            ];
                    EcpayGovInvoiceWordSetting::create($data);
                }
            }
        }
        //var_dunp($response);
    }

}
