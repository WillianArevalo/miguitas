<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeadBand extends Component
{
    public $headBand;
    /**
     * Create a new component instance.
     */
    public function __construct($headBand)
    {
        $this->headBand = $headBand;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.head-band');
    }
}