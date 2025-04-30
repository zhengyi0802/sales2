<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;

class EcpayGetAllowanceInvalid extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:getAllowanceInvalid';

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
        $this->GetAllowanceInvalid();
    }

    public function GetAllowanceInvalid()
    {
        $Invoice = new ECPayInvoice('test');

        $issue = EcpayIssueData::find(1);

        $invoice_no = $issue->invoice_no;

        if ($issue->allowance == null) {
            $allowance = null;
        } else {
            $allowance = $issue->allowance->allowance_no;
        }
        $reason = '';

        $postData = $Invoice->GetAllowanceInvalid($invoice_no, $allowance_no);

        $response=$Invoice->sendRequest($postData);
        if ($response['TransCode'] == 1) {
            $result = [
                          'name'       => 'Allowance',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
            if ($response['Data']->RtnCode == 1) {
                $data = json_decode($response['Data']);
                $data = $this->DecodeData($data);
            }
        }
        dd($response);
    }

    private function DecodeData($data)
    {
        $array = [
                     'AllowDate'      => $data['AI_Allow_Date'],
                     'AllowNo'        => $data['AI_Allow_No'],
                     'BuyerID'        => $data['AI_Buyer_Identifier'],
                     'Date'           => $data['AI_Date'],
                     'InvoiceNo'      => $data['AI_Invoice_No'],
                     'MerchantID'     => $data['AI_Mer_ID'],
                     'Reason'         => $data['Reason'],
                     'SellerID'       => $data['AI_Seller_Identifier'],
                     'UpdateDate'     => $data['AI_Update_Date'],
                     'UpdateStatus'   => $data['AI_Update_Status'],
                     'RtnCode'        => $data['RtnCode'],
                     'RtnMsg'         => $data['RtnMsg'],
        ];
        return $array;
    }
}
