<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EcpayAllowanceInvalid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        return 0;
    }

    public function AllowanceInvalid()
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

        $postData = $Invoice->AllowanceInvalid($invoice_no, $allowance_no, $reason);

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
                $allowance = EcpayAllowanceData::where('allowance_no', $response['Data']->IA_Invoice_No)->first();
                if ($allowance != null) {
                    $allowance->status = false;
                    $allowance->save();
                }
            }
        }
        dd($response);
    }
}
