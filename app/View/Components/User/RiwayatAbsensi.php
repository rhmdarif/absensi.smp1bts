<?php

namespace App\View\Components\User;

use App\Models\TeacherAttend;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class RiwayatAbsensi extends Component
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
        $riwayat_absen = TeacherAttend::where('teacher_id', Auth::user()->userTeacher->id)->orderBy('created_at', 'desc')->simplePaginate(10);
        return view('components.user.riwayat-absensi', ['riwayat' => $riwayat_absen]);
    }
}
