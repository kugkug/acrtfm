<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $subtitle;
    public $tools;
    public $footer;
    public $hr;
    public function __construct(string $title='', string $subtitle = '', string $footer = '', string $hr = '', string $tools = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->footer = $footer;
        $this->hr = $hr;
        $this->tools = $tools;
    }

    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}