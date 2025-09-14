<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $text;
    public $action;
    public $class;
    public $icon;
    public function __construct(
        string $text, 
        string $action, 
        string $class = 'btn-primary', 
        string $icon = '',
    )
    {
        $this->text = $text;
        $this->action = $action;
        $this->class = $class;
        $this->icon = $icon;
    }


    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}