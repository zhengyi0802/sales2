<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\Vendor;
use App\Models\Catagory;
use App\Models\Currency;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductModelController extends Controller
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
              if ($user->role == UserRole::Administrator) {
                  $productModels = ProductModel::get();
              } else {
                  $productModels = ProductModel::where('status', true)->get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('productModels.index', compact('productModels'));
    }

    public function query()
    {
        $productmodels = ProductModel::where('status', true)->get();

        $products = array();
        foreach($productmodels as $pm) {
          $vendor = $pm->vendor;
          $catagory = $pm->catagory;
          $currency = $pm->currency;
          $product = array(
                              'id'         => $pm->id,
                              'name'       => $pm->name,
                              'model'      => $pm->model,
                              'catagory'   => $catagory->name,
                              'vendor'     => $vendor->company,
                              'from'       => $vendor->country,
                              'currency'   => $currency->currency_name,
                              'rate'       => $currency->currency_rate,
                              'cost'       => $pm->purchase_cost,
                     );
          array_push($products, $product);
        }
        return response(json_encode($products))->header('Content-Type', 'text/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productModels.create');
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
        $productModel = ProductModel::where('name', $data['name'])->orWhere('model', $data['model'])->first();
        if ($productModel == null) {
            $data['created_by'] = $creator->id;
            $data['briefs'] = json_encode($data['briefs']);
            $data['specifications'] = json_encode($data['specifications']);
            if ($data['accessories'] == null) {
                $data['accessories'] = 0;
            }
            if (!isset($data['extra'])) {
                $data['extra'] = false;
            }
            if (!isset($data['status'])) {
                $data['status'] = false;
            }

            ProductModel::create($data);
        }
        return redirect()->route('productModels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        return view('productModels.show', compact('productModel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $productModel)
    {
        try {
              $catagories = Catagory::get();
              $vendors = Vendor::get();
              $accessories = ProductModel::where('is_accessories', true)->get();
              $currencies = Currency::get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('productModels.edit', compact('productModel'))
               ->with(compact('currencies'))
               ->with(compact('vendors'))
               ->with(compact('catagories'))
               ->with(compact('accessories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductModel $productModel)
    {
        $creator = auth()->user();
        try {
              $data = $request->all();
              $data['briefs'] = json_encode($data['briefs']);
              $data['specificatopms'] = json_encode($data['specifications']);
              $data['created_by'] = $creator->id;
              if ($data['accessories'] == null) {
                  $data['accessories'] = 0;
              }
              if (!isset($data['is_accessories'])) {
                  $data['is_accessories'] = false;
              }
              if (!isset($data['extra'])) {
                  $data['extra'] = false;
              }
              if (!isset($data['status'])) {
                  $data['status'] = false;
              }
              $productModel->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('productModels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $productModel)
    {
        try {
              if ($productModel->status) {
                  $productModel->status = false;
                  $productModel->save();
              } else {
                  $productModel->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('productModels.index');
    }
}
