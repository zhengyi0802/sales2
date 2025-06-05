<?php

namespace App\Http\Controllers;

use App\Models\EWarranty;
use App\Models\Warranty;
use App\Models\Order;
use App\Enums\FlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class WarrantyController extends Controller
{
    public function index()
    {
        try {
              $warranties = Warranty::get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

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

    public function register(Request $request)
    {
        $data = $request->all();
        try {
              $data['register_time'] = date('Y-m-d h:i:s');
              $data['warranty_date'] = date('Y-m-d', strtotime('+2 years'));
              $warranty = Warranty::where('order_id', $data['order_id'])->first();
              if ($warranty == null) {
                  $warranty = Warranty::create($data);
              }
              $order = $warranty->order;
              $order->flow = FlowStatus::Completion;
              $order->save();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('warranties.show', compact('warranty'));
    }
}
