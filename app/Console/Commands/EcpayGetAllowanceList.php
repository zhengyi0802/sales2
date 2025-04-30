<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;

class EcpayGetAllowanceList extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:getAllowanceList';

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
        $this->getAllowanceList();
    }

    public function getAllowanceList()
    {
        $apiUrl = ($this->env == 'test') ? config('ecpay.test_InvoiceURL') : config('ecpay.InvoiceURL');
        $apiUrl = $apiUrl.config('ecpay.GetAllowanceList');
        $MerchantID = ($this->env == 'test') ? config('ecpay.test_MerchantId') : config('ecpay.MerchantId');
        $HashKey = ($this->env == 'test') ? config('ecpay.test_HashKey') : config('ecpay.HashKey');
        $HashIV = ($this->env == 'test') ? config('ecpay.test_HashIV') : config('ecpay.HashIV');
        $ecpayCrypt = new ECPayCrypt($HashKey, $HashIV);

        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [ "MerchantID"  => $MerchantID,
                  "SearchType"  => "2",
                  "AllowanceNo" => "2019091719477262",
                ];
        $data = json_encode($data);
        $data = $ecpayCrypt->encryptAES($data);

        $postData = [
            'MerchantID'    => $MerchantID,
            'RqHeader'      => $rqHeader,
            'Data'          => $data,
        ];
        $response = Http::asJson()->post($apiUrl, $postData);
        $data2 = $response->json();
        $str = $ecpayCrypt->decryptAES($data2['Data']);
        $data2['Data']=(json_decode($str));
        dd($data2);

    }
}
