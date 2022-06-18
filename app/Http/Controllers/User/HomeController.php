<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\TeacherAttend;
use App\Models\MasterTeacherAttend;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {

        $user = auth()->user();
        $has_take = TeacherAttend::select('master_teacher_attend_id')->where('teacher_id', $user->userTeacher->id)->get()->map(function($data) {
            return $data->master_teacher_attend_id;
        });
        $now_attend = MasterTeacherAttend::where('waktu_mulai', '<=', date('H:i:s'))->where('waktu_selesai', '>', date('H:i:s'))->where('tanggal', date('Y-m-d'))->orderBy('waktu_mulai', 'asc')->get();
        $coming_attend = MasterTeacherAttend::where('tanggal', '>', date("Y-m-d"))->orWhere(function($query) {
            $query->where('tanggal', date("Y-m-d"))->where('waktu_mulai', '>=', date('H:i:s'));
        })->orderBy('waktu_mulai', 'asc')->get();

        return view('user.home', ['now' => $now_attend, 'coming' => $coming_attend, 'has_take' => $has_take]);
    }
}
