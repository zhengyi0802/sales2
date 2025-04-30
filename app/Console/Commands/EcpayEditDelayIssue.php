<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;

class EcpayEditDelayIssue extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:editDelayIssue';

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
        $this->EditDelayIssue();
    }

    public function EditDelayIssue()
    {
        $apiUrl = ($this->env == 'test') ? config('ecpay.test_InvoiceURL') : config('ecpay.InvoiceURL');
        $apiUrl = $apiUrl.config('ecpay.EditDelayIssue');
        $MerchantID = ($this->env == 'test') ? config('ecpay.test_MerchantId') : config('ecpay.MerchantId');
        $HashKey = ($this->env == 'test') ? config('ecpay.test_HashKey') : config('ecpay.HashKey');
        $HashIV = ($this->env == 'test') ? config('ecpay.test_HashIV') : config('ecpay.HashIV');
        $ecpayCrypt = new ECPayCrypt($HashKey, $HashIV);

        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = Storage::disk('public')->get('ecpayeditdelayissue.json');
        //$data = json_encode(["MerchantID" => $MerchantID, "Barcode" => '/1234567' ]);
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
