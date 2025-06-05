<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\EApply;
use App\Models\EcpayResult;
use App\Models\EcpayInfo;
use App\Enums\UserRole;

class EcpayController extends Controller
{
    public function index()
    {
        try {
              $ecpayResults = EcpayResult::get();
              $ecpayInfos = EcpayInfo::where('paid', false)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('ecpay.index', compact('ecpayResults'))->with(compact('ecpayInfos'));
    }

}
