<?php

namespace App\ECPay;

use Illuminate\Support\Facades\Http;
use App\ECPay\ECPayCrypt;
use App\Models\EApply;
use App\Models\HpPromotion;
use App\Models\HpProduct;
use App\Models\EcpayIssueData;
use App\Models\EcpayIssueInfo;
use App\Models\EcpayAllowanceData;
use App\Collections\IssueCollection;

class ECPayInvoice {

    private $infos;
    private $ecpayCrypt;
    private $postData;

    public function __construct($env = 'test')
    {
        if ($env == 'test') {
            $this->infos = [
                               'apiUrl'     => config('ecpay.test_InvoiceURL'),
                               'MerchantID' => config('ecpay.test_MerchantId'),
                               'HashKey'    => config('ecpay.test_HashKey'),
                               'HashIV'     => config('ecpay.test_HashIV'),
                           ];
        } else {
            $this->infos = [
                               'apiUrl'     => config('ecpay.InvoiceURL'),
                               'MerchantID' => config('ecpay.MerchantId'),
                               'HashKey'    => config('ecpay.HashKey'),
                               'HashIV'     => config('ecpay.HashIV'),
                           ];
        }
        $this->ecpayCrypt = new ECPayCrypt($this->infos['HashKey'], $this->infos['HashIV']);
    }

    public function GetGovInvoiceWordSetting()
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetGovInvoiceWordSetting');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = json_encode(["MerchantID" => $this->infos['MerchantID'], "InvoiceYear" => date('Y')-1911,]);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function AddInvoiceWordSetting($term, $year, $header, $start, $end)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.AddInvoiceWordSetting');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'       => $this->infos['MerchantID'],
                    'InvoiceTerm'      => $term,
                    'InvoiceYear'      => $year,
                    'InvType'          => "07",
                    'InvoiceCategory'  => "1",
                    'InvoiceHeader'    => $header,
                    'InvoiceStart'     => $start,
                    'InvoiceEnd'       => $end,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function UpdateInvoiceWordSetting($track_id, $status)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.UpdateInvoiceWordSetting');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'       => $this->infos['MerchantID'],
                    'TrackID'          => $track_id,
                    'InvoiceStatus'    => $status,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetCompanyNameByTaxID($unifiedNo)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetCompanyNameByTaxID');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'UnifiedBusinessNo' => $unifiedNo,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function CheckBarcode($barcode)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.CheckBarcode');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'BarCode'           => $barcode,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function CheckLoveCode($lovecode)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.CheckLoveCode');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'LoveCode'          => $lovecode,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetIssue($invoice_no, $invoice_date)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'InvoiceNo'         => $invoice_no,
                    'InvoiceDate'       => $invoice_date,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function InvoiceNotify($invoice_no, $phone, $email, $notify, $tag, $notified)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.InvoiceNotify');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'InvoiceNo'         => $invoice_no,
                    'Phone'             => $phone ,
                    'NotifyMail'        => $email,
                    'Notify'            => $notify,
                    'InvoiceTag'        => $tag,
                    'Notified'          => $notified,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function InvoicePrint($invoice_no, $invoice_date, $print_style = '1', $showing_detail = '1')
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.InvoicePrint');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'InvoiceNo'         => $invoice_no,
                    'InvoiceDate'       => $invoice_date,
                    'PrintStyle'        => $print_style,
                    'IsShowingDetail'   => $showing_detail,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function Issue($array_data)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.Issue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function buildIssueDataP(HpPromotion $promotion, $array,  $remark = '')
    {
        $items[0] = [
                    'ItemSeq'             => 1,
                    'ItemName'            => ($promotion->proj_id == 1) ? '驚天一夏專案' : '感恩母親回饋季',
                    'ItemCount'           => 1,
                    'ItemWord'            => '套',
                    'ItemPrice'           => $promotion->total,
                    'ItemTaxType'         => '1',
                    'ItemAmount'          => $promotion->total,
                    'ItemRemark'          => '',
                    ];
        $data = [
                    'MerchantID'          => $this->infos['MerchantID'],
                    'RelateNumber'        => substr($promotion->trade_no, 2),
                    'CustomerID'          => '',
                    'CustomerIdentifier'  => $promotion->unified_number,
                    'CustomerName'        => $promotion->name,
                    'CustomerAddr'        => $promotion->address,
                    'CustomerPhone'       => $promotion->phone,
                    'CustomerEmail'       => $promotion->email,
                    'ClearanceMark'       => 1,
                    'Print'               => 1,
                    'Donation'            => 0,
                    'LoveCode'            => '',
                    'CarrierType'         => '',
                    'CarrierNum'          => '',
                    'TaxType'             => 1,
                    'SalesAmount'         => $promotion->total,
                    'InvoiceRemark'       => $remark,
                    'InvType'             => '07',
                    'vat'                 => 1,
                    'Items'               => $items,
        ];
        return $data;
    }

    public function buildIssueDataA(EApply $apply, $array, $remark = '')
    {
        $items[0] = [
                    'ItemSeq'             => 1,
                    'ItemName'            => $apply->project->name,
                    'ItemCount'           => $apply->amount,
                    'ItemWord'            => '件',
                    'ItemPrice'           => $apply->project->price,
                    'ItemTaxType'         => '1',
                    'ItemAmount'          => $apply->project->price * $apply->amount,
                    'ItemRemark'          => '',
                    ];
        $bundles = json_decode($apply->bundles);
        if ($bundles != null && $bundles->battery > 0) {
            if ($apply->project_id < 3) {
                $bprice = 1800;
            } else if ($apply->project_id == 3) {
                $bprice= 2800;
            } else {
                $bprice = 0;
            }
            $items[1] = [
                    'ItemSeq'             => 1,
                    'ItemName'            => '電池',
                    'ItemCount'           => $apply->amount,
                    'ItemWord'            => '件',
                    'ItemPrice'           => $bprice,
                    'ItemTaxType'         => '1',
                    'ItemAmount'          => $bprice * $bundles->battery,
                    'ItemRemark'          => '',
                    ];
        }
        //dd(substr($apply->trade_no, 2));
        $data = [
                    'MerchantID'          => $this->infos['MerchantID'],
                    'RelateNumber'        => substr($apply->trade_no, 2),
                    'CustomerID'          => '',
                    'CustomerIdentifier'  => $apply->unified_number,
                    'CustomerName'        => $apply->name,
                    'CustomerAddr'        => $apply->address,
                    'CustomerPhone'       => $apply->phone,
                    'CustomerEmail'       => $apply->email,
                    'ClearanceMark'       => 1,
                    'Print'               => 1,
                    'Donation'            => 0,
                    'LoveCode'            => '',
                    'CarrierType'         => '',
                    'CarrierNum'          => '',
                    'TaxType'             => 1,
                    'SalesAmount'         => $apply->total,
                    'InvoiceRemark'       => $remark,
                    'InvType'             => '07',
                    'vat'                 => 1,
                    'Items'               => $items,
        ];
        return $data;
    }

    public function addDelayIssueData($array_data, $tsr, $DelayFlag, $DelayDay)
    {
        $array_data['Tsr'] = $tsr;
        $array_data['DelayFlag'] = $DelayFlag;
        $array_data['DelayDay'] = $DelayDay;
        $array_data['PayType'] = '2';
        $array_data['PayAct'] = 'ECPAY';
        $array_data['NotifyURL'] = config('ecpay.InvoiceNotifyURL');
        return $array_data;
    }

    public function buildIssueData($array)
    {
        $issueCollection = new IssueCollection();

        $issueCollection->MerchantID = $this->infos['MerchantID'];
        $issueCollection->RelateNumber = $array['RelateNumber'];
        $issueCollection->CustomerName = $array['CustomerName'];
        $issueCollection->CustomerAddr = $array['CustomerAddr'];
        $issueCollection->CustomerPhone = $array['CustomerPhone'];
        $issueCollection->CustomerIdentifier = $array['CustomerIdentifier'];
        $issueCollection->CustomerEmail = $array['CustomerEmail'];
        $issueCollection->SalesAmount = $array['SalesAmount'];
        $issueCollection->InvoiceRemark = $array['InvoiceRemark'];
        $issueCollection->Tsr = $array['Tsr'];
        $issueCollection->DelayFlag = $array['DelayFlag'];
        $issueCollection->DelayDay = $array['DelayDay'];
        $issueCollection->NotifyURL = $array['NotifyURL'];
        //$issueCollection->Items = $array['Items'];

        return $issueCollection;
    }

    public function DelayIssue($array_data)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.DelayIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function EditDelayIssue($array_data)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.EditDelayIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];

        $array_data['NotifyURL'] = config('ecpay.InvoiceNotifyURL');

        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function TriggerIssue($tsr)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.TriggerIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'Tsr'               => $tsr,
                    'PayType'           => '2',
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function CancelDelayIssue($tsr)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.CancelDelayIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'Tsr'               => $tsr,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function Invalid($invoice_no, $invoice_date, $reason = '')
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.Invalid');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'InvoiceNo'         => $invoice_no,
                    'InvoiceDate'       => $invoice_date,
                    'Reason'            => $reason,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function Getinvalid($relateNumber, $invoice_no, $invoice_date)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $data = [
                    'MerchantID'        => $this->infos['MerchantID'],
                    'RelateNumber'      => $relateNumber,
                    'InvoiceNo'         => $invoice_no,
                    'InvoiceDate'       => $invoice_date,
                ];
        $data = json_encode($data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function Allowance(EcpayIssueInfo $issue, $AllowanceAmount, $Notify = 'E', $NotifyMail, $Reason = null)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.Allowance');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $items = $issue->details()->Items;
        $items[0]->ItemAmount = $AllowanceAmount;
        $items[0]->ItemPrice = $AllowanceAmount / $items[0]->ItemCount;
        if (count($items) > 1) {
           for($i = 1; $i < count($items); $i++) {
               $items[$i]->ItemAmount = 0;
               $items[$i]->ItemPrice = 0;
           }
        }

        $array_data = [
                          'MerchantID'        => $this->infos['MerchantID'],
                          'InvoiceNo'         => $issue->invoice_no,
                          'InvoiceDate'       => $issue->invoice_date,
                          'AllowanceNotify'   => $Notify,
                          'CustomerName'      => $issue->details()->IIS_Customer_Name,
                          'NotifyMail'        => $NotifyMail,
                          'NotifyPhone'       => $issue->details()->IIS_Customer_Phone,
                          'AllowanceAmount'   => $AllowanceAmount,
                          'Items'             => $items,
                      ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;

        return $postData;
    }

    public function AllowanceByCollegiate(EcpayIssueInfo $issue, $amount, $email, $Notify)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.AllowanceByCollegiate');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $items = $issue->details()->Items;
        $items[0]->ItemAmount = $amount;
        $items[0]->ItemPrice = $amount/$items[0]->ItemCount;
        if (count($items) > 1) {
           for($i = 1; $i < count($items); $i++) {
               $items[$i]->ItemAmount = 0;
               $items[$i]->ItemPrice = 0;
           }
        }
        $array_data = [
                          'MerchantID'        => $this->infos['MerchantID'],
                          'InvoiceNo'         => $issue->invoice_no,
                          'InvoiceDate'       => $issue->invoice_date,
                          'AllowanceNotify'   => $Notify,
                          'CustomerName'      => $issue->details()->IIS_Customer_Name,
                          'NotifyMail'        => $email,
                          'NotifyPhone'       => $issue->details()->IIS_Customer_Phone,
                          'AllowanceAmount'   => $amount,
                          'Items'             => $items,
                          'ReturnURL'         => config('ecpay.AllowancReturnURL'),
                      ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function AllowanceInvalid($invoice_no, $allowance_no, $reason = '')
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.AllowanceInvalid');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'  => $this->infos['MerchantID'],
                          'InvoiceNo'   => $invoice_no,
                          'AllowanceNo' => $allowance_no,
                          'Reason'      => $reason,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetAllowanceInvalid($invoice_no, $allowance_no)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetAllowanceInvalid');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'  => $this->infos['MerchantID'],
                          'InvoiceNo'   => $invoice_no,
                          'AllowanceNo' => $allowance_no,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function AllowanceInvalidByCollegiate($invoice_no, $allowance_no, $reason)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.AllowanceInvalidByCollegiate');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'  => $this->infos['MerchantID'],
                          'InvoiceNo'   => $invoice_no,
                          'AllowanceNo' => $allowance_no,
                          'Reason'      => $reason,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetIssueList($begin_date, $end_date, $number_per_page = 200, $showing_page = 2, $data_type = 1)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetIssueList');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'    => $this->infos['MerchantID'],
                          'BeginDate'     => $begin_date,
                          'EndDate'       => $end_date,
                          'NumPerPage'    => $number_per_page,
                          'ShowingPage'   => $showing_page,
                          'DataType'      => $data_type,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetAllowanceList(EcpayAllowanceData $allowanceData)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetAllowanceList');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $issue = json_decode($allowanceData->ecpay_return);
        $array_data = [
                          'MerchantID'    => $this->infos['MerchantID'],
                          'SearchType'    => 2,
                          'InvoiceNo'     => $allowanceData->invoice_no,
                          'Date'          => $issue->IA_TempDate ?? $issue->IA_Date,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function UpdateInvoiceWordStatus($track_id, $invoice_status = 1)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.UpdateInvoiceWordStatus');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'       => $this->infos['MerchantID'],
                          'TrackID'          => $track_id,
                          'Invoice_status'   => $invoice_status,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function GetInvoiceWordSetting($invoice_term, $invoice_year, $use_status)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.GetInvoiceWordSetting');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'       => $this->infos['MerchantID'],
                          'InvoiceTerm'      => $invoice_term,
                          'InvoiceYear'      => $invoice_year,
                          'UseStatus'        => $use_status,
                          'InvoiceCategory'  => '1',
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function VoidWithReIssue($voidModel, $issueModel)
    {
        $this->infos['apiUrl'] = $this->infos['apiUrl'].config('ecpay.VoidWithReIssue');
        $rqHeader = ['Timestamp' => time(), 'Revision' => '1.0.0'];
        $array_data = [
                          'MerchantID'       => $this->infos['MerchantID'],
                          'VoidModel'        => $voidModel,
                          'IssueModel'       => $issueModel,
        ];
        $data = json_encode($array_data);
        $data = $this->ecpayCrypt->encryptAES($data);
        $postData = $this->generatePostData($rqHeader, $data);
        $this->postData = $postData;
        return $postData;
    }

    public function buildAllowanceData(EcpayIssueData $issue, $notify_method, $allowance_amount, $flag = false)
    {
        $jsData = json_decode($issue->issue_data);
        $data = [
                    'MerchantID'       => $this->infos['MerchantID'],
                    'InvoiceNo'        => $issue->invoice_no,
                    'InvoiceDate'      => $issue->invoice_date,
                    'AllowanceNotify'  => $notify_method,
                    'CustomerName'     => $jsData->CustomerName,
                    'NotifyMail'       => $jsData->CustomerEmail,
                    'NotifyPhone'      => $jsData->CustomerPhone,
                    'AllowanceAmount'  => $allowance_amount,
                    'Items'            => $jsData->Items,
        ];
        if ($flag) {
            $data['ReturnURL'] = config('ecpay.AllowancReturnURL');
        }
        return $data;
    }

    private function generatePostData($rqHeader, $data)
    {
        $postData = [
            'MerchantID'    => $this->infos['MerchantID'],
            'RqHeader'      => $rqHeader,
            'Data'          => $data,
        ];
        return $postData;
    }

    public function sendRequest($postData)
    {
        $response = Http::asJson()->post($this->infos['apiUrl'], $postData);
        $data = $response->json();
        if (is_string($data['Data'])) {
            $str = $this->ecpayCrypt->decryptAES($data['Data']);
            $data['Data'] = (json_decode($str));
        }
        return $data;
    }

}

