<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LockInstaller;
use App\Models\EProject;
use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;

class LockInstallerController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        if ($user->role == UserRole::Reseller || $user->role == UserRole::Sales) {
            $lockInstallers = LockInstaller::where('reseller_id', $user->sales->id)->where('status', true)->get();
        } else {
            if ($user->role <= UserRole::Manager) {
                $lockInstallers = LockInstaller::get();
            } else {
                $lockInstallers = LockInstaller::where('status', true)->get();
            }
        }

        return view('lockinstallers.index', compact('lockInstallers'));
    }

    public function create()
    {
        $eprojects = EProject::where('type', 2)->where('status', true)->get();

        return view('lockinstallers.create', compact('eprojects'));
    }

    public function store()
    {

    }

    public function show(LockInstaller $lockInstaller)
    {
        return view('lockinstallers.show', compact('lockInstaller'));
    }

    public function edit(LockInstaller $lockInstaller)
    {
        return view('lockInstallers.edit', compact('lockInstaller'));
    }

    public function update(Request $request, LockInstaller $lockInstaller)
    {
        return redirect()->route('lockinstallers.index');
    }

    public function destroy(LockInstaller $lockInstaller)
    {
        if ($lockInstaller->status == false) {
            $lockInstaller->delete();
        } else {
            $lockInstaller->status = false;
            $lockInstaller->save();
        }
        return redirect()->route('lockinstallers.index');
    }
}
