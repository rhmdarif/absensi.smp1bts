<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\MasterTeacherAttend;
use App\Models\ServerCom;
use App\Models\UserTeacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $jumlah_guru = UserTeacher::count();
        $jumlah_absen_berlangsung = MasterTeacherAttend::where('tanggal', date('Y-m-d'))
                                                        ->where('waktu_mulai', '<=', date("H:i:s"))
                                                        ->where('waktu_selesai', '>', date("H:i:s"))
                                                        ->count();
        $jumlah_komputer = ServerCom::count();
        return view('teacher.home', compact('jumlah_guru', 'jumlah_absen_berlangsung', 'jumlah_komputer'));
    }
}
