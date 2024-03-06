<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\ProductModel;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        $products = ProductModel::where('status', true)->get();
        $period = date('Ym');
        return view('test.index', compact('products'));
    }

    public function table(Request $request)
    {
        if (isset($request)) {
            $productId = $request->input('product_id');
        }
        if ($productId == null) {
            $productId = 1;
        }
        $inventories = Inventory::where('status', true)->where('product_id', $productId)->get();
        $product = ProductModel::find($productId);
        return view('test.table', compact('inventories'))
               ->with(compact('product'));
    }

    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $period = date('Ym');
        $product = ProductModel::find($product_id);
        return view('test.create', compact('product'))->with(compact('period'));
    }

    public function store(Request $request)
    {
        return redirect()->route('test.index');
    }

    public function show()
    {

    }

    public function edit(Inventory $inventory)
    {
        return view('test.edit', compact('inventory'));
    }

    public function update(Request $request)
    {
        return redirect()->route('test.index');
    }

    public function destroy()
    {

    }

}
