<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\EcpayApiLog;
use App\Models\EcpayInvoiceWordSetting;
use App\Models\EcpayGovInvoiceWordSetting;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;

class EcpayAddInvoiceWordSetting extends Command
{
    private $env='test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:addInvoiceWordSetting';

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
        $this->addInvoiceWordSetting();
    }

    public function addInvoiceWordSetting()
    {
        $Invoice = new ECPayInvoice('test');

        $year = date('Y')-1911;
        $term = date('m') / 2;
        $invoice = EcpayGovInvoiceWordSetting::where('year', $year)->where('term', $term)->first();

        $postData = $Invoice->AddInvoiceWordSetting($term, $year, $invoice->header, $invoice->start, $invoice->end);

        $response=$Invoice->sendRequest($postData);

        if ($response['TransCode'] == 1) {
            $result = [
                          'name'        => 'AddInvoiceWordSetting',
                          'trans_code'  => $response['TransCode'],
                          'trans_msg'   => $response['TransMsg'],
                          'rtn_code'    => $response['Data']->RtnCode,
                          'rtn_msg'     => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            $data = [
                        'year'     => $year,
                        'term'     => $term,
                        'header'   => $invoice->header,
                        'start'    => $invoice->start,
                        'end'      => $invoice->end,
                        'rtn_code' => $response['Data']->RtnCode,
                        'track_id' => ($response['Data']->RtnCode == 1) ? $response['Data']->TrackID : null,
                        'status'   => true,
                        'command'  => 'Add',
                        'log_id'   => $log->id,
            ];
            EcpayInvoiceWordSetting::create($data);
        }
        dd($response['Data']);
    }

}
