<?php

namespace App\Http\Controllers;

use App\Models\MassOrder;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\MFlowStatus;
use Illuminate\Http\Request;

class MassOrderController extends Controller
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
            $massOrders = MassOrder::where('created_by', $user->id)->get();
        } else {
            $massOrders = MassOrder::get();
        }

        return view('massOrders.index', compact('massOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales = Sales::where('status', true)->get();
        $productModels = ProductModel::where('status', true)->get();

        return view('massOrders.create', compact('productModels'))
               ->with(compact('sales'));
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
        $items = $data['products'];
        $titems = array();
        foreach($items as $item) {
           $model = substr($item["'product'"], strpos($item["'product'"], "(")+1);
           $model = substr($model, 0, strlen($model)-1);
           $product = ProductModel::where('model', $model)->first();
           $aitem = [
               'product_id'    => $product->id,
               'amount'        => $item["'amount'"],
               'single_price'  => 0,
               'total_price'   => 0,
           ];
           array_push($titems, $aitem);
        }
        $pitems = json_encode($titems);
        $data['products'] = $pitems;
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $data['mark'] = 1;
        $data['flow'] = 1;
        $data['price'] = 0;
        $data['tax'] = 0;
        $data['total'] = 0;
        $data['memo'] = null;
        MassOrder::create($data);

        return redirect()->route('massOrders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function show(MassOrder $massOrder)
    {
        return view('massOrders.show', compact('massOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(MassOrder $massOrder)
    {
        $productModels = ProductModel::where('status', true)->get();
        $sales == Sales::where('status', true)->get();

        return view('massOrders.index', compact('massOrder'))
               ->with(compact('productModels'))
               ->with(compact('sales'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MassOrder $massOrder)
    {
        return redirect()->route('massOrders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MassOrder $massOrder)
    {
        $massOrder->status = false;
        $massOrder->save();

        return redirect()->route('massOrders.index');
    }
}
