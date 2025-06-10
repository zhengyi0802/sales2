<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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
        if (true) {
            $user = auth()->user();

            try {
                  if ($user->role == UserRole::Administrator) {
                      $catagories = Catagory::get();
                  } else {
                      $catagories = Catagory::where('status', true)->get();
                  }
            } catch (QueryException $e) {
                  return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
            } catch (Exception $e) {
                  return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
            }

            return view('catagories.index', compact('catagories'));
       } else {
            return view('catagories.index2');
       }
    }

    public function query()
    {
        try {
              $catagories = Catagory::select('id', 'name')->where('status', true)->get()->toJson();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return response($catagories, 200)->header('Content-Type', 'text/json');
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
        try {
              $catagory = Catagory::where('name', $data['name'])->first();
              if ($catagory == null) {
                  $catagory = Catagory::create($data);
              } else {
                  $error = '產品類別已存在';
                  return redirect()->route('catagories.index')->with('error', $error);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
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
        try {
              if ($creator->role <= UserRole::Manager) {
                  $data['created_by'] = $creator->id;
                  $catagory->update($data);
              } else {
                  $error = '更新產品類別錯誤';
                  return redirect()->route('catagories.index')->with('error', $error);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
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
        try {
              if ($catagory->status) {
                  $catagory->status = false;
                  $catagory->save();
              } else if (auth()->user()->role <= UserRole::Manager) {
                  $catagory->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('catagories.index');
    }
}
