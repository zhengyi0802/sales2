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

class Promotion1Controller extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();
        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 1)->where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('promotion1.index2', compact('promotions'));
            } else {
                $promotions = HpPromotion::where('proj_id', 1)->where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('promotion1.index', compact('promotions'));
            }
        } else {
            if ($flow && $flow == 14) {
                $promotions = HpPromotion::where('proj_id', 1)->where('flow', 14)->where('status', true)->get();
                return view('promotion1.index', compact('promotions'));
            } else if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 1)->where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('promotion1.index2', compact('promotions'));
            } else {
                if ( $user->role <= UserRole::Manager ) {
                    $promotions = HpPromotion::where('proj_id', 1)->get();
                } else {
                    $promotions = HpPromotion::where('proj_id', 1)->where('status', true)->get();
                }
                return view('promotion1.index', compact('promotions'));
            }
        }
    }

    public function show(HpPromotion $promotion1)
    {
        return view('promotion1.show', compact('promotion1'));
    }

    public function edit(HpPromotion $promotion1)
    {
        try {
              $products = HpProduct::where('proj_id', 1)->where('status', true)->get();
              $results = EcpayResult::where('trade_no', $promotion1->trade_no)->first();
              $gifts = array();
              if ($promotion1->gifts != null) {
                  $gifts = json_decode($promotion1->gifts);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('promotion1.edit', compact('promotion1'))
               ->with(compact('results'))
               ->with(compact('products'))
               ->with('gifts', $gifts);
    }

    public function update(Request $request, HpPromotion $promotion1)
    {
        $data = $request->all();
        try {
              if (isset($data['paid'])) {
                  $data['remain'] = $promotion1->total-$data['paid'];
              } else {
                  $data['remain'] = 0;
              }
              if (($data['remain'] == 0) && ($promotion1->paid > 0)) {
                 if (isset($data['product_id']) && $data['product_id'] != $promotion1->product_id) {
                     $product = HpProduct::find($data['product_id']);
                     $price = $product->price;
                     //$total = $price * $promotion->amount;
                     $data['remain'] = $promotion1->total-$promotion1->paid;
                     $promotion1->update($data);
                     return redirect()->route('promotion1.edit', compact('promotion1'));
                 }
              }
              $promotion1->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion1.edit', compact('promotion1'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('promotion1.index');
        }
        foreach($ids as $id) {
            $order_id = '91'.sprintf('%06d', $id);
            $response = $this->gasImport($order_id);
            $proms = json_decode($response, true);
            if(!isset($proms['回傳結果'])) {
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
                          'proj_id'      => 1,
                          'path'         => 'exports@Promotion1Controller',
                          'ecount'       => (isset($export)) ? ($export->ecount)+1 : 1,
                          'created_by'   => auth()->user()->id,
                    ];
                    GasExport::create($export_data);
                } catch(QueryException $e) {
                    $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                    return redirect()->route('promotion1.index')->with('error', $error);
                }
            }
        }

       return redirect()->route('promotion1.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $order_id = '91'.sprintf('%06d', $id);
        $response = $this->gasImport($order_id);
        $proms = json_decode($response, true);
        if(!isset($proms['回傳結果'])) {
            return redirect()->route('promotion1.index');
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
                          'proj_id'      => 1,
                          'path'         => 'export@Promotion1Controller',
                          'ecount'       => isset($export) ? ($export->ecount)+1 : 1,
                          'created_by'   => auth()->user()->id,
                ];
                GasExport::create($export_data);
            } catch(QueryException $e) {
                $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                return redirect()->route('promotion1.index')->with('error', $error);
            }
        }

        return redirect()->route('promotion1.index');
    }

    public function destroy(HpPromotion $promotion1)
    {
        try {
              if ($promotion1->status == false) {
                  if ($promotion1->EcpayInfo != null) {
                      $promotion1->EcpayInfo->delete();
                  }
                  if ($promotion1->EcpayResult == null) {
                      $promotion1->delete();
                  }
              } else {
                  $promotion1->status = false;
                  $promotion1->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion1.index');
    }

    private function createBundles(HpPromotion $promotion)
    {
        $bundles[0] = [
                          '商品名稱' => 'Z5000W備用電池',
                          '數量'     => 1,
                          '單價'     => 0,
        ];
        $bundles[1] = [
                          '商品名稱' => '智能語音循環涼風扇',
                          '數量'     => 1,
                          '單價'     => 0,
        ];
        $i = 2;
        if ($promotion->product->type != null) {
            $bundles[2] = [
                          '商品名稱' => $promotion->product->type,
                          '數量'     => 1,
                          '單價'     => 0,
            ];
            $i = 3;
        }
        $gifts = json_decode($promotion->gifts);
        foreach($gifts as $gift) {
            switch($gift) {
                case 'gift1' : $name = '電動折疊腳踏車';
                               break;
                case 'gift2' : $name = '嬰兒手推車行李箱';
                               break;
                case 'gift3' : $name = '黑科技雷達生命體徵檢測系統';
                               break;
                case 'gift4' : $name = '超魔刀';
                               break;
                case 'gift5' : $name = 'D牌同型款直髮器';
                               break;
                case 'gift6' : $name = '電動足療按摩器';
                               break;
                case 'gift7' : $name = '電動平衡車';
                               break;
            }
            $bundles[$i] = [
                          '商品名稱' => $name,
                          '數量'     => 1,
                          '單價'     => 0,
            ];
            if ($i == 3){
                break;
            } else {
                $i++;
            }
        }
        return $bundles;
    }

    private function createFormArray(HpPromotion $promotion, $bundles)
    {
        $id = '91'.sprintf('%06d', $promotion->id);

        $data = array(
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
                     '建立人員'      => auth()->user()->name,
                     '建立日期'      => date('Y/m/d h:i:s'),
                     '附加商品'      => $bundles,
         );

         return $data;
    }

    private function createFormArray2(HpPromotion $promotion)
    {
        $id = '91'.sprintf('%06d', $promotion->id);
        $bundles = '(清涼一夏專案贈送備用電池數量為 1 個)';
        $data = array(
                    '單號'         => $id,
                    '社區'         => null,
                    '姓名'         => $promotion->name,
                    '電話'         => $promotion->phone,
                    '地址'         => $promotion->address,
                    '支付方式'     => '多元支付',
                    '方案選擇'     => '家用型Z5000W加備用電池1個',
                    '備註說明'     => $promotion->product->paytype.'(備註：'.$promotion->memo.')',
                    '建立日期'     => date('Y/m/d h:i:s'),
                    '進件單位'     => $promotion->reseller->name,
        );
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
            $orderid = '91'.sprintf('%06d', $id);
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
                    } else if ($str == '92') {
                        $case_name = '感恩母親回饋季專案';
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
                      'shipping_date'       => $prom['預計出貨日期'],
                      'finish_date'         => $prom['安裝完成日期'],
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
        return redirect()->route('promotion1.index');
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
