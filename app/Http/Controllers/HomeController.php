<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Enums\UserRole;
use App\Enums\FlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        try {
            switch($user->role){
                 case UserRole::Administrator:
                      $unhandled = Order::where('status', true)->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = Order::where('status',false)->count();
                      break;
                case UserRole::CEO:
                case UserRole::Manager:
                      $unhandled = Order::where('status', true)->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = 0;
                      break;
                case UserRole::Sales:
                      $unhandled = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = 0;
                      break;
                case UserRole::Reseller:
                      $unhandled = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Completion)->count();
                      $chargebacks = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::ChargeBack)->count();
                      $finished = Order::where('status', true)->where('sales_id', $user->sales->id)
                                   ->where('flow', FlowStatus::Finished)->count();
                      $disabled = 0;
                      break;
                 case UserRole::Operator:
                 case UserRole::Stocker:
                      $unhandled = Order::where('status', true)->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = 0;
                      break;
                 case UserRole::Installer:
                      $unhandled = 0;
                      $contacted = 0;
                      $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = 0;
                      break;
                 case UserRole::Accounter:
                      $unhandled = 0;
                      $contacted = 0;
                      $confirmed = 0;
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = 0;
                      break;
                 case UserRole::ShareHolder:
                      $unhandled = Order::where('status', true)->where('flow', FlowStatus::UnHandled)->count();
                      $contacted = Order::where('status', true)->where('flow', FlowStatus::Contacted)->count();
                      $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                      $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                      $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                      $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                      $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                      $disabled = Order::where('status',false)->count();
                      break;
                 case UserRole::CSR:
                 $unhandled = Order::where('status', true)->where('flow', FlowStatus::UnHandled)->count();
                 $contacted = Order::where('status', true)->where('flow', FlowStatus::Contacted)->count();
                 $confirmed = Order::where('status', true)->where('flow', FlowStatus::Confirmed)->count();
                 $shippings = Order::where('status', true)->where('flow', FlowStatus::Shipping)->count();
                 $completions = Order::where('status', true)->where('flow', FlowStatus::Completion)->count();
                 $finished = Order::where('status', true)->where('flow', FlowStatus::Finished)->count();
                 $chargebacks = Order::where('status', true)->where('flow', FlowStatus::ChargeBack)->count();
                 $disabled = Order::where('status',false)->count();
                 break;
            }
            $data = [
                'unhandled'    => $unhandled,
                'contacted'    => $contacted,
                'confirmed'    => $confirmed,
                'shippings'    => $shippings,
                'completions'  => $completions,
                'finished'     => $finished,
                'chargebacks'  => $chargebacks,
                'disabled'     => $disabled,
            ];
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('home', compact('data'));
    }
}
