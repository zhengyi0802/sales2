<?php

namespace App\Http\Controllers;

use Hash;
use App\Rules\MatchOldPassword;
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
        $users = User::where('role', '>', '0')
                     ->where('role', '!=', '4')
                     ->where('role', '!=', '7')
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
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
新增/     *
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
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
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
        if ($user->id == 2) {
            return redirect()->route('home');
        }
        return view('users.password', compact('user'));
    }

    public function savePassword(Request $request, User $user)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'retry_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('users.password');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('users.profiles', compact('user'));
    }

    public function saveProfile(Request $request, User $user)
    {
        $editor = auth()->user();
        $data = $request->all();
        $user->update($data);
        if ($editor->role == App\Enums\UserRole::Sales ||
            $editor->role == App\Enums\UserRole::Reseller) {
            $sales = Sales::where('user_id', $user->id)->first();
            $sales->update($data);
        }

        return redirect()->route('home');
    }

}
