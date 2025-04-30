<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EApply;
use App\Models\ECommunity;
use App\Models\EProject;
use App\Models\Process;
use App\Enums\UserRole;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::get();

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

        $process->update($data);

        return redirect()->route('processes.index');
    }

    public function destroy(Process $process)
    {
       $process->status = false;
       $process->save();

        return redirect()->route('processes.index');
    }
}
