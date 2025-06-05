<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\EApply;
use App\Models\ECommunity;
use App\Models\EProject;
use App\Models\Process;
use App\Enums\UserRole;

class ProcessController extends Controller
{
    public function index()
    {
        try {
              $processes = Process::get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('processes.index', compact('processes'));
    }

    public function create()
    {
        return 0;
    }

    public function store(Request $request)
    {
        return 0;
    }

    public function edit(Process $process)
    {
        return view('processes.edit', compact('process'));
    }

    public function update(Request $request, Process $process)
    {
        $data = $request->all();
        try {
              $process->update($data);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('processes.index');
    }

    public function destroy(Process $process)
    {
       try {
             $process->status = false;
             $process->save();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('processes.index');
    }
}
