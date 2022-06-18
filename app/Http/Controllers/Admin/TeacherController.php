<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherActivity;
use App\Models\User;
use App\Models\UserTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.teacher.index');
    }

    public function loadData()
    {
        return datatables()->of(UserTeacher::query()->with(['user'])->get())->toJson();
    }

    public function timeLine($teacher_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl' => 'nullable|date'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        if($request->has('tgl')) {
            $teacherActivity = TeacherActivity::where('teacher_id', $teacher_id)
                                            ->where('created_at', $request->tgl)
                                            ->orderBy('created_at', 'desc')
                                            ->get()->groupBy(function($item) {
                                                return $item->created_at->format('Y-m-d');
                                            });
        } else {
            $teacherActivity = TeacherActivity::where('teacher_id', $teacher_id)
                                            ->orderBy('created_at', 'desc')
                                            ->get()->groupBy(function($item) {
                                                return $item->created_at->format('Y-m-d');
                                            });
        }
        $teacher = UserTeacher::find($teacher_id);

        return view('admin.teacher.activity', ['activity' => $teacherActivity, 'teacher' => $teacher]);
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
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'nip' => 'required|string|unique:user_teachers,nip',
            'pangkat' => 'required|string',
            'gol' => 'required|string',
            'pekerjaan' => 'required|string',
            'jabatan' => 'required|string',
            'nohp' => 'required|string',
            'alamat' => 'required|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $genPassword = $this->generatePassword($request->name, $request->nip);
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($genPassword),
            'email' => $request->email,
        ]);

        $userTeacher = UserTeacher::create([
            'user_id' => $user->id,
            'kode_guru' => substr($request->name, 0, 2).rand(100, 999),
            'foto' => "images/_default.jpg",
            'nip' => $request->nip,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'pangkat' => $request->pangkat,
            'golongan' => $request->gol,
            'pekerjaan' => $request->pekerjaan,
            'jabatan' => $request->jabatan,
        ]);

        return ['status' => true, 'msg' => "Akun guru \"".$user->name."\" berhasil dibuat"];
    }

    private function generatePassword($name, $nip)
    {
        $huruf = substr($name, 0, 3);
        $number = substr($nip, 0, 2).substr($nip, -2);
        return $huruf.$number;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTeacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($teacher)
    {
        //
        return UserTeacher::where('id', $teacher)->with(['user'])->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTeacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTeacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTeacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTeacher $teacher)
    {
        //
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$teacher->user_id,
            'nip' => 'required|string|unique:user_teachers,nip,'.$teacher->id,
            'pangkat' => 'required|string',
            'gol' => 'required|string',
            'pekerjaan' => 'required|string',
            'jabatan' => 'required|string',
            'nohp' => 'required|string',
            'alamat' => 'required|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $genPassword = $this->generatePassword($request->name, $request->nip);
        $user = User::find($teacher->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $userTeacher = $teacher->update([
            'kode_guru' => substr($request->name, 0, 2).rand(100, 999),
            'nip' => $request->nip,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'pangkat' => $request->pangkat,
            'golongan' => $request->gol,
            'pekerjaan' => $request->pekerjaan,
            'jabatan' => $request->jabatan,
        ]);

        return ['status' => true, 'msg' => "Akun guru \"".$user->name."\" telah diperbaharui"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTeacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTeacher $teacher)
    {
        //
        $name = $teacher->user->name;
        $teacher->delete();
        return ['status' => true, 'msg' => "Akun guru ".$name." telah di hapus"];
    }
}
