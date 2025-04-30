<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sales;
use App\Models\Project;
use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\ECustomer;
use App\Models\EOrder;
use App\Models\EOrderExtra;
use App\Models\ProductModel;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class CheckOrderController extends Controller
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
            $customers = ECustomer::where('sales_id', $user->sales->id)->where('status', true)->get();
        } else if ($user->role == UserRole::Reseller) {
            $customers = ECustomer::where('sales_id', $user->sales->id)->where('status', true)->get();
        } else if ($user->role == UserRole::Administrator) {
            $customers = ECustomer::get();
        } else {
            $customers = ECustomer::where('status', true)->get();
        }
        return view('checkOrders.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
                  'payment'     => $data['payment'],
                  'memo'        => $data['memo'],
                  'status'      => true,
                  'created_by'  => $creator->id,
            ];
            $order = Order::create($orderdata);
            if (array_key_exists('extra_id', $data)) {
                foreach($data['extra_id'] as $extra) {
                    if ($extra > 0) {
                        $orderdata['order_id'] = $order->id;
                        $orderdata['product_id'] = $extra;
                        $orderdata['created_by'] = $creator->id;
                        OrderExtra::create($orderdata);
                    }
                }
            }
            $eid = $data['eid'];
            $ecustomer = ECustomer::find($eid);
            $ecustomer->delete();
            $eorder= EOrder::where('customer_id', $eid)->first();
            $order_id = $eorder->id;
            $eorder->delete();
            $eextras = EOrderExtra::where('order_id', $order_id)->get();
            foreach($eextras as $eextra) {
                    $eextra->delete();
            }
        } else {
            return redirect()->route('customers.index')
                             ->with('insert-error', 'Customer exists');
        }
        return redirect()->route('customers.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(ECustomer $customer)
    {
        $creator = auth()->user();
        if ($creator->role == UserRole::Reseller) {
            $sales = Sales::where('user_id', $creator->id)->get();
        } else {
            $sales = Sales::where('status', true)->get();
        }
        $projects = Project::get();
        $productModels = ProductModel::get();
        $extras = ProductModel::where('extra', true)->get();
        $Extras2 = $customer->order->extras;
        if ($Extras2 != null) {
            $extras2 = $Extras2->pluck('product_id')->toArray();
        } else {
            $extras2 = array();
        }
        return view('checkOrders.edit', compact('customer'))
               ->with(compact('sales'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('extras'))
               ->with(compact('extras2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ECustomer $customer)
    {
        $data = $request->all();
        $customer->update($data);

        return redirect()->route('checkOrders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ECustomer $customer)
    {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator) {
            $eid = $customer->id;
            $customer->delete();
            $eorder= EOrder::where('customer_id', $eid)->first();
            $order_id = $eorder->id;
            $eorder->delete();
            $eextras = EOrderExtra::where('order_id', $order_id)->get();
            foreach($eextras as $eextra) {
                $eextra->delete();
            }
        } else {
            $eid = $customer->id;
            $customer->status = false;
            $customer->save();
            $eorder = $customer->order;
            $eorder->status = false;
            $eorder->save();
            $eextras = $eorder->extras;
            foreach($eextras as $eextra) {
                 $eextra->status = false;
                 $eextra->save();
            }
        }
        return redirect()->route('checkOrders.index');
    }
}
