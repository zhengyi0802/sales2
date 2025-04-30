<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;
use App\Models\EcpayIssueData;

class EcpayInvalid extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:invalid';

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
        $this->Invalid();
    }

    public function Invalid()
    {
        $Invoice = new ECPayInvoice('test');

        $issue = EcpayIssueData::find(1);
        $reason = "test for invalid";
        $postData = $Invoice->Invalid($issue->invoice_no, $issue->invoice_date, $reason);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'       => 'Invalid',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            $issue->invalid_date = now();
            $issue->invalid_reason = $reason;
            $issue->rtn_code = $response['Data']->RtnCode;
            $issue->rtn_msg  = $response['Data']->RtnMsg;
            $issue->save();
        }
        dd($response);
    }
}
