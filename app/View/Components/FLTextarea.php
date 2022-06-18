<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FLTextarea extends Component
{
    public $label;
    public $placeholder;
    public $textareaId;
    public $textareaName;
    public $textareaType;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null,$placeholder=null,$textareaId=null,$textareaName=null,$textareaType=null)
    {
        //
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->textareaId = $textareaId;
        $this->textareaName = $textareaName;
        $this->textareaType = $textareaType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.f-l-textarea');
    }
}
