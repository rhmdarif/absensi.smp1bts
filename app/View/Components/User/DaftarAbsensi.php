<?php

namespace App\View\Components\User;

use App\Models\MasterTeacherAttend;
use App\Models\TeacherAttend;
use Illuminate\View\Component;

class DaftarAbsensi extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = auth()->user();
        $has_take = TeacherAttend::select('master_teacher_attend_id')->where('teacher_id', $user->userTeacher->id)->get()->map(function($data) {
            return $data->master_teacher_attend_id;
        });
        $now_attend = MasterTeacherAttend::where('waktu_mulai', '<=', date('H:i:s'))->where('waktu_selesai', '>', date('H:i:s'))->where('tanggal', date('Y-m-d'))->whereNotIn('id', $has_take)->get();
        $coming_attend = MasterTeacherAttend::where('tanggal', '>', date("Y-m-d"))->orWhere(function($query) {
            return $query->where('tanggal', date("Y-m-d"))->where('waktu_mulai', '>', date('H:i:s'));
        })->get();


        return view('components.user.daftar-absensi', ['now' => $now_attend, 'coming' => $coming_attend]);
    }
}
