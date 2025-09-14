
    <div class="form-group">
        @if($label)
            <label for="{{ $name }}">{{ $label }}</label> {!! $dataReq ? '<span class="text-danger">*</span>' : '' !!}
        @endif
        <input
        
            autocomplete="off"
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control form-control-sm override-input"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            data-key="{{ $dataKey }}"
            data="{{ $dataReq }}"
        >
        @if($dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ $label }}</div>
        @endif
    </div>
