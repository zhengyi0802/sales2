<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuninare\Database\QueryException;

class SalesController extends Controller
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
        try {
              if ($user->role == UserRole::Administrator) {
                  $saleses = Sales::get();
              } else {
                  $saleses = Sales::where('status', true)->get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('sales.index', compact('saleses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uppers = User::where('role', UserRole::Reseller)
                      ->orWhere('role', UserRole::Sales)
                      ->orWhere('id', 104)
                      ->orWhere('id', 110)
                      ->where('status', true)
                      ->get();

        return view('sales.create', compact('uppers'));
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
              $user = User::where('account', $data['account'])->first();
              if ($user != null) {
                  return redirect()->back();
              } else {
                  $data1['name'] = $data['name'];
                  $data1['account'] = $data['account'];
                  $data1['password'] = bcrypt($data['password']);
                  $data1['phone'] = $data['phone'];
                  $data1['line_id'] = $data['line_id'];
                  $data1['email'] = $data['email'];
                  $data1['address'] = $data['address'];
                  if (array_key_exists('reseller', $data)) {
                      $data1['role'] = UserRole::Reseller;
                  } else {
                      $data1['role'] = UserRole::Sales;
                  }

                  $data1['status'] = true;
                  $data1['created_by'] = $creator->id;
                  $user = User::create($data1);
                  $data['user_id'] = $user->id;
                  $data['created_by'] = $creator->id;
                  Sales::create($data);
             }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        return view('sales.show', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        $uppers = User::where('role', UserRole::Reseller)
                      ->orWhere('role', UserRole::Sales)
                      ->orWhere('id', 104)
                      ->orWhere('id', 110)
                      ->where('status', true)
                      ->get();
        return view('sales.edit', compact('sales'))->with(compact('uppers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        $data = $request->all();
        try {
              $user = $sales->user;
              $userdata['phone'] = $data['phone'];
              $userdata['line_id'] = $data['line_id'];
              $userdata['email'] = $data['email'];
              $userdata['address'] = $data['address'];
              if (array_key_exists('reseller', $data)) {
                  $userdata['role'] = UserRole::Reseller;
              } else {
                  $userdata['role'] = UserRole::Sales;
              }
              if ($data['password'] != null) {
                  $userdata['password'] = bcrypt($data['password']);
              }
              $user->update($userdata);
              $sales->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        try {
              if ($sales->status) {
                  $sales->status = false;
                  $sales->save();
              } else if (auth()->user()->role <= UserRole::Administrator) {
                  $sales->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('sales.index');
    }
}
