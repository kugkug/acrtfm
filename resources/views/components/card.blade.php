@php
    $footer = $footer ?? [];
@endphp
<div class="card">
    <div class="card-body">
        
        @if($title)  
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{!! $title !!}</h5>

                @if($tools && !empty($tools))
                    <div class="card-tools">

                        <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                            <div class='basic-dropdown float-right'>
                                <div class='dropleft'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
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
                                </div>
                            </div>
                        </div>

                        <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>

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