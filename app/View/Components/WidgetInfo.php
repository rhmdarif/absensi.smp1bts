<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WidgetInfo extends Component
{
    public $icon;
    public $teks;
    public $nilai;
    public $warna;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon="", $teks="", $nilai="", $warna="")
    {
        //
        $this->icon = $icon;
        $this->teks = $teks;
        $this->nilai = $nilai;
        $this->warna = $warna;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-lte.widget-info');
    }
}
