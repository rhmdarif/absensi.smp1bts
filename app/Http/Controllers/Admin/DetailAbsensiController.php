<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTeacherAttend;
use Illuminate\Http\Request;

class DetailAbsensiController extends Controller
{
    //
    public function index(MasterTeacherAttend $absensi)
    {
        return view('admin.absensi.detail', ['absensi' => $absensi]);
    }


}
