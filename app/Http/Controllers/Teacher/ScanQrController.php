<?php

namespace App\Http\Controllers\Teacher;

use App\Models\UserTeacher;
use Illuminate\Http\Request;
use App\Models\TeacherAttend;
use App\Models\MasterTeacherAttend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScanQrController extends Controller
{
    //
    public function index()
    {
        return view('teacher.scan-qr');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qrCode' => 'required|string',
            'absen_id' => 'required|exists:master_teacher_attends,id'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        return ['status' => true, 'msg' => 'Scan Berhasil', 'qr_code' => $request->qrCode, 'teacher_id'=> auth()->user()->userTeacher->id, 'absen_id' => $request->absen_id];

    }
}
