<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator) {
            $orders = Order::get();
        } else if ($user->role == UserRole::Reseller) {
            $orders = Order::where('sales_id', $user->sales->id)->get();
        } else if ($user->role == UserRole::Sales) {
            $orders = Order::where('sales_id', $user->sales->id)->get();
        } else {
            $orders = Order::where('status', true)->get();
        }
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Customer $customer)
    {
        $sales = Sales::where('status', true)->get();
        $projects = Project::where('status', true)->get();
        $productModels = ProductModel::where('status', true)->get();
        $extras = ProductModel::where('extra', true)->where('status', true)->get();

        return view('orders.create2')
               ->with(compact('sales'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('customer'))
               ->with(compact('extras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $order_latest = Order::orderBy('id', 'desc')->get()->first();
        if ($order_latest == null) {
            $orderlatest = 0;
        } else {
            $orderlatest = $order_latest->id;
        }
        $idinit = ((now()->year-2000)*100+(now()->month))*10000+1;
        if ($idinit <= $orderlatest) {
            $id = $orderlatest+1;
        } else {
            $id = $idinit;
        }
        $data['id'] = $id;
        $order = Order::create($data);
        if (array_key_exists('extra_id', $data)) {
            foreach($data['extra_id'] as $extra) {
                $orderdata['order_id'] = $order->id;
                $orderdata['product_id'] = $extra;
                $orderdata['created_by'] = $creator->id;
                OrderExtra::create($orderdata);
            }
        }
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $productModels = ProductModel::where('status', true)->get();
        $projects = Project::where('status', true)->get();
        $extras = ProductModel::where('status', true)->where('extra', true)->get();
        $sales = Sales::where('status', true)->get();

        return view('orders.edit', compact('order'))
               ->with(compact('sales'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('extras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $creator = auth()->user();
        $data = $request->all();
        $order->update($data);
        $extras = $order->extras;
        foreach($extras as $extra) {
            $extra->delete();
        }
        if (array_key_exists('extra_id', $data)) {
            foreach($data['extra_id'] as $extra) {
                $orderdata['order_id'] = $order->id;
                $orderdata['product_id'] = $extra;
                $orderdata['created_by'] = $creator->id;
                OrderExtra::create($orderdata);
            }
        }

       return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->status = false;
        $order->save();

        $orderextras = $order->extras;
        foreach($orderextras as $extra) {
            $extra->status = false;
            $extra->save();
        }
        return redirect()->route('orders.index');
    }
}
