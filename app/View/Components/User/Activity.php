<?php

namespace App\View\Components\User;

use App\Models\TeacherActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Activity extends Component
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
        $aktifitas = TeacherActivity::where('teacher_id', Auth::user()->userTeacher->id)->orderBy('created_at', 'desc')->simplePaginate(10);
        return view('components.user.activity', ['aktifitas' => $aktifitas]);
    }
}
