<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $text;
    public $icon;    
    public $attrib;
    
    public function __construct(
        string $type='button',
        string $text ='', 
        string $icon = '',
        array $attrib = []
    )
    {
        $this->text = $text;
        $this->icon = $icon;
        $this->type = $type;
        $this->attrib = $attrib;
    }


    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}