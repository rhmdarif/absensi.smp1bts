<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('teacher.activity');
    }

    public function getData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }
        $date = date("Y-m-d", strtotime($request->date));

        $teacherActivity = TeacherActivity::where('teacher_id', auth()->user()->userTeacher->id)->where('period', 'like', $date."%")->orderBy('period')->get();
        return ['status' => true, 'msg' => "Aktifitas tersedia", 'datas' => $teacherActivity, 'request' => $request->all()];
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
            'date' => 'required|date',
            'time_in' => 'required|date_format:H:i',
            'time_out' => 'required|after_or_equal:time_in',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        TeacherActivity::create([
            'teacher_id' => auth()->user()->userTeacher->id,
            'title' => $request->title,
            'description' => $request->description,
            'period' => $request->date,
            'start_at' => $request->time_in,
            'end_at' => $request->time_out,
        ]);
        return ['status' => true, 'msg' => "aktifitas telah disimpan"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherActivity  $teacherActivity
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherActivity $activity)
    {
        //
        return $activity;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherActivity  $teacherActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherActivity $teacherActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherActivity  $teacherActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherActivity $activity)
    {
        //
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time_in' => 'required',
            'time_out' => 'required|after_or_equal:time_in',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $activity->update([
            'teacher_id' => auth()->user()->userTeacher->id,
            'title' => $request->title,
            'description' => $request->description,
            'period' => $request->date,
            'start_at' => $request->time_in,
            'end_at' => $request->time_out,
        ]);

        return ['status' => true, 'msg' => "Aktifitas telah diperbaharui"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherActivity  $teacherActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherActivity $activity)
    {
        //
        $activity->delete();
        return ['status' => true, 'msg' => "Aktifitas telah dihapus"];
    }
}
