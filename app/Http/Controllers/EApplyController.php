<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\EApply;
use App\Models\ECommunity;
use App\Models\EProject;
use App\Models\EcpayResult;
use App\Models\GasExport;
use App\Models\Process;
use App\Enums\UserRole;

class EApplyController extends Controller
{
    //
    public function index(Request $request)
    {
        $flow = $request->input('flow');
        $user = auth()->user();

        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $eapplies = EApply::where('reseller_id', $user->sales->id)->where('flow', 8)->orWhere('flow', 9)->where('status', true)->get();
                return view('eapplies.index2', compact('eapplies'));
            } else {
                $eapplies = EApply::where('reseller_id', $user->sales->id)->where('status', true)->get();
                return view('eapplies.index', compact('eapplies'));
            }
        } else {
            if ($flow && ($flow == 8 || $flow == 9)) {
                $eapplies = EApply::where('flow', 8)->where('status', true)->orWhere('flow', 9)->get();
                return view('eapplies.index2', compact('eapplies'));
            } else {
                if ($flow == 14) {
                    $eapplies = EApply::where('flow', $flow)->get();
                } else if ( $user->role <= UserRole::Manager ) {
                    $eapplies = EApply::get();
                } else if ($user->role == UserRole::Accounter) {
                    $eapplies = EApply::where('flow', 14)->where('status', true)->get();
                } else {
                    $eapplies = EApply::where('status', true)->get();
                }
                return view('eapplies.index', compact('eapplies'));
            }
        }

    }

    public function show(EApply $eapply)
    {
        return view('eapplies.show', compact('eapply'));
    }

    public function edit(EApply $eapply)
    {
        try {
              $price = $eapply->project->price;
              $total = $price * $eapply->amount;
              $prepay = $eapply->project->prepaid * $eapply->amount;
              $eprojects = EProject::where('status', true)->get();
              $results = EcpayResult::where('trade_no', $eapply->trade_no)->first();
              $gifts = array();
              if ($eapply->gifts != null) {
                  $gifts = json_decode($eapply->gifts);
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('eapplies.edit', compact('eapply'))
               ->with(compact('results'))
               ->with(compact('eprojects'))
               ->with('gifts', $gifts)
               ->with('total', $total)
               ->with('prepay', $prepay);
    }

    public function update(Request $request, EApply $eapply)
    {
        $data = $request->all();
        try {
               $price = $eapply->project->price;
               $total = $price * $eapply->amount;
               if (isset($data['paid'])) {
                   $data['remain'] = $total-$data['paid'];
                   if ($data['remain'] < 0) {
                       $data['remain'] = 0;
                   }
               } else {
                   $data['remain'] = 0;
               }
               if (($data['remain'] == 0) && ($eapply->paid > 0)) {
                   if (isset($data['project_id']) && $data['project_id'] != $eapply->project_id) {
                        $eproject = EProject::find($data['project_id']);
                        $price = $eproject->price;
                        $total = $price * $eapply->amount;
                        $data['remain'] = $total-$eapply->paid;
                        $eapply->update($data);
                        return redirect()->route('eapplies.edit', compact('eapply'));
                   }
               }
               $eapply->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('eapplies.edit', compact('eapply'));
    }

    public function exports(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids == null) {
            return redirect()->route('eapplies.index');
        }
        foreach($ids as $id) {
            $eapply = EApply::find($id);
            $data = $this->createFormArray($eapply);
            $response = $this->transfer($data);
            if ($response) {
                $eapply->flow = 10;
                $eapply->save();
                try {
                    $export = GasExport::where('apply_id')->orderBy('id', 'DESC')->first();
                    $export_data = [
                          'ids'          => json_encode($ids),
                          'apply_id'     => $id,
                          'path'         => 'exports@EApplyController',
                          'ecount'       => (isset($export)) ? ($export->ecount)+1 : 1,
                          'created_by'   => auth()->user()->id,
                    ];
                    GasExport::create($export_data);
                } catch(QueryException $e) {
                    $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                    return redirect()->route('eapplies.index')->with('error', $error);
                }
            }
        }

       return redirect()->route('eapplies.index');
    }

    public function export(Request $request)
    {
        $id = $request->input('id');

        $eapply = EApply::find($id);
        $data = $this->createFormArray($eapply);
        $response = $this->transfer($data);
        if ($response) {
            $eapply->flow = 10;
            $eapply->save();
            try {
                $export = GasExport::where('apply_id')->orderBy('id', 'DESC')->first();
                $ids = [ '0' => $id ];
                $export_data = [
                          'ids'          => json_encode($ids),
                          'apply_id'     => $id,
                          'path'         => 'export@EApplyController',
                          'ecount'       => (isset($export)) ?($export->ecount)+1 : 1,
                          'created_by'   => auth()->user()->id,
                ];
                GasExport::create($export_data);
            } catch(QueryException $e) {
                $error = 'GASExport資料鰾發生錯誤：'. $e->getMessage();
                return redirect()->route('eapplies.index')->with('error', $error);
            }
        }

        return redirect()->route('eapplies.index');
    }

    private function createFormArray(EApply $eapply)
    {
        $data = array();
        $bundles = json_decode($eapply->bundles);
        if (isset($bundles->battery) && $bundles->battery > 0) {
            $bundles = '(加價購電池數量為'.$bundles->battery.'個)';
        } else {
            $bundles = null;
        }

        for ($i = 0; $i < $eapply->amount; $i++) {
             $arr = array(
                    '單號'         => $eapply->id,
                    '社區'         => (($eapply->community) ? $eapply->community->community : $eapply->cname),
                    '姓名'         => $eapply->name,
                    '電話'         => $eapply->phone,
                    '地址'         => $eapply->address,
                    '支付方式'     => (($eapply->payment == 1) ? '銀行轉帳' : '多元支付'),
                    '方案選擇'     => ( $eapply->project->name ),
                    '備註說明'     => $eapply->memo.$bundles,
                    '建立日期'     => date('Y/m/d H:i:s'),
                    '進件單位'     => $eapply->reseller->name,
             );
             array_push($data, $arr);
             $bundles = null;
        }
        return $data;
    }

    private function transfer($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
             CURLOPT_URL => config('gas.export_url'),
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
       if(!$response) {
           $err = curl_error($curl);
       }

       curl_close($curl);
       return $response;
    }

    public function destroy(EApply $eapply)
    {
        try {
              if ($eapply->status == false) {
                  if ($eapply->EcpayInfo != null) {
                      $eapply->EcpayInfo->delete();
                  }
                  if ($eapply->EcpayResult == null) {
                      $eapply->delete();
                  }
              } else {
                  $eapply->status = false;
                  $eapply->save();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('eapplies.index');
    }

    public function import(Request $request)
    {
        $req = $request->all();
        if (isset($req['id'])) {
            $orderid= $req['id'];
            $eapply = EApply::find($orderid);
            $response = $this->gasImport($orderid);
            $applies = json_decode($response, true);
            if(!isset($proms['回傳結果'])) {
              $amount_id = 1;
              foreach($applies as $apply) {
                      $data['case_name'] = '門鎖申請書';
                      $data['apply_id'] = $apply['單號'] ?? 0;
                      $data['name']  = $apply['姓名'];
                      $data['phone'] = $apply['電話'];
                      $data['address'] = $apply['地址'];
                      $data['project'] = $apply['申請方案'];
                      $data['memo'] = $apply['備註'] ?? "";
                      $data['create_date'] = $apply['進件日期'] ?? "";
                      $date['photo_date'] = $apply['相片交付日期'] ?? "";
                      $date['shipping_date'] = $apply['配送完成日期'] ?? "";
                      $date['booking_date'] = $apply['預約安裝日期'] ?? "";
                      $date['finish_date'] = $apply['安裝完成日期'] ?? "";
                      if ($apply['處理狀態'] == '已收單') {
                          $data['flow'] = 11;
                      } else if ($apply['處理狀態'] == '已取消') {
                          $data['flow'] = 15;
                      } else if ($apply['處理狀態'] == '待安排') {
                          $data['flow'] = 12;
                      } else if ($apply['處理狀態'] == '已交付') {
                          $data['flow'] = 13;
                      } else if ($apply['處理狀態'] == '已完成') {
                          $data['flow'] = 14;
                      } else {
                          $data['flow'] = 10;
                      }

                      if (true) {
                          $pprocess = Process::where('apply_id', $eapply->id)
                                             ->where('amount_id', $amount_id)
                                             ->first();
                          if ($pprocess == null) {
                              $data['amount_id'] = $amount_id;
                              $process = Process::create($data);
                          } else {
                              if( $pprocess->flow != $data['flow'] ) {
                                  $pprocess->update($data);
                                  $process = $pprocess;
                              }
                          }
                          $amount_id++;
                      } else {
                          $data['amount_id'] = $amount_id;
                          $process = Process::create($data);
                          $amount_id++;
                      }
                      if ($data['flow'] != 15) {
                          $eapply->flow1 = $data['flow'];
                      }
                      if ($data['flow'] == 14) {
                          $eapply->flow = 14;
                      }
                      $eapply->save();
              }
            } else {
              $eapply->flow = 9;
              $eapply->save();
            }
        }
        return redirect()->route('eapplies.index');
    }

    public function gasImport($orderid)
    {
        $curl = curl_init();

        $string = '?orderid='. $orderid;

          curl_setopt_array($curl, array(
               CURLOPT_URL => (config('gas.use_get')) ? config('gas.export_url').$string : config('gas.checkout_url'),
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_ENCODING => "",
               CURLOPT_TIMEOUT => 30000,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => config('gas.use_get') ? "GET" : "POST",
               CURLOPT_POSTFIELDS => config('gas.use_get') ? null :$jdata,
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
