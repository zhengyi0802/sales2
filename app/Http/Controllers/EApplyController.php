<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EApply;
use App\Models\ECommunity;
use App\Models\EProject;
use App\Models\EcpayResult;
use App\Enums\UserRole;

class EApplyController extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();

        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $eapplies = EApply::where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('eapplies.index2', compact('eapplies'));
            } else {
                $eapplies = EApply::where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('eapplies.index', compact('eapplies'));
            }
        } else {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $eapplies = EApply::where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('eapplies.index2', compact('eapplies'));
            } else {
                if ($flow == 14) {
                    $eapplies = EApply::where('flow', $flow)->get();
                } else if ( $user->role <= UserRole::Manager ) {
                    $eapplies = EApply::get();
                } else if ($user->role == UserRole::Accounter) {
                    $eapplies = EApply::where('flow', 14)->where('status', true)->get();
                } else {
                    $eapplies = EApply::where('status', true)->get();
                }
                return view('eapplies.index', compact('eapplies'));
            }
        }

    }

    public function show(EApply $eapply)
    {
        return view('eapplies.show', compact('eapply'));
    }

    public function edit(EApply $eapply)
    {
        $price = $eapply->project->price;
        $total = $price * $eapply->amount;
        $prepay = $eapply->project->prepaid * $eapply->amount;
        $eprojects = EProject::where('status', true)->get();
        $results = EcpayResult::where('trade_no', $eapply->trade_no)->first();
        $gifts = array();
        if ($eapply->gifts != null) {
            $gifts = json_decode($eapply->gifts);
        }
        return view('eapplies.edit', compact('eapply'))
               ->with(compact('results'))
               ->with(compact('eprojects'))
               ->with('gifts', $gifts)
               ->with('total', $total)
               ->with('prepay', $prepay);
    }

    public function update(Request $request, EApply $eapply)
    {
        $data = $request->all();
        $price = $eapply->project->price;
        $total = $price * $eapply->amount;
        if (isset($data['paid'])) {
            $data['remain'] = $total-$data['paid'];
            if ($data['remain'] < 0) {
                $data['remain'] = 0;
            }
        } else {
            $data['remain'] = 0;
        }
        if (($data['remain'] == 0) && ($eapply->paid > 0)) {
           if (isset($data['project_id']) && $data['project_id'] != $eapply->project_id) {
               $eproject = EProject::find($data['project_id']);
               $price = $eproject->price;
               $total = $price * $eapply->amount;
               $data['remain'] = $total-$eapply->paid;
               $eapply->update($data);
               return redirect()->route('eapplies.edit', compact('eapply'));
           }
        }
        $eapply->update($data);

        return redirect()->route('eapplies.edit', compact('eapply'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('eapplies.index');
        }
        $arrs = array();
        foreach($ids as $id) {
            $eapply = EApply::find($id);
            $data = $this->transfer($eapply);
            $err = $this->transfer($data);
            if ($err) {
                $eapply->flow = 10;
                $eapply->save();
            }
        }

       return redirect()->route('eapplies.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $eapply = EApply::find($id);
        $data = $this->createFormArray($eapply);
        $err = $this->transfer($data);
        if ($err) {
            $eapply->flow = 10;
            $eapply->save();
        }

        return redirect()->route('eapplies.index');
    }

    private function createFormArray(EApply $eapply)
    {
        $data = array();
        $bundles = json_decode($eapply->bundles);
        if (isset($bundles->battery) && $bundles->battery > 0) {
            $bundles = '(加價購電池數量為'.$bundles->battery.'個)';
        } else {
            $bundles = null;
        }

        for ($i = 0; $i < $eapply->amount; $i++) {
             $arr = array(
                    '單號'         => $eapply->id,
                    '社區'         => (($eapply->community) ? $eapply->community->community : $eapply->cname),
                    '姓名'         => $eapply->name,
                    '電話'         => $eapply->phone,
                    '地址'         => $eapply->address,
                    '支付方式'     => (($eapply->payment == 1) ? '銀行轉帳' : '多元支付'),
                    '方案選擇'     => ( $eapply->project->name ),
                    '備註說明'     => $eapply->memo.$bundles,
                    '建立日期'     => now()->format('Y/m/d H:i:s'),
                    '進件單位'     => $eapply->reseller->name,
             );
             array_push($data, $arr);
             $bundles = null;
        }
        return $data;
    }

    private function transfer($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
             CURLOPT_URL => config('gas.export_url'),
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_TIMEOUT => 30000,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS => json_encode($data),
             CURLOPT_HTTPHEADER => array(
                 'Content-Type: application/json',
            ),
       ));

       $response = curl_exec($curl);
       if(!$response) {
           $err = curl_error($curl);
       }
       curl_close($curl);
       return $response;
    }


    public function destroy(EApply $eapply)
    {
        if ($eapply->status == false) {
            $eapply->delete();
        } else {
            $eapply->status = false;
            $eapply->save();
        }
        return redirect()->route('eapplies.index');
    }

}
