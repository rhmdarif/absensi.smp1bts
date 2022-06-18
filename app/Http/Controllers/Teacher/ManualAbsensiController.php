<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Models\TeacherAttend;
use App\Models\MasterTeacherAttend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManualAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tgl = date('Y-m-d');
        $absensi = MasterTeacherAttend::where('tanggal', $tgl)
        ->get();

        return view('teacher.manual-absen', ['absensi' => $absensi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'absen_id' => 'required|exists:master_teacher_attends,id',
            'status' => 'required|in:hadir,izin',
            'keterangan' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }


        $masterTeacherAttend = MasterTeacherAttend::find($request->absen_id);

        if($masterTeacherAttend == null) {
            return ['status' => false, 'msg' => "Tidak ada absen"];
        }

        $check_attend = TeacherAttend::where('master_teacher_attend_id', $masterTeacherAttend->id)
                                    ->where('teacher_id', auth()->user()->userTeacher->id)
                                    ->count();

        if($check_attend) {
            return ['status' => false, 'msg' => "Absen sudah diambil sebelumnya"];
        }

        $strTimeSelesaiAbsen = strtotime($masterTeacherAttend->tanggal." ".$masterTeacherAttend->waktu_selesai);


        if($request->status == "hadir") {
            // JIKA WAKTU PENGAMBILAN ABSEN TELAH SELESAI
            if( time() >= $strTimeSelesaiAbsen ) {
                $status = 2;

                $masterTeacherAttend->update([
                    'total_terlambat' => $masterTeacherAttend->total_terlambat+1
                ]);
            } else {
                $status = 1;

                $masterTeacherAttend->update([
                    'total_hadir' => $masterTeacherAttend->total_hadir+1
                ]);
            }
        } else {
            $status = 3;
            $masterTeacherAttend->update([
                'total_izin' => $masterTeacherAttend->total_izin+1
            ]);
        }

        $teacher_attend = TeacherAttend::create([
            'teacher_id' => auth()->user()->userTeacher->id,
            'qr_code' => $request->qr_code,
            'master_teacher_attend_id' => $request->absen_id,
            'status' => $status,
            'is_manual' => true,
            'keterangan' => $request->keterangan ?? ""
        ]);
        return ['status' => true, 'msg' => "Absen berhasil diambil"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherAttend  $teacherAttend
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherAttend $teacherAttend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherAttend  $teacherAttend
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherAttend $teacherAttend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherAttend  $teacherAttend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherAttend $teacherAttend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherAttend  $teacherAttend
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherAttend $teacherAttend)
    {
        //
    }
}
