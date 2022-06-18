<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FLSelect extends Component
{
    public $label;
    public $selectId;
    public $selectName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label="", $selectId="", $selectName="")
    {
        //
        $this->label = $label;
        $this->selectId = $selectId;
        $this->selectName = $selectName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.f-l-select');
    }
}
