<div>
    <div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label> {!! isset($dataReq) && $dataReq ? '<span class="text-danger">*</span>' : '' !!}
    <textarea
        class="form-control form-control-sm override-textarea"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        data-key="{{ $dataKey }}"
        data="{{ $dataReq }}"
        >{{ $text }}</textarea>
        @if(isset($dataReq) && $dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ strtolower($label) }}</div>
        @endif
    </div>
</div>