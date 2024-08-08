<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();

        if ($user->role == UserRole::Administrator) {
            $vendors = Vendor::get();
        } else {
            $vendors = Vendor::where('status', true)->get();
        }

        return view('vendors.index', compact('vendors'));
    }

    public function query()
    {
        $vendors = Vendor::select('id', 'company', 'country')->where('status', true)->get();

        return response($vendors, 200)->header('Content-Type', 'text/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
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
        $vendor = Vendor::where('company', $data['company'])->first();
        if ($vendor == null) {
            Vendor::create($data);
        }

        return redirect()->route('vendors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->all();
        $creator = auth()->user();
        if ($creator->role <= UserRole::Manager) {
            $data['created_by'] = $creator->id;
            $vendor->update($data);
        }

        return redirect()->route('vendors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->status = false;
        $vendor->save();

        return redirect()->route('vendors.index');
    }
}
