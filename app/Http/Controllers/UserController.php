<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status', true)
                     ->where('role', '>', '0')
                     ->where('role', '!=', '4')
                     ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = auth()->user();
        $data = $request->all();
        $data['created_by'] = $creator->id;
        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderExtra  $orderExtra
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = false;
        $user->save();

        return redirect()->route('users.index');
    }

    public function password()
    {
        $user = auth()->user();

        return view('users.password', compact('user'));
    }

    public function savePassword(Request $request, User $user)
    {
        $data = $request->all();
        if ($user->password == encrypt($data['old_password'])) {
            if ($data['new_password'] == $data['retry_password']) {
                $data1['password'] = encrypt($data['new_password']);
                $user->update($data1);
                return redirect()->route('home');
            }
        }
        return redirect()->route('users.password');
    }
}
