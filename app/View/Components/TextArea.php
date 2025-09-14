<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public string $name;
    public string $label;
    public string $value;
    public string $placeholder;
    public string $rows;
    public string $dataKey;
    public string $dataReq;
    public function __construct(
        string $name, 
        string $label = '', 
        string $value = '', 
        string $placeholder = '', 
        string $rows = '3', 
        string $dataKey = '', 
        string $dataReq = ''
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->dataKey = $dataKey;
        $this->dataReq = $dataReq;
    }

    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}