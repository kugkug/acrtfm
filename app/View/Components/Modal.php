<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $footer;
    public $tools;
    public $attrib;
    
    public function __construct(
        string $title = '',
        array $footer = [],
        array $tools = [],
        array $attrib = [],
    )
    {
        $this->title = $title;
        $this->footer = $footer;
        $this->tools = $tools;
        $this->attrib = $attrib;
    }

    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}