<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentWrapper extends Component
{
    public $withoutContentHeader;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($withoutContentHeader=false)
    {
        //
        $this->withoutContentHeader = $withoutContentHeader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.content-wrapper');
    }
}
