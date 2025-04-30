<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\ECPay\ECPayInvoice;
use App\Models\EcpayApiLog;

class EcpayCheckBarcode extends Command
{
    private $env = 'test';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecpay:checkBarcode';

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
        $this->CheckBarcode();
    }

    public function CheckBarcode()
    {
        $Invoice = new ECPayInvoice('test');

        $barcode = "/12345678";
        $postData = $Invoice->CheckBarcode($barcode);

        $response=$Invoice->sendRequest($postData);
        dd($response);
    }
}
