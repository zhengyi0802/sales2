<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayIssueData;
use App\Models\EcpayApiLog;
use App\Models\EcpayAllowanceData;

class EcpayAllowanceByCollegiate extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:allowanceByCollegiate';

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
        $this->AllowanceByCollegiate();
    }

    public function AllowanceByCollegiate()
    {
        $Invoice = new ECPayInvoice('test');

        $issue = EcpayIssueData::find(1);

        $array_data = $Invoice->buildAllowanceData($issue, 'E', 500, true);
        $postData = $Invoice->AllowanceByCollegiate($array_data);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'      => 'AllowanceByCollegiate',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            $data = [
                          'issue_id'                => $issue->id,
                          'notify_method'           => $array_data['AllowanceNotify'],
                          'notify_email'            => $array_data['NotifyMail'],
                          'notify_phone'            => $array_data['NotifyPhone'],
                          'allowance_amount'        => $array_data['AllowanceAmount'],
                          'allowance_no'            => $response['Data']->IA_Allow_No,
                          'invoice_no'              => $response['Data']->IA_Invoice_No,
                          'temp_date'               => $response['Data']->IA_TempDate,
                          'temp_expire_date'        => $response['Data']->IA_TempExpireDate,
                          'remain_allowance_amount' => $response['Data']->IA_Remain_Allowance_Amt,
                          'rtn_code'                => $response['Data']->RtnCode,
                          'rtn_msg'                 => $response['Data']->RtnMsg,
                          'log_id'                  => $log->id,
                    ];
            EcpayAllowanceData::create($data);
        }
        dd($response);
    }
}
