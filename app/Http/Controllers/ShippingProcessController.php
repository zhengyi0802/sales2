<?php

namespace App\Http\Controllers;

use App\Models\ShippingProcess;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\FlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ShippingProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        try {
              if ($user->role == UserRole::Sales || $user->role == UserRole::Reseller) {
                  $orders = Order::select('id')->where('sales_id', $user->sales->id)->where('status', true)->get();
                  $orders_array = $orders->toArray();
                  $shippings = ShippingProcess::whereIn('order_id', $orders_array)->get();
              } else {
                  $shippings = ShippingProcess::get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('shippings.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingProcess  $shippingProcess
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingProcess $shipping)
    {
        $qrdata = "https://sales2.mdo.tw/warranties/register?order_id=".$shipping->order->id;
        $qrdata .= "&phone=".$shipping->order->phone."&product_id=".$shipping->order->product_id;

        return view('shippings.show', compact('shipping'))->with(compact('qrdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingProcess  $shippingProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingProcess $shipping)
    {
        try {
              $installers = User::where('role', UserRole::Installer)->where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('shippings.edit', compact('shipping'))->with(compact('installers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingProcess  $shippingProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingProcess $shipping)
    {
        $user = auth()->user();
        $data = $request->all();
        try {
              if ($user->role == UserRole::Installer) {
                  if ($data['flow'] == FlowStatus::Completion) {
                      $data['coompletion_time'] = date('Y-M-D h:m:s');
                      //$data['installer_id'] = $user->id;
                  }
              }
              $shipping->update($data);
              $order = $shipping->order;
              $order->flow = $data['flow'];
              $order->save();
              $extras = $shipping->order->extras->toArray();
              for($i=0; $i<count($extras); $i++) {
                  $extra = $shipping->order->extras[$i];
                  if (isset($data['includes'][$i])) {
                      $extra->flow = FlowStatus::Shipping;
                  } else {
                      $extra->flow = FlowStatus::UnHandled;
                  }
                  $extra->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('shippings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingProcess  $shippingProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingProcess $shipping)
    {
        try {
              $shipping->delete();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('shippings.index');
    }
}
