<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\NewOrder;
use App\Models\NhpProduct;
use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\MFlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class NewOrderController extends Controller
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
                  $newOrders = NewOrder::where('created_by', $user->id)->get();
              } else {
                  $newOrders = NewOrder::get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('newOrders.index', compact('newOrders'));
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

        return view('newOrders.create', compact('productModels'))
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function show(NewOrder $newOrder)
    {
        return view('newOrders.show', compact('newOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(NewOrder $newOrder)
    {
        try {
              $productModels = ProductModel::where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('newOrders.edit', compact('newOrder'))
               ->with(compact('productModels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewOrder $newOrder)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MassOrder  $massOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewOrder $newOrder)
    {
        try {
              if ($newOrder->status) {
                   $newOrder->status = false;
                   $newOrder->save();
              } else {
                   $newOrder->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('newOrders.index');
    }

}
