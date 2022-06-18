<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAttend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    //
    public function index()
    {
        return view('teacher.absensi-index');
    }

    public function searchDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'nullable|date'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        if($request->has('date') && $request->date != '') {
            $teacherAttend = TeacherAttend::where('created_at', 'like', $request->date.'%')
                                    ->where('teacher_id', auth()->user()->userTeacher->id)
                                    ->orderBy('created_at', 'desc')
                                    ->with(['masterTeacherAttend'])
                                    ->get();
        } else {
            $teacherAttend = TeacherAttend::where('teacher_id', auth()->user()->userTeacher->id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(10)
                                    ->with(['masterTeacherAttend'])
                                    ->get();
        }

        return ['status' => true, 'msg' => "Data didapatkan", "datas" => $teacherAttend];
    }
}
