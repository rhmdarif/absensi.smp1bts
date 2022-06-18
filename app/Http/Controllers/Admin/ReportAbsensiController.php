<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTeacherAttend;
use App\Models\UserTeacher;
use Illuminate\Http\Request;

class ReportAbsensiController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->has('start')) {
            if($request->has('end')) {
                $masterTeacherAttend = MasterTeacherAttend::where('created_at', '>=', $request->start.' 00:00:00')
                                                        ->where('created_at', '<=', $request->end.' 23:59:59')
                                                        ->orderBy('created_at', 'desc')
                                                        ->get();
            } else {
                $masterTeacherAttend = MasterTeacherAttend::where('created_at', '>=', $request->start.' 00:00:00')
                                                        ->orderBy('created_at', 'desc')
                                                        ->get();
            }
        } else {
            $masterTeacherAttend = MasterTeacherAttend::orderBy('created_at', 'desc')->limit($request->limit ?? 20)->get();
        }

        $userTeachers = UserTeacher::all();

        return view('admin.absensi.report', ['masterAbsen' => $masterTeacherAttend, 'teachers' => $userTeachers]);
    }
}
