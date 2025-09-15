<div class="card">
    <div class="card-body">
        
        @if($title)  
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ $title }}</h5>
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
            {{-- @foreach($footer as $footer_item)
                @php
                    $footer_item = explode('|', $footer_item);
                    $footer_item_text = $footer_item[0];
                    $footer_item_type = $footer_item[1];
                    $footer_item_attributes = $footer_item[2] ?? 'btn-primary';
                    $footer_item_icon = $footer_item[3] ?? '';
                    $footer_item_attributes = $footer_item[4] ?? [];
                    $footer_item_attributes = $footer_item[5] ?? '';
                @endphp

                <x-button
                    :text="$footer_item_text"
                    :type="$footer_item_type"
                    :attributes="$footer_item_attributes"
                    :icon="$footer_item_icon"
                />
            @endforeach --}}
        </div>
    @endif
</div>