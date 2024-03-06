<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Models\ShippingProcess;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    //
    public function index()
    {
        $sales = Sales::where('status', true)->get();
        $productModels = ProductModel::where('status', true)->get();
        $extras = ProductModel::where('extra', true)->where('status', true)->get();
        $projects = Project::where('status', true)->get();

        return view('csvs.index')
               ->with(compact('projects'))
               ->with(compact('sales'))
               ->with(compact('productModels'))
               ->with(compact('extras'));
    }

    public function imports(Request $request)
    {
        $creator = auth()->user();
        $sdata['sales_id'] = $request->sales_id;
        $sdata['project_id'] = $request->project_id;
        $sdata['extra_id'] = $request->extra_id;
        $sdata['product_id'] = $request->product_id;
        $sdata['created_by'] = $creator->id;

        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        $keynames = array();
        $i = 0;
        foreach ($fileContents as $line) {
            $rowdata = str_getcsv($line);
            if ($i == 0) {
                $j = 0;
                foreach($rowdata as $key) {
                    if($key =='訂購日期') {
                       $keys[$j++] = 'order_date';
                    } else if ($key == '姓名') {
                       $keys[$j++] = 'name';
                    } else if ($key == '電話') {
                       $keys[$j++] = 'phone';
                    } else if ($key == '地址') {
                       $keys[$j++] = 'address';
                    } else {
                       $keys[$j++] = 'serial';
                    }
                }
                $keynames = $keys;
            } else {
                $j = 0;
                foreach($rowdata as $val) {
                   $sdata[$keynames[$j]] = $val;
                   $j++;
                }
               //
                    $customer = Customer::where('phone', $sdata['phone'])->first();
                    if ($customer == null) {
                        $customer = Customer::create($sdata);
                    }
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
                    $orderdata = [
                          'id'          => $id,
                          'customer_id' => $customer->id,
                          'product_id'  => $sdata['product_id'],
                          'sales_id'    => $sdata['sales_id'],
                          'project_id'  => $sdata['project_id'],
                          'name'        => $sdata['name'],
                          'phone'       => $sdata['phone'],
                          'address'     => $sdata['address'],
                          'order_date'  => $sdata['order_date'],
                          'amount'      => 0,
                          'status'      => true,
                          'created_by'  => $creator->id,
                    ];
                    $order = Order::create($orderdata);
/*
                    if (array_key_exists('extra_id', $sdata)) {
                        foreach($sdata['extra_id'] as $extra) {
                            if ($extra > 0) {
                                $orderdata['order_id'] = $order->id;
                                $orderdata['product_id'] = $extra;
                                $orderdata['order_date'] = $sdata['order_date'];
                                $orderdata['created_by'] = $creator->id;
                                OrderExtra::create($orderdata);
                            }
                        }
                    }
*/
                    //
            }
            $i++;
        }
        return redirect()->route('orders.index');
    }

    public function exports()
    {

    }


    public function store()
    {


    }
}
