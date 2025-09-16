
@php
    $attrib = $attrib ?? [];
    $class = $attrib['class'] ?? '';
    $id = $attrib['id'] ??  '';
@endphp
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="{{ $class }}" role="document">

        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    {{ $slot }}
                </div>
            
                @if($footer)
                    <div class="modal-footer">
                        @foreach($footer as $footer_item)
                            @php
                                $type = $footer_item['type'];
                                $text = $footer_item['text'];
                                $icon = $footer_item['icon'];
                                $attrib = $footer_item['attrib'];
                            @endphp
                            <x-button
                                :type="$type"
                                :text="$text"
                                :icon="$icon"
                                :attrib="$attrib"
                            />
                        @endforeach
                        
                    </div>
                @endif
            </form>
        </div>
        
    </div>
</div>
