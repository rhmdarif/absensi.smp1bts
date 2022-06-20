<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('user.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $user = User::where('email', $request->email)->first();
        if($user == null ){
            return ['status' => false, 'msg' => "Pengguna tidak ditemukan"];
        }

        if(Hash::check($request->password, $user->password) == false) {
            return ['status' => false, 'msg' => "Password anda salah"];
        }

        dd(UserTeacher::where('user_id', $user->id)->count() == 0);
        if(UserTeacher::where('user_id', $user->id)->count() == 0) {
            return ['status' => false, 'msg' => "Anda tidak diizinkan masuk"];
        }

        Auth::loginUsingId($user->id);
        return ['status' => true, 'msg' => "Login berhasil, anda akan segera di alihkan."];
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
