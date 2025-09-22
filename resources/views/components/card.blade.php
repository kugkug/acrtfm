@php
    $footer = $footer ?? [];
@endphp
<div class="card">
    <div class="card-body">
        
        @if($title)  
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{!! $title !!}</h5>
                @if($tools)
                    <div class="card-tools">
                        
                        @foreach($tools as $tool)
                            @php
                                $type = $tool['type'];
                                $text = $tool['text'];
                                $icon = $tool['icon'];
                                $attrib = $tool['attrib'];
                            @endphp
                            <x-button
                                :text="$text"
                                :icon="$icon"
                                :type="$type"
                                :attrib="$attrib"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
        @if($subtitle)
            <p class="card-subtitle">{{ $subtitle }}</p>
        @endif
        
        @if($hr)
            <hr />
        @endif
        
        {{ $slot }}
    </div>
    @if($footer)
        <div class="card-footer">
            
            @foreach($footer as $footer_item)
                @php
                    $type = $footer_item['type'];
                    $text = $footer_item['text'];
                    $icon = $footer_item['icon'];
                    $attrib = $footer_item['attrib'];
                @endphp
                <x-button
                    :text="$text"
                    :type="$type"
                    :attrib="$attrib"
                    :icon="$icon"
                />
            @endforeach
        </div>
    @endif
</div>