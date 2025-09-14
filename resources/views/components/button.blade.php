<button 
    class="btn btn-flat {{ $class }}" 
    type="button" 
    data-trigger="{{ $action }}"
    title="{{ $text }}"
>
    @if($icon)
        <i class="fa fa-{{ $icon }}"></i>
        @endif
    @if($text)
    <span class="btn-text">
        {{ $text }}
    </span>
    @endif
</button>