<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\EApply;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        $eapplies = EApply::where('flow', 9)->get();
        return view('tests.index', compact('eapplies'));
    }

    public function table(Request $request)
    {
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
    }

    public function show()
    {

    }

    public function edit(Inventory $inventory)
    {
    }

    public function update(Request $request)
    {
    }

    public function destroy()
    {

    }

}
