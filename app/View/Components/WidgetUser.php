<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WidgetUser extends Component
{
    public $imgSrc;
    public $userName;
    public $userDesc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($imgSrc='', $userDesc='', $userName=false)
    {
        //
        $this->imgSrc = $imgSrc;
        $this->userName = $userName;
        $this->userDesc = $userDesc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.widget-user');
    }
}
