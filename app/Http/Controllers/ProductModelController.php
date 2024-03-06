<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\Vendor;
use App\Models\Catagory;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

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

        if ($user->role == UserRole::Administrator) {
            $productModels = ProductModel::get();
        } else {
            $productModels = ProductModel::where('status', true)->get();
        }

        return view('productModels.index', compact('productModels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::get();
        $catagories = Catagory::get();
        $accessories = ProductModel::where('is_accessories', true)->get();

        return view('productModels.create')
               ->with(compact('vendors'))
               ->with(compact('catagories'))
               ->with(compact('accessories'));
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
        $catagories = Catagory::get();
        $vendors = Vendor::get();
        $accessories = ProductModel::where('is_accessories', true)->get();

        return view('productModels.edit', compact('productModel'))
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
        $data = $request->all();
        $data['briefs'] = json_encode($data['briefs']);
        $data['specificatopms'] = json_encode($data['specifications']);
        $data['created_by'] = $creator->id;
        if ($data['accessories'] == null) {
            $data['accessories'] = 0;
        }
        $productModel->update($data);

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
        $productModel->status = false;
        $productModel->save();

        return redirect()->route('productModels.index');
    }
}
