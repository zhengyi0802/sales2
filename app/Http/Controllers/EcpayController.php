<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EApply;
use App\Models\EcpayResult;
use App\Models\EcpayInfo;
use App\Enums\UserRole;

class EcpayController extends Controller
{
    private $env = 'test';

    public function index()
    {
        $ecpayResults = EcpayResult::get();
        $ecpayInfos = EcpayInfo::where('paid', false)->get();

        return view('ecpay.index', compact('ecpayResults'))->with(compact('ecpayInfos'));
    }

}
