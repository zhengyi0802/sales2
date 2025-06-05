<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\EApply;
use App\Models\HpProduct;
use App\Models\HpPromotion;
use App\Collections\IssueCollection;

class IssueController extends Controller
{
    //
    public function create(Request $request)
    {
        $req = $request->all();

        try {
              if (isset($req['apply_id'])) {
                  $apply = EApply::find($req['apply_id']);
              } else if (isset($req['prom_id'])) {
                  $promotion = HpPromotion::find($req['prom_id']);
              } else {
                  $error = '無法找到訂單';
                  return redirect()->back()->with('error', $error);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }
        if (isset($apply)) {
            if ($apply->trade_no == null) {
                $apply->trade_no = 'HP'.date('Ymdhis').(string)($apply->id%100);
                $apply->save();
            }
            if ($apply->trade_date == null) {
                $apply->trade_date = date('Y/m/d h:i:s');
                $apply->save();
            }
        }

        $issueData = new IssueCollection();
        $issueData->apply_id = isset($apply) ? $apply->id : 0;
        $issueData->prom_id = isset($promotion) ? $promotion : 0;
        $issueData->RelateNumber = isset($apply) ? substr($apply->trade_no, 2)
                         : substr($promotion->trade_no, 2);
        $issueData->CustomerName = isset($apply) ? $apply->name : $promotion->name;
        $issueData->CustomerAddr = isset($apply) ? $apply->address : $promotion->address;
        $issueData->CustomerPhone = isset($apply) ? $apply->phone : $promotion->phone;
        $issueData->CustomerEmail = isset($apply) ? $apply->email : $promotion->email;
        $issueData->CustomerIdentifier = isset($apply) ? $apply->unified_number : $promotion->unified_number;
        $issueData->CustomerEmail = isset($apply) ? $apply->email : $promotion->email;
        $issueData->SalesAmount = isset($apply) ? $apply->total : $promotion->total;
        $issueData->Tsr = isset($apply) ? substr($apply->trade_no, 2) : substr($promotion->trade_no, 2);
        $issueData->DelayFlag = false;
        $issueData->DelayDay = 0;
        $issueData->NotifyURL = config('ecpay.AllowancReturnURL');

        $Items[0] = [
           'ItemSeq'      => '1',
           'ItemName'     => isset($apply) ? $apply->project->name : $promotion->product->paytype,
           'ItemCount'    => '1',
           'ItemWord'     => '套',
           'ItemPrice'    => isset($apply) ? $apply->total : $promotion->total,
           'ItemAmount'   => isset($apply) ? $apply->total : $promotion->total,
           'ItemTaxType'  => '1',
           'ItemRemark'   => '',
        ];

        $issueData->Items = $Items;

        return view('invoices.issues.create', compact('issueData'));
    }

}
