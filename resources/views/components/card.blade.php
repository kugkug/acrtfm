<div class="card">
    <div class="card-body">
        @if(isset($title) && $title != '')  
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ $title }}</h5>
                @if(isset($tools) && $tools != '')
                    <div class="card-tools">
                        @foreach(explode(',', $tools) as $tool)
                            @php
                                $tool = explode('|', $tool);
                                $tool_text = $tool[0];
                                $tool_action = $tool[1];
                                $tool_class = $tool[2];
                                $tool_icon = $tool[3];
                            @endphp

                            <x-button
                                text="{{ $tool_text }}"
                                action="{{ $tool_action }}"
                                class="{{ $tool_class }}"
                                icon="{{ $tool_icon }}"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
        @if(isset($subtitle) && $subtitle != '')
            <p class="card-subtitle">{{ $subtitle }}</p>
        @endif
        
        @if(isset($hr) && $hr != '')
            <hr />
        @endif
        
        {{ $slot }}
    </div>
    @if(isset($footer) && $footer != '')
        <div class="card-footer">
            @foreach(explode(',', $footer) as $footer_item)
                @php
                    $footer_item = explode('|', $footer_item);
                    $footer_item_text = $footer_item[0];
                    $footer_item_action = $footer_item[1];
                    $footer_item_class = isset($footer_item[2]) ? $footer_item[2] : 'btn-primary';
                    $footer_item_icon = isset($footer_item[3]) ? $footer_item[3] : '';
                @endphp

                <x-button
                    text="{{ $footer_item_text }}"
                    action="{{ $footer_item_action }}"
                    class="{{ $footer_item_class }}"
                    icon="{{ $footer_item_icon }}"
                />
            @endforeach
        </div>
    @endif
</div>