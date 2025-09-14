<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $label;
    public string $type;
    public string $value;
    public string $placeholder;
    public string $dataKey;
    public string $dataReq;

    public function __construct(
        string $name, 
        string $label = '',
        string $type = 'text', 
        string $value = '', 
        string $placeholder = '', 
        string $dataKey = '', 
        string $dataReq = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->dataKey = $dataKey;
        $this->label = $label;
        $this->dataReq = $dataReq;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}