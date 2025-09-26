<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\HpProduct;
use App\Models\HpPromotion;
use App\Models\EcpayResult;
use App\Models\GasExport;
use App\Models\Process;
use App\Enums\UserRole;

class Promotion4Controller extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();
        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 4)->where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('promotion4.index2', compact('promotions'));
            } else {
                $promotions = HpPromotion::where('proj_id', 4)->where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('promotion4.index', compact('promotions'));
            }
        } else {
            if ($flow && $flow == 14) {
                $promotions = HpPromotion::where('proj_id', 4)->where('flow', 14)->where('status', true)->get();
                return view('promotion4.index', compact('promotions'));
            } else if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 4)->where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('promotion4.index2', compact('promotions'));
            } else {
                if ( $user->role <= UserRole::Manager ) {
                    $promotions = HpPromotion::where('proj_id', 4)->get();
                } else {
                    $promotions = HpPromotion::where('proj_id', 4)->where('status', true)->get();
                }
                return view('promotion4.index', compact('promotions'));
            }
        }
    }

    public function show(HpPromotion $promotion4)
    {
        return view('promotion4.show', compact('promotion4'));
    }

    public function edit(HpPromotion $promotion4)
    {
        try {
              $products = HpProduct::where('status', true)->get();
              $results = EcpayResult::where('trade_no', $promotion4->trade_no)->first();
              $gifts = array();
              if ($promotion4->gifts != null) {
                  $gifts = json_decode($promotion4->gifts);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('promotion4.edit', compact('promotion4'))
               ->with(compact('results'))
               ->with(compact('products'))
               ->with('gifts', $gifts);
    }

    public function update(Request $request, HpPromotion $promotion4)
    {
        $data = $request->all();
        try {
              if (isset($data['paid'])) {
                  $data['remain'] = $promotion4->total-$data['paid'];
              } else {
                  $data['remain'] = 0;
              }
              if (($data['remain'] == 0) && ($promotion4->paid > 0)) {
                 if (isset($data['product_id']) && $data['product_id'] != $promotion4->product_id) {
                     $product = HpProduct::find($data['product_id']);
                     $price = $product->price;
                     //$total = $price * $promotion->amount;
                     $data['remain'] = $promotion4->total-$promotion4->paid;
                     $promotion4->update($data);
                     return redirect()->route('promotion4.edit', compact('promotion4'));
                 }
             }
             $promotion4->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion4.edit', compact('promotion4'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('promotion4.index');
        }
        foreach($ids as $id) {
            $order_id = '94'.sprintf('%06d', $id);
            $response = $this->gasImport($order_id);
            $proms = json_decode($response, true);
            if(!isset($proms['回傳結果'])) {
                $promotion = HpPromotion::find($id);
                $promotion->flow = 10;
                $promotion->save();
                continue;
            }
            $promotion = HpPromotion::find($id);
            $bundles = $this->createBundles($promotion);
            $data = $this->createFormArray($promotion, $bundles);
            $response = $this->transfer(1, $data);
            if ($response) {
                $promotion->flow = 10;
                $promotion->save();
                try {
                    $export = GasExport::where('prom_id')->orderBy('id', 'DESC')->first();
                    $export_data = [
                          'ids'          => json_encode($ids),
                          'prom_id'      => $id,
                          'proj_id'      => 4,
                          'path'         => 'exports@promotion4Controller',
                          'ecount'       => 1,
                          'created_by'   => auth()->user()->id,
                    ];
                    GasExport::create($export_data);
                } catch(QueryException $e) {
                    $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                    return redirect()->route('promotion4.index')->with('error', $error);
                }
            }
        }

       return redirect()->route('promotion4.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $order_id = '94'.sprintf('%06d', $id);
        $response = $this->gasImport($order_id);
        $proms = json_decode($response, true);
        if(!isset($proms['回傳結果'])) {
            $promotion = HpPromotion::find($id);
            $promotion->flow = 10;
            $promotion->save();
            return redirect()->back();;
        }
        $promotion = HpPromotion::find($id);
        $bundles = $this->createBundles($promotion);
        $data = $this->createFormArray($promotion, $bundles);
        $response = $this->transfer(1, $data);
        if ($response) {
            $promotion->flow = 10;
            $promotion->save();
            try {
                $export = GasExport::where('prom_id')->orderBy('id', 'DESC')->first();
                $ids = [ '0' => $id ];
                $export_data = [
                          'ids'          => json_encode($ids),
                          'prom_id'      => $id,
                          'proj_id'      => 4,
                          'path'         => 'export@promotion4Controller',
                          'ecount'       => 1,
                          'created_by'   => auth()->user()->id,
                ];
                GasExport::create($export_data);
            } catch(QueryException $e) {
                $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                return redirect()->route('promotion4.index')->with('error', $error);
            }
        }

        return redirect()->route('promotion4.index');
    }

    public function destroy(HpPromotion $promotion4)
    {
        try {
              if ($promotion4->status == false) {
                  if ($promotion4->EcpayInfo != null) {
                      $promotion4->delete();
                  }
                  if ($promotion4->EcpayResult == null) {
                      $promotion4->delete();
                  }
              } else {
                  $promotion4->status = false;
                  $promotion4->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion4.index');
    }

    private function createBundles(HpPromotion $promotion)
    {
        $gifts = json_decode($promotion->gifts) ?? array();

        return $gifts;
    }

    private function createFormArray(HpPromotion $promotion, $bundles)
    {
        $id = '94'.sprintf('%06d', $promotion->id);
        $arrs = array(
                     '訂購日期'      => date('Y/m/d', strtotime($promotion->created_at)),
                     '姓名'          => $promotion->name,
                     '電話'          => $promotion->phone,
                     '地址'          => $promotion->address,
                     '進件單位'      => $promotion->reseller->name,
                     '備註說明'      => $promotion->memo,
                     '商品名稱'      => '商品一批',
                     '訂購數量'      => $promotion->amount,
                     '訂購方案'      => $promotion->product->paytype,
                     '收款方式'      => ($promotion->payment == 2) ? '綠界多元支付' : '其他',
                     '訂單編號'      => $id,
                     '建立人員'      => null,
                     '建立日期'      => date('Y/m/d h:i:s', strtotime($promotion->created_at)),
                     '附加商品'      => $bundles,
                 );
        return $arrs;
    }

    private function transfer($stage, $data)
    {
        $curl = curl_init();
        if ($stage == 1) {
            $url = config('gas.export_project_url');
        } else {
            $url = config('gas.export_url');
        }
        curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($data),
              CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json',
             ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }

    public function import(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $id= $req['id'];
            $orderid = '94'.sprintf('%06d', $id);
            $response = $this->gasImport($orderid);
            $proms = json_decode($response, true);
            if(!isset($proms['回傳結果'])) {
                foreach($proms as $prom) {
                    $id1 = $prom['訂單編號'];
                    $str = substr($id1, 0, 2);
                    $promotion = HpPromotion::find($id);
                    $case_name = '';
                    if ($str == '91') {
                        $case_name = '驚天一夏專案';
                    } else if ($str == '94') {
                        $case_name = '奢華享樂輕鬆付專案';
                    }
                    $flow = 10;
                    if ($prom['處理狀態'] == '已收單') {
                        $flow = 11;
                    } else if ($prom['處理狀態'] == '已取消') {
                        $flow = 15;
                    } else if ($prom['處理狀態'] == '待安排') {
                        $flow = 12;
                    } else if ($prom['處理狀態'] == '已交付') {
                        $flow = 13;
                    } else if ($prom['處理狀態'] == '已完成') {
                        $flow = 14;
                    } else {
                        $flow = 10;
                    }
                    $data = [
                      'case_name'           => $case_name,
                      'prom_id'             => $id,
                      'create_date'         => $prom['訂購日期'],
                      'name'                => $prom['姓名'],
                      'phone'               => $prom['電話'],
                      'address'             => $prom['地址'],
                      'reseller'            => $prom['進件單位'],
                      'memo'                => $prom['備註'],
                      'project'             => $prom['商品名稱'],
                      'flow'                => $flow,
                      'shipping_date'       => $prom['預計出貨日期'] ?? null,
                      'finish_date'         => $prom['安裝完成日期'] ?? null,
                    ];
                    if ($flow != 15) {
                        $promotion->flow1 = $flow;
                    }
                    if ($flow == 14) {
                        $promotion->flow = 14;
                    }
                    $promotion->save();
                    $process = Process::where('prom_id', $id)->first();
                    if ($process == null) {
                        $process = Process::create($data);
                    } else {
                        $process->update($data);
                    }
                }
            } else {
                $promotion = HpPromotion::find($id);
                $promotion->flow = 9;
                $promotion->save();
            }
        }
        return redirect()->route('promotion4.index');
    }

    public function gasImport($orderid)
    {
        $curl = curl_init();

        $url = config('gas.export_project_url').'?orderid='. $orderid;

        curl_setopt_array($curl, array(
               CURLOPT_URL => $url,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_ENCODING => "",
               CURLOPT_TIMEOUT => 30000,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_POSTFIELDS => null,
               CURLOPT_HTTPHEADER => array(
                   'Content-Type: application/json',
              ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }
}
