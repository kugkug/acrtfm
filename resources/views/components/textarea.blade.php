<div>
    <div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label> {!! $dataReq ? '<span class="text-danger">*</span>' : '' !!}
    <textarea
        class="form-control form-control-sm override-textarea"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        data="{{ $dataReq }}"
        data-key="{{ $dataKey }}"
        >{{ $value }}</textarea>
        @if($dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ strtolower($label) }}</div>
        @endif
    </div>
</div>