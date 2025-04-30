<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;
use App\Models\EcpayCompanyInfo;

class EcpayGetCompanyNameByTaxID extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:getCompanyNameByTaxID';

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
        $this->GetCompanyNameByTaxID();
    }
    public function GetCompanyNameByTaxID()
    {
        $Invoice = new ECPayInvoice('test');

        $unified_number = '91047074';
        $postData = $Invoice->GetCompanyNameByTaxID($unified_number);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name' => 'GetCompanyNameByTaxID',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'unified_number' => $unified_number,
                          'company_name'   => $response['Data']->CompanyName,
                          'log_id'         => $log->id,
                        ];
                EcpayCompanyInfo::create($data);
            }
        }
        dd($response);
    }

}
