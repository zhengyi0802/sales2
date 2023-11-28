<?php

namespace App\Http\Controllers;

use App\Models\ShippingProcess;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

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

        if ($user->role == UserRole::Sales || $user->role == UserRole::Reseller) {
            $orders = Order::select('id')->where('sales_id', $user->sales->id)->where('status', true)->get();
            $orders_array = $orders->toArray();
            $shippings = ShippingProcess::whereIn('order_id', $orders_array)->get();
        } else {
            $shippings = ShippingProcess::get();
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
        return view('shippings.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingProcess  $shippingProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingProcess $shipping)
    {
        return view('shippings.edit', compact('shipping'));
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
        $data = $request->all();
        $shipping->update($data);

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
        $shipping->delete();

        return redirect()->route('shippings.index');
    }
}
