<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class CatagoryController extends Controller
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
            $catagories = Catagory::get();
        } else {
            $catagories = Catagory::where('status', true)->get();
        }
        return view('catagories.index', compact('catagories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->role <= UserRole::Manager) {
            return view('catagories.create');
        }
        return redirect()->route('catagories.index');
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
        $catagory = Catagory::where('name', $data['name'])->first();
        if ($catagory == null) {
            Catagory::create($data);
        }

        return redirect()->route('catagories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function show(Catagory $catagory)
    {
        return view('catagories.show', compact('catagory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catagory $catagory)
    {
        return view('catagories.edit', compact('catagory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catagory $catagory)
    {
        $data = $request->all();
        $creator = auth()->user();
        if ($creator->role <= UserRole::Manager) {
            $data['created_by'] = $creator->id;
            $catagory->update($data);
        }

        return redirect()->route('catagories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $catagory)
    {
        $catagory->status = false;
        $catagory->save();

        return redirect()->route('catagories.index');
    }
}
