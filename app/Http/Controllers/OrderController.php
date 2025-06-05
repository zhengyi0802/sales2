<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Models\User;
use App\Models\ShippingProcess;
use App\Enums\UserRole;
use App\Enums\FlowStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        if (isset($data['flow'])) {
            $flow = $data['flow'];
        } else {
            $flow = 0;
        }
        if ($user->role == UserRole::Administrator) {
            if ($flow > 0) {
                $orders = Order::where('flow', $flow)->get();
            } else {
                $orders = Order::where('flow', '<', 5)->get();
            }
        } else if ($user->role == UserRole::Reseller) {
           if ($flow > 0) {
               $orders = Order::where('sales_id', $user->sales->id)->where('flow', $flow)->get();
           } else {
               $orders = Order::where('flow', '<', 5)->where('sales_id', $user->sales->id)->get();
           }
        } else if ($user->role == UserRole::Sales) {
           if ($flow > 0) {
               $orders = Order::where('sales_id', $user->sales->id)->where('flow', $flow)->get();
           } else {
               $orders = Order::where('flow', '<', 5)->where('sales_id', $user->sales->id)->get();
           }
        } else if ($user->role == UserRole::Installer) {
            if ($flow > 0) {
                $orders = Order::where('status', true)->where('flow', $flow)->get();
            } else {
                $orders = Order::where('status', true)
                               ->where('flow', '>', 2)
                               ->where('flow', '<', 8)->get();
            }
        } else {
            if ($flow > 0) {
                $orders = Order::where('status', true)->where('flow', $flow)->get();
            } else {
                $orders = Order::where('flow', '<', 5)->where('status', true)->get();
            }
        }
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Customer $customer)
    {
        $creator = auth()->user();
        try {
              if ($creator->role == UserRole::Reseller) {
                  $sales = Sales::where('user_id', $creator->id)->get();
                  $projects = Project::where('salesing', true)->where('status', true)->get();
                  $productModels = ProductModel::where('catagory_id', 9)->where('status', true)->get();
              } else {
                  $sales = Sales::where('status', true)->get();
                  $projects = Project::where('status', true)->get();
                  $productModels = ProductModel::where('status', true)->get();
              }
              $installers = User::where('role', UserRole::Installer)->get();
              $extras = ProductModel::where('extra', true)->where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('orders.create2')
               ->with(compact('sales'))
               ->with(compact('installers'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('customer'))
               ->with(compact('extras'));
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
              $data['created_by'] = $creator->id;
              $order_latest = Order::orderBy('id', 'desc')->get()->first();
              if ($order_latest == null) {
                  $orderlatest = 0;
              } else {
                  $orderlatest = $order_latest->id;
              }
              $idinit = ((now()->year-2000)*100+(now()->month))*10000+1;
              if ($idinit <= $orderlatest) {
                  $id = $orderlatest+1;
              } else {
                  $id = $idinit;
              }
              $data['id'] = $id;
              if ( !isset($data['order_date']) || ($data['order_date'] == null) ) {
                  $data['order_date'] = date('Y-m-d');
              }
              $order = Order::create($data);
              if (array_key_exists('extra_id', $data)) {
                  foreach($data['extra_id'] as $extra) {
                      if ($extra > 0) {
                          $orderdata['order_id'] = $order->id;
                          $orderdata['product_id'] = $extra;
                          $orderdata['created_by'] = $creator->id;
                          OrderExtra::create($orderdata);
                      }
                  }
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $creator = auth()->user();
        try {
              if ($creator->role == UserRole::Reseller) {
                  $sales = Sales::where('user_id', $creator->id)->get();
                  $projects = Project::where('salesing', true)->where('status', true)->get();
                  $productModels = ProductModel::where('catagory_id', 9)->where('status', true)->get();
              } else {
                  $sales = Sales::where('status', true)->get();
                  $projects = Project::where('status', true)->get();
                  $productModels = ProductModel::where('status', true)->get();
              }
              $extras = ProductModel::where('extra', true)->where('status', true)->get();
              $gifts = $order->extras->pluck('product_id')->toArray();
              $installers = User::where('role', UserRole::Installer)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('orders.edit', compact('order'))
               ->with(compact('sales'))
               ->with(compact('installers'))
               ->with(compact('projects'))
               ->with(compact('productModels'))
               ->with(compact('gifts'))
               ->with(compact('extras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $creator = auth()->user();
        $data = $request->all();
        try {
              $order->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        if (!isset($data['flow'])) {
            $data['flow'] = $order->flow;
        }
        switch($data['flow']) {
            case FlowStatus::Confirmed :
                     $shippingProcess = ShippingProcess::where('order_id', $order->id)->first();
                     if ($shippingProcess == null) {
                         $spdata = [ 'order_id' => $order->id,
                                     'shipping_date' => $data['shipping_date'],
                                     'created_by' => $creator->id,
                                     'installer_id' => $data['installer_id'], ];
                         try {
                               ShippingProcess::create($spdata);
                         } catch (QueryException $e) {
                               return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                               return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     } else {
                         $spdata['shipping_date'] = $data['shipping_date'];
                         $spdata['created_by'] = $creator->id;
                         $spdata['installer_id'] = $data['installer_id'];
                         try {
                                $shippingProcess->update($spdata);
                         } catch (QueryException $e) {
                                return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                                return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     }
                     break;
            case FlowStatus::Shipping :
                     $shippingProcess = ShippingProcess::where('order_id', $order->id)->first();
                     if ($data['shipping_date'] == null) {
                         $data['shipping_date'] = date('Y-m-d', strtotime('+3 days'));
                         //$order->shipping_date = $data['shipping_date'];
                         //$order->save();
                     }
                     if ($shippingProcess == null) {
                         $spdata = [ 'order_id' => $order->id,
                                     'shipping_date' => $data['shipping_date'],
                                     'created_by' => $creator->id,
                                     'installer_id' => $data['installer_id'], ];
                         try {
                               ShippingProcess::create($spdata);
                         } catch (QueryException $e) {
                               return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                               return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     } else {
                         $spdata['shipping_date'] = $data['shipping_date'];
                         $spdata['created_by'] = $creator->id;
                         $spdata['installer_id'] = $data['installer_id'];
                         try {
                               $shippingProcess->update($spdata);
                         } catch (QueryException $e) {
                               return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                               return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     }
                     break;
            case FlowStatus::ChargeBack :
                     $shippingProcess = ShippingProcess::where('order_id', $order->id)->first();
                     if ($shippingProcess == null) {
                         $spdata = [ 'order_id' => $order->id,
                                     'chargeback_time' => date('Y-m-d H:i:s'),
                                     'created_by' => $creator->id,
                                     'installer_id' => $data['installer_id'], ];
                         try {
                                 ShippingProcess::create($spdata);
                         } catch (QueryException $e) {
                                 return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                                return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     } else {
                         $spdata['chargeback_date'] = date('Y-m-d H:i:s');
                         $spdata['created_by'] = $creator->id;
                         try {
                               $shippingProcess->update($spdata);
                         } catch (QueryException $e) {
                               return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
                         } catch (Exception $e) {
                               return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
                         }
                     }
                     break;
        }
        $extras = $order->extras;
        foreach($extras as $extra) {
            $extra->delete();
        }
        if ($data['flow'] == 6) {
            return redirect()->route('orders.index');
        }
        if (array_key_exists('extra_id', $data)) {
            foreach($data['extra_id'] as $extra) {
                if ($extra > 0) {
                    $orderdata['order_id'] = $order->id;
                    $orderdata['product_id'] = $extra;
                    $orderdata['created_by'] = $creator->id;
                    OrderExtra::create($orderdata);
                }
            }
        }

       return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
              $order->status = false;
              $order->save();

              $orderextras = $order->extras;
              foreach($orderextras as $extra) {
                   $extra->status = false;
                   $extra->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('orders.index');
    }

    public function shipment(Order $order)
    {
        $user = auth()->user();
        if ($user->id == 1) {
            $pdf = PDF::loadView('shippings.shipment', compact('order'));
            $pdf_file = 'shipment-'.$order->id.'.pdf';
            return $pdf->download($pdf_file);
        }
        $qrdata = "https://sales2.mdo.tw/warranties/register?order_id=".$order->id;
        $qrdata .= "&phone=".$order->phone."&product_id=".$order->product_id;

        return view('shippings.shipment', compact('order'))->with(compact('qrdata'));
    }
}
