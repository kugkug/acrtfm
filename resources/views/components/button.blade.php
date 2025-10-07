@php

    $attrib = $attrib ?? [];
    $attrib_string = '';
    if($attrib) {
        foreach($attrib as $key => $value) {
            $attrib_string .= $key . " = '" . $value . "' ";
        }
    }
@endphp

@if($type == 'button')
    <button {!! $attrib_string !!} >
        @if($icon)
            <i class="fa fa-{{ $icon }}"></i>
        @endif
        @if($text)
        <span class="btn-text">
            {!! $text !!}
        </span>
        @endif
    </button>
@elseif($type == 'link')
    <a {!! $attrib_string !!}>
        @if($icon)
            <i class="fa fa-{{ $icon }}"></i>
        @endif

        @if($text)
            <span class="btn-text">
                {{ $text }}
            </span>
        @endif
        
    </a>
@endif
