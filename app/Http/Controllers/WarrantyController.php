<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use App\Models\Order;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::get();

        return view('warranties.index', compact('warranties'));
    }

    public function create()
    {
        return redirect()->route('warranties.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('warranties.index');
    }

    public function show(Warranty $warranty)
    {
        return view('warranties.show', compact('warranty'));
    }

    public function edit(Warranty $warranty)
    {
        return redirect()->route('warranties.index');
    }

    public function update(Request $request, Warranty $warranty)
    {
        return redirect()->route('warranties.index');
    }

    public function destroy(Warranty $warranty)
    {
        return redirect()->route('warranties.index');
    }

}
