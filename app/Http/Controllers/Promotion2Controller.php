<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\HpProduct;
use App\Models\HpPromotion;
use App\Models\EcpayResult;
use App\Enums\UserRole;

class Promotion2Controller extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();
        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 2)->where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('promotion2.index2', compact('promotions'));
            } else {
                $promotions = HpPromotion::where('proj_id', 2)->where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('promotion2.index', compact('promotions'));
            }
        } else {
            if ($flow && $flow == 14) {
                $promotions = HpPromotion::where('proj_id', 2)->where('flow', 14)->where('status', true)->get();
                return view('promotion2.index', compact('promotions'));
            } else if ($flow && ($flow == 8 || $flow == 9)) {
                $promotions = HpPromotion::where('proj_id', 2)->where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('promotion2.index2', compact('promotions'));
            } else {
                if ( $user->role <= UserRole::Manager ) {
                    $promotions = HpPromotion::where('proj_id', 2)->get();
                } else {
                    $promotions = HpPromotion::where('proj_id', 2)->where('status', true)->get();
                }
                return view('promotion2.index', compact('promotions'));
            }
        }
    }

    public function show(HpPromotion $promotion2)
    {
        return view('promotion2.show', compact('promotion2'));
    }

    public function edit(HpPromotion $promotion2)
    {
        try {
              $products = HpProduct::where('status', true)->get();
              $results = EcpayResult::where('trade_no', $promotion2->trade_no)->first();
              $gifts = array();
              if ($promotion2->gifts != null) {
                  $gifts = json_decode($promotion2->gifts);
              }
              $bundles = array();
              if ($promotion2->bundles != null) {
                  $bundles = json_decode($promotion2->bundles);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('promotion2.edit', compact('promotion2'))
               ->with(compact('results'))
               ->with(compact('products'))
               ->with('bundles', $bundles)
               ->with('gifts', $gifts);
    }

    public function update(Request $request, HpPromotion $promotion2)
    {
        $data = $request->all();
        try {
              if (isset($data['paid'])) {
                  $data['remain'] = $promotion2->total-$data['paid'];
              } else {
                  $data['remain'] = 0;
              }
              if (($data['remain'] == 0) && ($promotion2->paid > 0)) {
                 if (isset($data['product_id']) && $data['product_id'] != $promotion2->product_id) {
                     $product = HpProduct::find($data['product_id']);
                     $price = $product->price;
                     //$total = $price * $promotion->amount;
                     $data['remain'] = $promotion2->total-$promotion2->paid;
                     $promotion2->update($data);
                     return redirect()->route('promotion2.edit', compact('promotion2'));
                 }
             }
             $promotion2->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion2.edit', compact('promotion2'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('promotion1.index');
        }
        foreach($ids as $id) {
            $order_id = '92'.sprintf('%06d', $id);
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
            }
        }

       return redirect()->route('promotion2.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $order_id = '92'.sprintf('%06d', $id);
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
        }

       return redirect()->route('promotion2.index');
    }

    public function destroy(HpPromotion $promotion2)
    {
        try {
              if ($promotion2->status == false) {
                  if ($promotion2->EcpayInfo != null) {
                      $promotion2->delete();
                  }
                  if ($promotion2->EcpayResult == null) {
                      $promotion2->delete();
                  }
              } else {
                  $promotion2->status = false;
                  $promotion2->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('promotion2.index');
    }

    private function createBundles(HpPromotion $promotion)
    {
        $bundles[0] = [
                          '商品名稱' => 'Z5000W智慧門鎖',
                          '數量'     => 1,
                          '單價'     => 0,
        ];
        $i = 1;
        $gifts = json_decode($promotion->gifts) ?? array();
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
            $bundles[1] = [
                          '商品名稱' => $name,
                          '數量'     => 1,
                          '單價'     => 0,
            ];
            break;
        }
        $i = 2;
        $pbs = json_decode($promotion->bundles);
        $dc3500 = $dc5000 = $dc6300 = 0;
        foreach($pbs as $bundle) {
            if ($bundle == 'DC3500') {
                $dc3500++;
            } else if ($bundle == 'DC5000') {
                $dc5000++;
            } else if ($bundle == 'DC6300') {
                $dc6300++;
            }
        }
        if ($dc3500 > 0) {
            $bundles[$i] = [
                          '商品名稱' => 'DC3500 3.5KW變頻冷暖空調',
                          '數量'     => $dc3500,
                          '單價'     => 0,
            ];
            $i++;
        }
        if ($dc5000 > 0) {
            $bundles[$i] = [
                          '商品名稱' => 'DC5000 5.0KW變頻冷暖空調',
                          '數量'     => $dc5000,
                          '單價'     => 0,
            ];
            $i++;
        }
        if ($dc6300 > 0) {
            $bundles[$i] = [
                          '商品名稱' => 'DC6300 6.3KW變頻冷暖空調',
                          '數量'     => $dc6300,
                          '單價'     => 0,
            ];
            $i++;
        }
        return $bundles;
    }

    private function createFormArray(HpPromotion $promotion, $bundles)
    {
        $id = '92'.sprintf('%06d', $promotion->id);
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
        $id = '92'.sprintf('%06d', $promotion->id);
        $data = array();
        $bundles = null;
        $arr = array(
                    '單號'         => $id,
                    '社區'         => null,
                    '姓名'         => $promotion->name,
                    '電話'         => $promotion->phone,
                    '地址'         => $promotion->address,
                    '支付方式'     => '多元支付',
                    '方案選擇'     => '家用型Z5000W',
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

    public function gasImport($orderid)
    {
        $curl = curl_init();

        $url = config('gas.export_project_url').'?orderid='. $order_id;

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
