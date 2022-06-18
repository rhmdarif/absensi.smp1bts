<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountSetting extends Controller
{
    //
    public function index_password()
    {
        return view('teacher.account-password');
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new' => 'required|string|same:confirm|min:6',
            'old' => 'required|string|different:new'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $user = User::find(auth()->user()->id);
        if($user == null ){
            return ['status' => false, 'msg' => "Pengguna tidak tersedia"];
        }

        if(Hash::check($request->old, $user->password)) {

            $user->update([
                'password' => Hash::make($request->new)
            ]);
            return ['status' => true, 'msg' => "Password berhasil diubah"];
        } else {
            return ['status' => false, 'msg' => "Password lama anda salah"];
        }
    }
}
