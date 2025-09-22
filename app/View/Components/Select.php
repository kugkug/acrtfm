<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $attrib;
    public $options;
    public $label;
    public $attrib_string;
    public $selected;
    
    public function __construct(array $attrib, array $options, string $label, string $selected = '')
    {
        $this->attrib = $attrib;
        $this->options = $options;
        $this->label = $label;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->attrib_string = "";
        foreach ($this->attrib as $key => $value) {
            $this->attrib_string .= "$key='$value' ";
        }

        return <<<'blade'
            <div class="form-group">
                <label>{{ $label }} {!! $attrib['data'] ? '<span class="text-danger">*</span>' : '' !!} </label>
                <select {!! $attrib_string !!}>
                    <option value="">Select {{ !$label ? 'Select' : $label }}</option>
                    @foreach ($options as $option)
                        <option value="{{ $option['id'] }}" {{ $selected == $option['id'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
                    @endforeach
                </select>
                @if($attrib['data'])
                    <div id="val-{{ $attrib['name'] }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ $label ?? $name }}</div>
                @endif
            </div>
        blade;
    }
}