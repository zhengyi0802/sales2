<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EApply;
use App\Models\EcpayApiLog;
use App\Models\EcpayIssueData;

class EcpayIssue extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:issue';

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
        $this->Issue();
    }

    public function Issue()
    {
        $Invoice = new ECPayInvoice('test');

        $apply = EApply::find(599);
        $array_data = $Invoice->buildIssueData($apply);
        $postData = $Invoice->Issue($array_data);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name' => 'Issue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'apply_id'       => $apply->id,
                          'issue_data'     => json_encode($array_data),
                          'invoice_no'     => $response['Data']->InvoiceNo,
                          'invoice_date'   => $response['Data']->InvoiceDate,
                          'random_number'  => $response['Data']->RandomNumber,
                          'rtn_code'       => $response['Data']->RtnCode,
                          'rtn_msg'        => $response['Data']->RtnMsg,
                          'log_id'         => $log->id,
                        ];
                EcpayIssueData::create($data);
            }
        }
        dd($response);
    }
}
