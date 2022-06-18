<?php

namespace App\View\Components\User;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class ProfileBio extends Component
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
        return view('components.user.profile-bio', ['user' => Auth::user()]);
    }
}
