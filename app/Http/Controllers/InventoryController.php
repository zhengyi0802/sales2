<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\ProductModel;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
              $products = ProductModel::where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        $period = date('Ym');
        return view('inventories.index', compact('products'));
    }

    public function table(Request $request)
    {
        if (isset($request)) {
            $productId = $request->input('product_id');
        }
        if ($productId == null) {
            $productId = 1;
        }
        try {
              $inventories = Inventory::where('status', true)->where('product_id', $productId)->get();
              $product = ProductModel::find($productId);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('inventories.table', compact('inventories'))
               ->with(compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $period = date('Ym');
        try {
              $product = ProductModel::find($product_id);
              $inventory = Inventory::where('product_id', $product_id)->where('serial', $period)->first();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        if ($inventory == null) {
            return view('inventories.create', compact('product'))->with(compact('period'));
        } else {
            return view('inventories.edit', compact('inventory'));
        }
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
        try {
              $data['created_by'] = $creator->id;
              $product_id = $data['product_id'];
              $last = Inventory::where('product_id', $data['product_id'])->latest()->first();
              if ($last == null) {
                  $last_amount = 0;
              } else {
                  $last_amount = $last->stock;
              }
              $data['start_amount'] = $last_amount;
              $data['stock'] = $last_amount + $data['inbound'] - $data['outbound']-$data['defective'];
              Inventory::create($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('inventories.table', ['product_id' => $product_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $creator = auth()->user();
        $data = $request->all();
        try {
              $data['stock'] = $inventory->start_amount+$data['inbound']-$data['outbound']-$data['defective'];
              $inventory->update($data);
              $serial = $inventory->serial;
              $stock = $data['stock'];
              $product_id = $inventory->product_id;
              $inventories = Inventory::where('product_id', $product_id)
                                      ->where('serial', '>', $serial)
                                      ->orderBy('serial', 'ASC')
                                      ->get();
              foreach($inventories as $inven) {
                  $inven->start_amount = $stock;
                  $stock = $inven->start_amount + $inven->inbound - $inven->outbound - $inven->defective;
                  $inven->stock = $stock;
                  $inven->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('inventories.table', ['product_id' => $product_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        try {
              $inventory->status = false;
              $inventory->save();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('inventories.index');
    }
}
