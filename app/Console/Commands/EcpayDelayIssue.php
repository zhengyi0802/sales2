<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;
use App\Models\EcpayIssue;
use App\Models\EApply;

class EcpayDelayIssue extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:delayIssue';

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
        $this->DelayIssue();
    }

    public function DelayIssue()
    {
        $Invoice = new ECPayInvoice('test');

        $apply = EApply::find(599);
        $tsr = substr($apply->trade_no, 2);
        $array_data = $Invoice->buildIssueData($apply);
        $array_data = $Invoice->addDelayIssueData($array_data, $tsr, '1', '5');
        $postData = $Invoice->DelayIssue($array_data);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'       => 'DelayIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
        }
        dd($response);
    }
}
