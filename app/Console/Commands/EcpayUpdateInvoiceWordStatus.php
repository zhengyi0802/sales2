<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;

class EcpayUpdateInvoiceWordStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:updateInvoiceWordStatus';

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
        $this->UpdateInvoiceWordStatus();
    }

    public function UpdateInvoiceWordStatus()
    {
        $Invoice = new ECPayInvoice('test');

        $track_id = '1123456';
        $postData = $Invoice->UpdateInvoiceWordStatus($track_id, 1);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'       => 'UpdateInvoiceWordStatus',
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
