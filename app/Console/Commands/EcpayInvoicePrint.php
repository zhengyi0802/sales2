<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;

class EcpayInvoicePrint extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:invoicePrint';

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
        $this->InvoicePrint();
    }

    public function InvoicePrint()
    {
        $Invoice = new ECPayInvoice('test');

        $invoice_no = 'AA12345678';
        $invoice_date= '2018-10-28';
        $postData = $Invoice->InvoicePrint($invoice_no, $invoice_date);

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
                            'invoice_no'    => $invoice_no,
                            'invoice_date'  => $invoice_date,
                            'invoice_html'  => $response['Data']->InvoiceHtml,
                            'log_id'        => $log->id,
                ];
                EcpayInvoicePrint::create($data);
            }
        }
        dd($response);
    }

}
