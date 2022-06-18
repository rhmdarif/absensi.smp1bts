<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseLayout extends Component
{
    public $withoutNav;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($withoutNav=false)
    {
        //
        $this->withoutNav = $withoutNav;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.base-layout');
    }
}
