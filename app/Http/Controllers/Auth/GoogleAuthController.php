<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect()->route('user.home');
        }

        $oauthUser = Socialite::driver('google')->user();
        $user = User::where('email', $oauthUser->getEmail())->first();
        $userTeacher = $user->userTeacher ?? null;
        if ($user && $userTeacher) {
            Auth::login($user);
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.login')->with('google_msg', "Email tidak terdaftar");
        }
    }
}
