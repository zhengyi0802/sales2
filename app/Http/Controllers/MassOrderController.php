<?php

namespace App\Http\Controllers;

use App\Models\MassOrder;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\MFlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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
        try {
              if ($user->role == UserRole::Sales || $user->role == UserRole::Reseller) {
                  $massOrders = MassOrder::where('created_by', $user->id)->get();
              } else {
                  $massOrders = MassOrder::get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
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
        try {
              $sales = Sales::where('status', true)->get();
              $productModels = ProductModel::where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

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
           //dd($model);
           $product = ProductModel::where('model', $model)->first();
           $aitem = [
               'product_id'    => $product->id,
               'amount'        => $item["'amount'"],
               'single_price'  => 0,
               'price'         => 0,
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

        $order_latest = MassOrder::orderBy('id', 'desc')->get()->first();
        if ($order_latest == null) {
            $orderlatest = 0;
        } else {
            $orderlatest = $order_latest->id;
        }
        $idinit = ((now()->year-2000)*100+(now()->month))*1000+1;
        if ($idinit <= $orderlatest) {
            $id = $orderlatest+1;
        } else {
            $id = $idinit;
        }
        $data['id'] = $id;
        try {
              MassOrder::create($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

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
        try {
              $productModels = ProductModel::where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('massOrders.edit', compact('massOrder'))
               ->with(compact('productModels'));
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
        $data = $request->all();
        try {
              $products = $data['products'];
              $price = 0;
              for($i=0; $i<sizeof($products); $i++) {
                      $products[$i]["price"] = $products[$i]["amount"] * $products[$i]["single_price"];
                      $price += $products[$i]["price"];
              }
              $tax = $price * 0.05;
              $total = $price * 1.05;
              $data['products'] = json_encode($products);
              $data['price'] = $price;
              $data['tax'] = $tax;
              $data['total'] = $total;
              $massOrder->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

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
        try {
              if ($massOrder->status) {
                   $massOrder->status = false;
                   $massOrder->save();
              } else {
                   $massOrder->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('massOrders.index');
    }

    public function shipment(MassOrder $massOrder)
    {
        return view('massOrders.shipment', compact('massOrder'));
    }

}
