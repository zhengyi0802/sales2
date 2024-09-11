<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;

class SocialitesLineController extends Controller
{
    //跳转到Line授权页面
    public function lineLogin()
    {
        return Socialite::driver('line')->redirect();
    }

    //用户授权后，跳转回来
    public function lineLoginCallback()
    {
        $info = Socialite::driver('line')->user();
        $existUser = User::where('email', $user->email)->first();
        $findUser = User::where('line_id', $user->id)->first();

        //資料庫已有會員 Facebook ID 資料時重新導向至主控台
        if($findUser){
            Auth::login($findUser);
            return redirect()->intended('home');
        }
        //如果會員資料庫中沒有 Facebook ID 資料，將檢查資料庫中有無會員 email，如果有僅加入 Facebook ID 資料後導向主控台
        if($existUser != '' && $existUser->email === $user->email){
            $existUser->line_id = $user->id;
            $existUser->save();
            Auth::login($existUser);
            return redirect()->intended('home');
        }else{
        //資料庫無會員資料時註冊會員資料，然後導向主控台
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'line_id'=> $user->id,
                'password' => encrypt('fromsocialwebsite'),
                ]);
            Auth::login($newUser);
            return redirect()->intended('home');
        }
    }
}
