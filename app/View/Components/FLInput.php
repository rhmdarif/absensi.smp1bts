<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FLInput extends Component
{
    public $label;
    public $placeholder;
    public $inputId;
    public $inputName;
    public $inputType;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null,$placeholder=null,$inputId=null,$inputName=null,$inputType=null)
    {
        //
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->inputId = $inputId;
        $this->inputName = $inputName;
        $this->inputType = $inputType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.f-l-input');
    }
}
