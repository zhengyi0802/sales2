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

class Promotion5Controller extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();
        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 5)->where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('promotion5.index2', compact('promotions'));
            } else {
                $promotions = HpPromotion::where('proj_id', 5)->where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('promotion5.index', compact('promotions'));
            }
        } else {
            if ($flow && $flow == 14) {
                $promotions = HpPromotion::where('proj_id', 5)->where('flow', 14)->where('status', true)->get();
                return view('promotion5.index', compact('promotions'));
            } else if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 5)->where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('promotion5.index2', compact('promotions'));
            } else {
                if ( $user->role <= UserRole::Manager ) {
                    $promotions = HpPromotion::where('proj_id', 5)->get();
                } else {
                    $promotions = HpPromotion::where('proj_id', 5)->where('status', true)->get();
                }
                return view('promotion5.index', compact('promotions'));
            }
        }
    }

    public function show(HpPromotion $promotion5)
    {
        return view('promotion5.show', compact('promotion5'));
    }

    public function edit(HpPromotion $promotion5)
    {
        try {
              $products = HpProduct::where('status', true)->get();
              $results = EcpayResult::where('trade_no', $promotion5->trade_no)->first();
              $gifts = array();
              if ($promotion5->gifts != null) {
                  $gifts = json_decode($promotion5->gifts);
              }
              $bundles = array();
              if ($promotion5->bundles != null) {
                  $bundles = json_decode($promotion5->bundles);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('promotion5.edit', compact('promotion5'))
               ->with(compact('results'))
               ->with(compact('products'))
               ->with('bundles', $bundles)
               ->with('gifts', $gifts);
    }

    public function update(Request $request, HpPromotion $promotion5)
    {
        $data = $request->all();
        try {
              if (isset($data['paid'])) {
                  $data['remain'] = $promotion5->total-$data['paid'];
              } else {
                  $data['remain'] = 0;
              }
              if (($data['remain'] == 0) && ($promotion5->paid > 0)) {
                 if (isset($data['product_id']) && $data['product_id'] != $promotion5->product_id) {
                     $product = HpProduct::find($data['product_id']);
                     $price = $product->price;
                     //$total = $price * $promotion->amount;
                     $data['remain'] = $promotion5->total-$promotion5->paid;
                     $promotion5->update($data);
                     return redirect()->route('promotion5.edit', compact('promotion5'));
                 }
             }
             $promotion5->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion5.edit', compact('promotion5'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('promotion5.index');
        }
        foreach($ids as $id) {
            $order_id = '95'.sprintf('%06d', $id);
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
                $data = $this->createFormArray2($promotion);
                $response = $this->transfer(2, $data);
                try {
                    $export = GasExport::where('prom_id')->orderBy('id', 'DESC')->first();
                    $export_data = [
                          'ids'          => json_encode($ids),
                          'prom_id'      => $id,
                          'proj_id'      => 5,
                          'path'         => 'exports@promotion5Controller',
                          'ecount'       => 1,
                          'created_by'   => auth()->user()->id,
                    ];
                    GasExport::create($export_data);
                } catch(QueryException $e) {
                    $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                    return redirect()->route('promotion5.index')->with('error', $error);
                }
            }
        }

       return redirect()->route('promotion5.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $order_id = '95'.sprintf('%06d', $id);
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
            $data = $this->createFormArray2($promotion);
            $response = $this->transfer(2, $data);
            try {
                $export = GasExport::where('prom_id')->orderBy('id', 'DESC')->first();
                $ids = [ '0' => $id ];
                $export_data = [
                          'ids'          => json_encode($ids),
                          'prom_id'      => $id,
                          'proj_id'      => 5,
                          'path'         => 'export@promotion5Controller',
                          'ecount'       => 1,
                          'created_by'   => auth()->user()->id,
                ];
                GasExport::create($export_data);
            } catch(QueryException $e) {
                $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                return redirect()->route('promotion5.index')->with('error', $error);
            }
        }

        return redirect()->route('promotion5.index');
    }

    public function destroy(HpPromotion $promotion5)
    {
        try {
              if ($promotion5->status == false) {
                  if ($promotion5->EcpayInfo != null) {
                      $promotion5->delete();
                  }
                  if ($promotion5->EcpayResult == null) {
                      $promotion5->delete();
                  }
              } else {
                  $promotion5->status = false;
                  $promotion5->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion5.index');
    }

    private function createBundles(HpPromotion $promotion)
    {
        $bundles[0] = [
                          '商品名稱' => 'Z6500W電池',
                          '數量'     => 1,
                          '單價'     => 0,
        ];
        $bundles[1] = [
                          '商品名稱' => '智能語音循環涼風扇',
                          '數量'     => 1,
                          '單價'     => 0,
        ];

        $gifts = json_decode($promotion->gifts) ?? array();
        $i = 2;
        foreach($gifts as $gift) {
            $bundles[$i] = [
                          '商品名稱' => $gift,
                          '數量'     => 1,
                          '單價'     => 0,
            ];
        }
        return $bundles;
    }

    private function createFormArray(HpPromotion $promotion, $bundles)
    {
        $id = '95'.sprintf('%06d', $promotion->id);
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

    private function createFormArray2(HpPromotion $promotion)
    {
        $id = '95'.sprintf('%06d', $promotion->id);
        $data = array();
        $bundles = null;
        $arr = array(
                    '單號'         => $id,
                    '社區'         => null,
                    '姓名'         => $promotion->name,
                    '電話'         => $promotion->phone,
                    '地址'         => $promotion->address,
                    '支付方式'     => '多元支付',
                    '方案選擇'     => '家用型Z6500W',
                    '備註說明'     => $promotion->product->paytype.'(備註：',$promotion->memo.')',
                    '建立日期'     => now()->format('Y/m/d H:i:s'),
                    '進件單位'     => $promotion->reseller->name,
        );
        array_push($data, $arr);
        return $data;
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
            $orderid = '95'.sprintf('%06d', $id);
            $response = $this->gasImport($orderid);
            $proms = json_decode($response, true);
            if(!isset($proms['回傳結果'])) {
                foreach($proms as $prom) {
                    $id1 = $prom['訂單編號'];
                    $str = substr($id1, 0, 2);
                    $promotion = HpPromotion::find($id);
                    $case_name = '';
                    if ($str == '95') {
                        $case_name = '偉伯欣豪禮送送送一';
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
        return redirect()->route('promotion5.index');
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
