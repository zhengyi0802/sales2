<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sales;
use App\Models\Project;
use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\ProductModel;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == UserRole::Sales) {
            $customers = Customer::where('sales_id', $user->id)->where('status', true)->get();
        } else {
            if ($user->account == 'admin') {
                $customers = Customer::get();
            } else {
                $customers = Customer::where('status', true)->get();
            }
        }
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales = Sales::get();
        $projects = Project::get();
        $productModels = ProductModel::get();
        $extras = ProductModel::where('extra', true)->get();
        return view('customers.create', compact('sales'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
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
        $customer = Customer::where('phone', $data['phone'])->first();
        if ($customer == null) {
            $data['created_by'] = $creator->id;
            $customer = Customer::create($data);
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
            $orderdata = [
                  'id'          => $id,
                  'customer_id' => $customer->id,
                  'product_id'  => $data['product_id'],
                  'sales_id'    => $data['sales_id'],
                  'project_id'  => $data['project_id'],
                  'name'        => $data['name'],
                  'phone'       => $data['phone'],
                  'address'     => $data['address'],
                  'amount'      => 0,
                  'status'      => true,
                  'created_by'  => $creator->id,
            ];
            $order = Order::create($orderdata);
            $extras = implode(",", $extra_id);
            foreach($data['extra_id'] as $extra) {
                $orderdata['order_id'] = $extra;
                $orderdata['product_id'] = $data['extra_id'];
                OrderExtra::create($orderdata);
            }
        }
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $sales = Sales::get();
        $projects = Project::get();
        $productModels = ProductModel::get();
        $extras = ProductModel::where('extra', true)->get();

        return view('customers.edit', compact('customer'))
               ->with(compact('sales'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('extras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->all();
        $customer->update($data);

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->status = false;
        $customer->save();
        $orders = $customer->orders;
        foreach($orders as $order) {
           $order->status = false;
           $order->save();
           $extras = $order->extras;
           foreach($extras as $extra) {
               $extra->status = false;
               $extra->status = false;
           }
        }
        return redirect()->route('customers.index');
    }
}
