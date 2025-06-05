<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ECPay\ECPayInvoice;
use App\Models\EApply;
use App\Models\HpPromotion;
use App\Models\EcpayResult;
use App\Models\EcpayAllowanceData;
use App\Models\EcpayAllowanceInfo;
use App\Models\EcpayApiLog;
use App\Models\EcpayCompanyInfo;
use App\Models\EcpayGovInvoiceWordSetting;
use App\Models\EcpayInvoicePrint;
use App\Models\EcpayInvoiceNotify;
use App\Models\EcpayInvoiceWordSetting;
use App\Models\EcpayIssueData;
use App\Models\EcpayIssueInfo;
use App\Models\EcpayLoveCode;
use App\Models\EcpayInvalid;
use App\Models\EcpayAllowanceInvalid;
use App\Models\EcpayDelayIssueNotify;
use App\Models\EcpayAllowanceNotify;
use App\Collections\IssueCollection;

class EcpayInvoiceController extends Controller
{
    //
    public $env = 'production';

    public function settings(Request $request)
    {
        return view('invoices.settings');
    }

    public function issues(Request $request)
    {
        $issues = EcpayIssueData::where('delay_flag', false)->get();
        $delayissues = EcpayIssueData::where('delay_flag', true)->get();

        return view('invoices.issues', compact('issues'))->with(compact('delayissues'));
    }

    public function editIssue(Request $request)
    {
        $id = $request->input('id');
        $issue = EcpayIssueData::find($id);
        $issueDetails = json_decode($issue->issue_data);

        return view('invoices.issues.edit', compact('issue'));
    }

    public function allowances()
    {
        $allowances = EcpayAllowanceData::where('router', 'Allowance')->get();
        $allowancebycollegiates = EcpayAllowanceData::where('router', 'AllowanceByCollegiate')->get();
        return view('invoices.allowances', compact('allowances'))->with(compact('allowancebycollegiates'));
    }

    public function GetGovInvoiceWordSetting(Request $request)
    {
        $results = EcpayGovInvoiceWordSetting::where('year', date('Y')-1911)->get();
        if ($results->count() > 0) {
            return view('invoices.settings', compact('results'));
        }
        $Invoice = new ECPayInvoice($this->env);
        $postData = $Invoice->GetGovInvoiceWordSetting();
        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetGovInvoiceWordSetting',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            EcpayApiLog::create($logData);
        }
        $results = array();
        if ($response['TransCode'] == '1') {
            $data = $response['Data'];
            if ($data->RtnCode == 1) {
                $results = $data->InvoiceInfo;
                foreach($results as $result) {
                    $data = [
                                'year'   => date('Y')-1911,
                                'term'   => $result->InvoiceTerm,
                                'type'   => $result->InvType,
                                'header' => $result->InvoiceHeader,
                                'start'  => $result->InvoiceStart,
                                'end'    => $result->InvoiceEnd,
                                'number' => $result->Number,
                            ];
                    EcpayGovInvoiceWordSetting::create($data);
                } // foreach
            }  // RtnCode == 1
        }  // TransCode == 1
        $results = EcpayGovInvoiceWordSetting::where('year', date('Y')-1911)->get();
        return view('invoices.settings', compact('results'));
    }

    public function AddInvoiceWordSetting(Request $request)
    {
        $req = $request->all();
        if (isset($req['year'])) {
            $year = $req['year'];
        } else {
            return view('invoices.settings');;
        }
        if (isset($req['term'])) {
            $term = $req['term'];
        } else {
            return view('invoices.settings');
        }

        $Invoice = new ECPayInvoice($this->env);

        $invoice = EcpayGovInvoiceWordSetting::where('year', $year)->where('term', $term)->first();
        if ($invoice == null) {
            return 0;
        }
        $postData = $Invoice->AddInvoiceWordSetting($term, $year, $invoice->header, $invoice->start, $invoice->end);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'        => 'AddInvoiceWordSetting',
                          'trans_code'  => $response['TransCode'],
                          'trans_msg'   => $response['TransMsg'],
                          'rtn_code'    => $response['Data']->RtnCode ?? null,
                          'rtn_msg'     => $response['Data']->RtnMsg ?? null,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            $data = [
                        'year'     => $year,
                        'term'     => $term,
                        'header'   => $invoice->header,
                        'start'    => $invoice->start,
                        'end'      => $invoice->end,
                        'rtn_code' => $response['Data']->RtnCode ?? '',
                        'track_id' => $response['Data']->TrackID ?? '',
                        'status'   => true,
                        'command'  => 'Add',
                        'log_id'   => $log->id ?? 0,
            ];
            $result1 = EcpayInvoiceWordSetting::create($data);
        }

        return view('invoices.settings', compact('result1'));
    }

    public function  UpdateInvoiceWordStatus(Request $request)
    {
        $req = $request->all();
        if (isset($req['TrackID'])) {
            $track_id = $req['TrackID'];
        } else {
            return view('invoices.settings');
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->UpdateInvoiceWordStatus($track_id, 1);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'UpdateInvoiceWordStatus',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        $data = $response['Data'];

        return view('invoices.settings', compact('data'));
    }

    public function GetInvoiceWordSetting(Request $request)
    {
        $req = $request->all();
        if (isset($req['year'])) {
            $year = $req['year'];
        } else {
            return view('invoices.settings');
        }
        if (isset($req['term'])) {
            $term = $req['term'];
        } else {
            return view('invoices.settings');
        }
        if (isset($req['status'])) {
            $status = $req['status'];
        } else {
            $status = view('invoices.settings');
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->GetInvoiceWordSetting($term, $year,  $status);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'GetInvoiceWordSetting',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            $infos = $response['Data']->InvoiceInfo;
            if ($response['Data']->RtnCode == 1) {
                foreach($infos as $info) {
                    $data = [
                        'year'         => $year,
                        'term'         => $term,
                        'header'       => $info->InvoiceHeader,
                        'start'        => $info->InvoiceStart,
                        'end'          => $info->InvoiceEnd,
                        'rtn_code'     => $response['Data']->RtnCode,
                        'track_id'     =>  $info->TrackID,
                        'status'       => $info->UseStatus,
                        'invoice_no'   => $info->InvoiceNo,
                        'command'      => 'Get',
                        'log_id'       => $log->id ?? 0,
                    ];
                    $invoice = EcpayInvoiceWordSetting::create($data);
                } // foreach
                $invs = EcpayInvoiceWordSetting::where('year', date('Y')-1911)->where('term', $term)->get();
                return view('invoices.settings', compact('invs'));
            } // RtmCode == 1
        } // TransCode == 1
        $invs = $infos;
        return view('invoices.settings'. compact('invs'));
    }

    public function GetCompanyNameByTaxID(Request $request)
    {
        $req = $request->all();
        if (isset($req['UnifiedBusinessNo'])) {
           $unified_number = $req['UnifiedBusinessNo'];
        } else {
           return view('invoices.settings');
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->GetCompanyNameByTaxID($unified_number);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name' => 'GetCompanyNameByTaxID',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'unified_number' => $unified_number,
                          'company_name'   => $response['Data']->CompanyName,
                          'log_id'         => $log->id ?? 0,
                        ];
                EcpayCompanyInfo::create($data);
                $companyName = $response['Data']->CompanyName;
                return view('invoices.settings', compact('companyName'));
            } // RtnCode == 1
        } // TransCode == 1
        return view('invoices.settings');
    }

    public function CheckBarcode(Request $request)
    {
        $req = $request->all();
        if (isset($req['Barcode'])) {
            $barcode = $req['Barcode'];
        } else {
            return redirect()->back();
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->CheckBarcode($barcode);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name' => 'GetCompanyNameByTaxID',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                return (($response['Data']->IsExist == 'Y') ? true : false);
            }
        }
        return redirect()->back();
    }

    public function CheckLoveCode(Request $request)
    {
        $req = $request->all();
        if (isset($req['LoveCode'])) {
            $loveCode = $req['LoveCode'];
        } else {
            return redirect()->back();
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->CheckLoveCode($loveCode);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name' => 'CheckLoveCode',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode,
                          'rtn_msg'    => $response['Data']->RtnMsg,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'love_code'      => $lovecode,
                          'organ_name'     => $response['Data']->OrganName,
                          'is_exist'       => $response['Data']->IsExist,
                          'log_id'         => $log->id ?? 0,
                        ];
                EcpayLoveCode::create($data);
            }
        }
        return redirect()->back();
    }

    public function Issue(Request $request)
    {
        $req = $request->all();
        if ($req['DelayFlag'] == 1) {
            return $this->DelayIssue($request);
        }
        $Invoice = new ECPayInvoice($this->env);
        if ($req['apply_id'] > 0) {
            $apply = EApply::find($req['apply_id']);
            $issueData = $Invoice->buildIssueDataA($apply, $req);
        } else {
            $promotion = HpPromotion::find($req['prom_id']);
            $issueData = $Invoice->buildIssueDataP($promotion, $req);
        }
        $issueData['CustomerName'] = $req['CustomerName'];
        $issueData['CustomerAddr'] = $req['CustomerAddr'];
        $issueData['CustomerPhone'] = $req['CustomerPhone'];
        $issueData['CustomerEmail'] = $req['CustomerEmail'];
        $issueData['CustomerIdentifier'] = $req['CustomerIdentifier'];
        $issueData['InvoiceRemark'] = $req['InvoiceRemark'];
        $issueData['SalesAmount'] = $req['SalesAmount'];

        $postData = $Invoice->Issue($issueData);

        $response = $Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name' => 'Issue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'apply_id'       => $apply->id ?? 0,
                          'prom_id'        => $promotion->id ?? 0,
                          'issue_data'     => json_encode($issueData),
                          'invoice_no'     => $response['Data']->InvoiceNo,
                          'invoice_date'   => $response['Data']->InvoiceDate,
                          'random_number'  => $response['Data']->RandomNumber,
                          'rtn_code'       => $response['Data']->RtnCode,
                          'rtn_msg'        => $response['Data']->RtnMsg,
                          'log_id'         => $log->id,
                        ];
                $result2 = EcpayIssueData::create($data);
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.issues')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }

        return redirect()->back()->with('error', $error);
    }

    public function DelayIssue(Request $request)
    {
        $req = $request->all();
        if ($req['DelayFlag'] == 0) {
            return $this->Issue($request);
        }

        $Invoice = new ECPayInvoice($this->env);

        if ($req['apply_id'] > 0) {
            $apply = EApply::find($req['apply_id']);
            $issueData = $Invoice->buildIssueDataA($apply, $req);
        } else {
            $promotion = HpPromotion::find($req['prom_id']);
            $issueData = $Invoice->buildIssueDataP($promotion, $req);
        }
        $issueData['CustomerName'] = $req['CustomerName'];
        $issueData['CustomerAddr'] = $req['CustomerAddr'];
        $issueData['CustomerPhone'] = $req['CustomerPhone'];
        $issueData['CustomerEmail'] = $req['CustomerEmail'];
        $issueData['CustomerIdentifier'] = $req['CustomerIdentifier'];
        $issueData['InvoiceRemark'] = $req['InvoiceRemark'];
        $issueData['SalesAmount'] = $req['SalesAmount'];
        $issueData['DelayFlag'] = $req['DelayFlag'];
        $issueData['DelayDay'] = $req['DelayDay'];
        $issueData['Tsr'] = $req['Tsr'];
        $issueData['PayType'] = '2';
        $issueData['PayAct'] = 'ECPAY';
        $issueData['NotifyURL'] = config('ecpay.DelayIssueReturnURL');

        //$array_data = $Invoice->addDelayIssueData($array_data, $tsr, '1', $delayDay);

        $postData = $Invoice->DelayIssue($issueData);

        $response=$Invoice->sendRequest($postData);

        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'DelayIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg  ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'apply_id'       => $apply->id ?? 0,
                          'prom_id'        => $promotion->id ?? 0,
                          'issue_data'     => json_encode($issueData),
                          'delay_flag'     => true,
                          'delay_day'      => $issueData['DelayDay'],
                          'order_number'   => $response['Data']->OrderNumber,
                          'tsr'            => $issueData['Tsr'],
                          'rtn_code'       => $response['Data']->RtnCode ?? '',
                          'rtn_msg'        => $response['Data']->RtnMsg ?? '',
                          'log_id'         => $log->id,
                        ];
                $result2 = EcpayIssueData::create($data);
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.issues')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function EditDelayIssue(Request $request)
    {
        $req = $request->all();

        $Invoice = new ECPayInvoice($this->env);

        if (isset($req['apply_id'])) {
            $apply = EApply::find($req['apply_id']);
            $issueData = $Invoice->buildIssueDataA($apply, $req);
        } else {
            $promotion = HpPromotion::find($req['prom_id']);
            $issueData = $Invoice->buildIssueDataP($promotion, $req);
        }

        $issueData['CustomerName'] = $req['CustomerName'];
        $issueData['CustomerAddr'] = $req['CustomerAddr'];
        $issueData['CustomerPhone'] = $req['CustomerPhone'];
        $issueData['CustomerEmail'] = $req['CustomerEmail'];
        $issueData['CustomerIdentifier'] = $req['CustomerIdentifier'];
        $issueData['InvoiceRemark'] = $req['InvoiceRemark'];
        $issueData['SalesAmount'] = $req['SalesAmount'];
        $issueData['DelayFlag'] = $req['DelayFlag'];
        $issueData['DelayDay'] = $req['DelayDay'];
        $issueData['Tsr'] = $req['Tsr'];
        $issueData['PayType'] = '2';
        $issueData['PayAct'] = 'ECPAY';

        $postData = $Invoice->EditDelayIssue($issueData);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'EditDelayIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg  ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                          'apply_id'       => $apply->id ?? 0,
                          'prom_id'        => $promotion->id ?? 0,
                          'issue_data'     => json_encode($issueData),
                          'rtn_code'       => $response['Data']->RtnCode ?? '',
                          'rtn_msg'        => $response['Data']->RtnMsg ?? '',
                          'log_id'         => $log->id,
                        ];
                if(isset($apply)) {
                    $issueData = EcpayIssueData::where('apply_id', $apply->id)->first();
                } else {
                    $issueData = EcpayIssueData::where('prom_id', $promotion->id)->first();
                }
                $issueData->update($data);
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.issues')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }

        return redirect()->back()->with('error', $error);
    }

    public function TriggerIssue(Request $request)
    {
        $req = $request->all();

        if (isset($req['id'])) {
            $issueData = EcpayIssueData::find($req['id']);
        }

        $tsr = $issueData->tsr;

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->TriggerIssue($tsr);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'TriggerIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == '4000003') {
                $issueData->trigger_date = date('Y/m/d h:i:s');
                $issueData->save();
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.issues')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }

        return redirect()->back()->with('error', $error);
    }

    public function CancelDelayIssue(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $issueData = EcpayIssueData::find($req['id']);
        }
        if (isset($req['apply_id'])) {
            $issueData = EcpayIssueData::where('apply_id', $req['apply_id'])->first();
        }
        if (isset($req['prom_id'])) {
            $issueData = EcpayIssueData::where('prom_id', $req['prom_id'])->first();
        }

        $tsr = $issueData->tsr;

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->CancelDelayIssue($tsr);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'CancelDelayIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $issueData->invalid_flag = true;
                $issueData->invalid_date = date('Y/m/d h:i:s');
                $issueData->save();
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.issues')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->route('invoices.issues')->with('error', $error);
    }

    public function Allowance(Request $request)
    {
        $req = $request->all();
        if (isset($req['type']) && $req['type'] == 2) {
            return $this->AllowanceByCollegiate($request);
        }
        if (isset($req['id'])) {
            $issue = EcpayIssueInfo::find($req['id']);
        } else {
            $error = '發票資料不存在';
            return redirect()->back()->with('error', $error);
        }
        if (isset($req['AllowanceAmount'])) {
            $AllowanceAmount = $req['AllowanceAmount'];
        }
        $Notify = 'E';
        if (isset($req['Notify'])) {
            $Notify = $req['Notify'];
        }
        if (isset($req['NotifyMail'])) {
            $NotifyMail = $req['NotifyMail'];
        } else {
            $error = '通知電子郵件地址不存在';
            return redirect()->back()->with('error', $error);
        }
        $reason = '';
        if (isset($req['Reason'])) {
            $reason = $req['Reason'];
        }

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->Allowance($issue, $AllowanceAmount, $Notify, $NotifyMail, $reason);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'CancelDelayIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                            'issue_id'                  => $req['id'] ?? 0,
                            'ecpay_return'              => json_encode($response['Data']),
                            'notify_method'             => $Notify,
                            'notify_mail'               => $NotifyMail,
                            'notify_phone'              => $issue->details()->IIS_Customer_Phone,
                            'allowance_amount'          => $AllowanceAmount,
                            'allowance_no'              => $response['Data']->IA_Allow_No,
                            'invoice_no'                => $response['Data']->IA_Invoice_No,
                            'date'                      => $response['Data']->IA_Date ?? '',
                            'remain_allowance_amount'   => $response['Data']->IA_Remain_Allowance_Amt,
                            'router'                    => 'Allowance',
                            'rtn_code'                  => $response['Data']->RtnCode ?? '',
                            'rtn_msg'                   => $response['Data']->RtnMsg ?? '',
                            'log_id'                    => $log->id ?? 0,
                        ];
                $allowance = EcpayAllowanceData::create($data);
                return redirect()->route('invoices.allowances');
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function AllowanceByCollegiate(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $issue = EcpayIssueInfo::find($req['id']);
        } else {
            $error = '發票資料不存在';
            return redirect()->back()->with('error', $error);
        }
        if (isset($req['AllowanceAmount'])) {
            $amount = $req['AllowanceAmount'];
        }
        if (isset($req['NotifyMail'])) {
            $email = $req['NotifyMail'];
        }
        $notify = 'E';
        if (isset($req['Notify'])) {
            $notify = $req['Notify'];
        }
        $reason = '';
        if (isset($req['Reason'])) {
            $reason = $req['Reason'];
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->AllowanceByCollegiate($issue, $amount, $email, $notify);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'AllowanceByCollegiate',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                            'issue_id'                  => $req['id'] ?? 0,
                            'ecpay_return'              => json_encode($response['Data']),
                            'notify_method'             => $notify,
                            'notify_mail'               => $email,
                            'notify_phone'              => $issue->details()->IIS_Customer_Phone,
                            'allowance_amount'          => $amount,
                            'allowance_no'              => $response['Data']->IA_Allow_No,
                            'invoice_no'                => $response['Data']->IA_Invoice_No,
                            'temp_date'                 => $response['Data']->IA_TempDate ?? '',
                            'date'                      => $response['Data']->IA_Date ?? '',
                            'temp_expire_date'          => $response['Data']->IA_TempExpireDate ?? '',
                            'remain_allowance_amount'   => $response['Data']->IA_Remain_Allowance_Amt,
                            'router'                    => 'AllowanceByCollegiate',
                            'rtn_code'                  => $response['Data']->RtnCode ?? '',
                            'rtn_msg'                   => $response['Data']->RtnMsg ?? '',
                            'log_id'                    => $log->id ?? 0,
                        ];
                $allowanceData = EcpayAllowanceData::create($data);
                return redirect()->route('invoices.allowances');
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }

        return redirect()->back()->with('error', $error);
    }

    public function Invalid(Request $request)
    {
        $req = $request->all();

        if (isset($req['id'])) {
            $issue = EcpayIssueData::find($req['id']);
        }
        if (isset($req['apply_id'])) {
            $issue = EcpayIssueData::where('apply_id', $req['apply_id'])->first();
        }
        if (isset($req['prom_id'])) {
            $issue = EcpayIssueData::where('prom_id', $req['prom_id'])->first();
        }

        $reason = "取消發票";
        if (isset($req['reason'])) {
            $reason = $req['reason'];
        }

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->Invalid($issue->invoice_no, $issue->invoice_date, $reason);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'Invalid',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? null,
                          'rtn_msg'    => $response['Data']->RtnMsg ?? null,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            $issue->invalid_date = now();
            $issue->invalid_reason = $reason;
            $issue->rtn_code = $response['Data']->RtnCode;
            $issue->rtn_msg  = $response['Data']->RtnMsg;
            $issue->save();
            if($response['Data']->RtnCode == 1) {
               $issue->invalid_flag = true;
               $issue->invalid_date = date('Y/m/d h:i:s');
               $issue->save();
               $success = $response['Data']->RtnMsg;
               return redirect()->route('invoices.issues')->with('success', $success);
            } else {
               $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);;
    }

    public function AllowanceInvalid(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $allowance    = EcpayAllowanceData::find($req['id']);
            $invoice_no   = $allowance->invoice_no;
            $allowance_no = $allowance->allowance_no;
        } else {
            if (isset($req['invoice_no'])) {
                $invoice_no = $req['invoice_no'];
            }
            if (isset($req['allowance_no'])) {
                $allowance_no = $req['allowance_no'];
            }
        }
        if (isset($req['reason'])) {
            $reason = $req['reason'];
        } else {
            $reason = '因折讓金額填錯,作廢折讓';
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->AllowanceInvalid($invoice_no, $allowance_no, $reason);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'Invalid',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? null,
                          'rtn_msg'    => $response['Data']->RtnMsg ?? null,
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $allowance->invalid_flag = true;
                $allowance->invalid_date = date('Y/m/d h:i:s');
                $allowance->save();
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.allowances');
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }

        return redirect()->back()->with('error', $error);
    }

    public function AllowanceInvalidByCollegiate(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $allowance = EcpayAllowanceData::find($req['id']);
        } else {
            $error = '發票資料不存在';
            return redirect()->back()->with('error', $error);
        }
        if (isset($req['reason'])) {
            $reason = $req['reason'];
        } else {
            $reason = '因折讓金額有誤, 取消折讓單';
        }
        $Invoice = new ECPayInvoice($this->env);

        $invoice_no = $allowance->invoice_no;
        $allowance_no = $allowance->allowance_no;

        $postData = $Invoice->AllowanceInvalidByCollegiate($invoice_no, $allowance_no, $reason);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'AllowanceInvalidByCollegiate',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $allowance->invalid_flag = true;
                $allowance->invalid_date = date('Y/m/d h:i:s');
                $allowance->save();
                $success = $response['Data']->RtnMsg;
                return redirect()->route('invoices.allowances')->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function VoidWithReIssue(Request $request)
    {
        $req = $request->all();
        if (isset($req['invoice_no'])) {
            $invoice_no = $req['invoice_no'];
        }
        $void_reason="發票資料有誤, 註銷重開";
        if (isset($req['void_reason'])) {
            $void_reason = $req['void_reason'];
        }

        $Invoice = new ECPayInvoice($this->env);

        $voidModel = [
                         'InvoiceNo'        => $invoice_no,
                         'VoidReason'       => $void_reason,
                     ];

        if (isset($req['apply_id'])) {
            $apply = EApply::find($req['apply_id']);
            $IssueModel = $Invoice->buildIssueDataA($apply, $req);
        } else {
            $promotion = HpPromotion::find($req['prom_id']);
            $IssueModel = $Invoice->buildIssueDataP($promotion, $req);
        }

        $postData = $Invoice->VoidWithReIssue($voidModel, $IssueModel);
        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $result = [
                          'name'       => 'VoidWithReIssue',
                          'trans_code' => $response['TransCode'],
                          'trans_msg'  => $response['TransMsg'],
                          'rtn_code'   => $response['Data']->RtnCode ?? '',
                          'rtn_msg'    => $response['Data']->RtnMsg ?? '',
                      ];
            $log = EcpayApiLog::create($result);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                    'invoice_no'    => $response['Data']->InvoiceNo,
                    'invoice_date'  => $response['Data']->InvoiceDate,
                    'random_number' => $response['Data']->RandomNumber,
                ];
                if(isset($apply)) {
                    $issueData = EcpayIssueData::where('apply_id', $apply->id)->first();
                } else {
                    $issueData = EcpayIssueData::where('prom_id', $promotion->id)->first();
                }
                $issueData->update($data);
                return redirect()->route('invoices.issues');
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->route('invoices.issues')->with('error', $error);
    }

    public function GetIssue(Request $request)
    {
        $req = $request->all();

        if (isset($req['id'])) {
            $issue = EcpayIssueData::find($req['id']);
            if($issue->invalid_flag) {
               return $this->GetInvalid($request);
            }
            $invoice_no   = $issue->invoice_no;
            $invoice_date = $issue->invoice_date;
        } else {
            $error = '無效的參數';
            return redirect()->back()->with('error', $error);
        }

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->GetIssue($invoice_no, $invoice_date);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetIssue',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $Data = $response['Data'];
                $data = [
                            'issue_id'       => $issue->id,
                            'invoice_no'     => $invoice_no,
                            'invoice_date'   => $invoice_date,
                            'ecpay_return'   => json_encode($Data),
                            'rtn_code'       => $response['Data']->RtnCode ?? '',
                            'rtn_msg'        => $response['Data']->RtnMsg ?? '',
                            'log_id'         => $log->id ?? 0,
                            'router'         => 'GetIssue',
                        ];
                $issueInfo = EcpayIssueInfo::create($data);
                $success = $response['Data']->RtnMsg;
                return view('invoices.issues.show', compact('issueInfo'));
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function GetIssueList(Request $request)
    {
        $req = $request->all();
        if (isset($req['BeginDate'])) {
            $BeginDate = date('Y/m/d', strtotime($req['BeginDate']));
        }
        if (isset($req['EndDate'])) {
            $EndDate = date('Y/m/d', strtotime($req['EndDate']));
        }
        if (isset($req['NumPerPage'])) {
            $NumPerPage = $req['NumPerPage'];
        }
        if (isset($req['ShowingPage'])) {
            $ShowingPage = $req['ShowingPage'];
        }

        $DataType = 1;
        if (isset($req['DataType'])) {
            $DataType = $req['DataType'];
        }

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->GetIssueList($BeginDate, $EndDate, $NumPerPage, $ShowingPage, $DataType);

        $response = $Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetIssueList',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']['RtnCode'] == 1) {
                $invoiceData = $response['Data']['InvoiceData'];
                $totalCount = $response['Data']['TotalCount'];
                $ShowingPage = $response['Data']['ShowingPage'];
/*
                foreach($invoiceData as $invoicedata) {

                    $data2 = [
                                'invoice_no'    => $invoicedata['IIS_Number'],
                                'invoice_date'  => $invoicedata['IIS_Create_Date'],
                                'ecpay_return'  => $data,
                                'rtn_code'      => $response['Data']->RtnCode,
                                'rtn_msg'       => $response['Data']->RtnMsg,
                                'log_id'        => $log->id ?? 0,
                             ];
                    EcpayIssueInfo::create($data2);
                }
*/
                return view('invoices.invoices', compact('invoiceData'));
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function GetAllowanceList(Request $request)
    {
         $req = $request->all();
         if (isset($req['id'])) {
             $allowanceData = EcpayAllowanceData::find($req['id']);
         } else {
             $error = '折讓資料編號參數不存在';
             return redirect()->back()->with('error', $error);
         }
         $Invoice = new ECPayInvoice($this->env);

         $postData = $Invoice->GetAllowanceList($allowanceData);

         $response=$Invoice->sendRequest($postData);
         if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetAllowanceList',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
         }
         if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                    'ecpay_return'     => json_encode($response['Data']->AllowanceInfo),
                    'allowance_id'     => $allowanceData->id ?? 0,
                    'rtn_code'         => $response['Data']->RtnCode ?? 0,
                    'rtn_msg'          => $response['Data']->RtnMsg ?? '',
                    'log_id'           => $log->id ?? 0,
                    'router'           => 'GetAllowanceList',
                ];
                EcpayAllowanceInfo::create($data);
                $allowanceInfo = EcpayAllowanceInfo::where('log_id', $log->id)->first();
                $success = $response['Data']->RtnMsg;
                return view('invoices.allowances.show', compact('allowanceInfo'))->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
         } else {
            $error = $response['TransMsg'];
         }
         return redirect()->back()->with('error', $error);
    }

    public function GetInvalid(Request $request)
    {
         $req = $request->all();

         if (isset($req['id'])) {
             $issue = EcpayIssueData::find($req['id']);
             $relateNumber = $issue->details()->RelateNumber;
             $invoice_no = $issue->invoice_no;
             $invoice_date = $issue->invoice_date;
         } else {
             $error = '無效的參數';
             return redirect()->route('invoices.issues')->with('error', $error);
         }

         $Invoice = new ECPayInvoice($this->env);

         $postData = $Invoice->GetInvalid($relateNumber, $invoice_no, $invoice_date);

         $response=$Invoice->sendRequest($postData);
         if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetInvalid',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
         }
         if ($response['TransCode'] == 1) {
             if ($response['Data']->RtnCode == 1) {
                 $data = [
                             'issue_id'              => $issue->id,
                             'invoice_no'            => $invoice_no,
                             'invoice_date'          => $invoice_date,
                             'ecpay_return'          => json_encode($response['Data']),
                             'RtnCode'               => $response['Data']->RtnCode,
                             'RtnMsg'                => $response['Data']->RtnMsg,
                             'log_id'                => $log->id ?? 0,
                             'router'                => 'GetInvalid',
                 ];
                 $invalid = EcpayIssueInfo::create($data);
                 $success = $response['Data']->RtnMsg;
                 return view('invoices.issues.show2', compact('invalid'))->with('success', $success);
             } else {
                 $errror = $response['Data']->RtnMsg;
             }
         } else {
             $error = $response['TransMsg'];
         }
         return redirect()->back()->with('error', $error);
    }

    public function GetAllowanceInvalid(Request $request)
    {
        $req = $request->all();
        $invoice_no = $req['invoice_no'];
        $alloeance_no = $req['allowance_no'];

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->GetAllowanceInvalid($invoice_no, $allowance_no);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'GetAllowanceInvalid',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
         }
         if ($response['TransCode'] == 1) {
             if ($response['Data']->RtnCode == 1) {
                 $data = [
                             'AI_Allow_Date'        => $response['Data']->AI_Allow_Date,
                             'AI_Allow_No'          => $response['Data']->AI_Allow_No,
                             'AI_Buyer_Identifier'  => $response['Data']->AI_Buyer_Identifier,
                             'AI_Date'              => $response['Data']->AI_Date,
                             'AI_Invoice_No'        => $response['Data']->AI_Invoice_No,
                             'Reason'               => $response['Data']->Reason,
                             'AI_Seller_Identifier' => $response['Data']->AI_Seller_Identifier,
                             'AI_Upload_Date'       => $response['Data']->AI_Upload_Date,
                             'AI_Upload_Status'     => $response['Data']->AI_Upload_Status,
                             'RtnCode'              => $response['Data']->RtnCode,
                             'RtnMsg'               => $response['Data']->RtnMsg,
                             'log_id'               => $log->id,
                 ];
                 $AloowanceInvalid = EcpayAllowanceInvalid::create($data);
                 $data = [
                             'issue_id'              => $issue->id,
                             'invoice_no'            => $invoice_no,
                             'invoice_date'          => $invoice_date,
                             'ecpay_return'          => json_encode($response['Data']),
                             'RtnCode'               => $response['Data']->RtnCode,
                             'RtnMsg'                => $response['Data']->RtnMsg,
                             'log_id'                => $log->id ?? 0,
                             'router'                => 'GetInvalid',
                 ];

                 return view('invoices.settings', compact('AllowanceInvalid'));
             } else {
                 $error = $response['Data']->RtnMsg;
             }
         } else {
             $error = $response['TransMsg'];
         }

         return redirect()->back()->with('error', $error);
    }

    public function InvoiceNotify(Request $request, EApply $eapply)
    {
        $req = $request->all();

        $invoice_no = $req['invoice_no'];
        $phone = $req['phone'] ?? '';
        $email = $req['email'];
        $notify = $req['notify'] ?? 'E';
        $tag = $req['tag'] ?? 'I';
        $notified = $req['notified'] ?? 'A';

        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->InvoiceNotify($invoice_no, $phone, $email, $notify, $tag, $notified);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'InvoiceNotify',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode== 1) {
                $data = [
                        'invoice_no'  => $invoice_no,
                        'phonr'       => $phone,
                        'email'       => $email,
                        'notify'      => $notify,
                        'tag'         => $tag,
                        'notified'    => $notified,
                        'log_id'      => $log->id ?? 0,
                ];
                $invoiceNotify = EcpayInvoiceNotify::create($data);
                $success = $response['Data']->RtnMsg;
                return redirect()->back()->with('success', $success);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function InvoicePrint(Request $request)
    {
        $req = $request->all();
        if (isset($req['invoice_no'])) {
            $invoice_no = $req['invoice_no'];
        }
        if (isset($req['invoice_date'])) {
            $invoice_date = $req['invoice_date'];
        }
        $print_style = '1';
        if (isset($req['print_style'])) {
            $print_style = $req['print_style'];
        }
        $showing_detail = '1';
        if (isset($req['showing_detail'])) {
            $showing_detail = $req['showing_detail'];
        }
        $Invoice = new ECPayInvoice($this->env);

        $postData = $Invoice->InvoicePrint($invoice_no, $invoice_date, $print_style, $showing_detail);

        $response=$Invoice->sendRequest($postData);
        if (config('ecpay.ApiLog')) {
            $logData = [
                       'name'       => 'InvoicePrint',
                       'trans_code' => $response['TransCode'],
                       'trans_msg'  => $response['TransMsg'],
                       'rtn_code'   => $response['Data']->RtnCode ?? null,
                       'rtn_msg'    => $response['Data']->RtnMsg ?? null,
            ];
            $log = EcpayApiLog::create($logData);
        }
        if ($response['TransCode'] == 1) {
            if ($response['Data']->RtnCode == 1) {
                $data = [
                            'invoice_no'     => $invoice_no,
                            'invoice_date'   => $invoice_date,
                            'invoice_html'   => $response['Data']->InvoiceHtml ?? '',
                            'log_id'         => $log->id ?? 0,
                        ];
                $invoicePrint = EcpayInvoicePrint::create($data);
                return redirect()->away($response['Data']->InvoiceHtml);
            } else {
                $error = $response['Data']->RtnMsg;
            }
        } else {
            $error = $response['TransMsg'];
        }
        return redirect()->back()->with('error', $error);
    }

    public function dlcallback(Request $request)
    {
        $req = $requesy->all();
        $data = [
                    'inv_mer_id'    => $req['inv_mer_id'] ?? '',
                    'od_sob'        => $req['od_sob'] ?? '',
                    'tsr'           => $req['tsr'] ?? '',
                    'invoicedate'   => $req['invoicedate'] ?? '',
                    'invoicetime'   => $req['invoicetime'] ?? '',
                    'invoicenumber' => $req['invoicenumber'] ?? '',
                    'invoicecode'   => $req['invoicecode'] ?? '',
                    'inv_error'     => $req['inv_error'] ?? '',
        ];
        EcpayDelayIssueNotify::create($data);
        return '1|200OK';
    }

    public function callback(Request $request)
    {
        $req = $request->all();
        $data = [
                    'RtnCode'                  => $req['RtnCode'] ?? '',
                    'RtnMsg'                   => $req['RtnMsg'] ?? '',
                    'IA_Allow_No'              => $req['IA_Allow_No'] ?? '',
                    'IA_Invoice_No'            => $req['IA_Invoice_No'] ?? '',
                    'IA_Date'                  => $req['IA_Date'] ?? '',
                    'IIS_Remain_Allowance_Amt' => $req['IIS_Remain_Allowance_Amt'] ?? '',
                    'CheckMacValue'            => $req['CheckMacValue'] ?? '',
        ];
        EcpayAllowanceNotify::create($data);

        return '1|200OK';
    }

}

