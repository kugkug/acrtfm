<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public array $attrib;

    public function __construct(
        array $attrib, 
    ) {
        $this->attrib = $attrib;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}