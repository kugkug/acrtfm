@php
    $attrib = $attrib ?? [];
    $name = $attrib['name'] ?? '';
    $label = $attrib['label'] ?? '';
    $dataReq = $attrib['data'] ?? '';
    $text = $attrib['text'] ?? '';
    $attrib_string = '';
    foreach($attrib as $key => $value) {
        $attrib_string .= $key . '="' . $value . '"';
    }
@endphp
<div>
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label> {!! $dataReq ? '<span class="text-danger">*</span>' : '' !!}
        <textarea {!! $attrib_string !!}>{{ $text }}</textarea>
        
        @if($dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ strtolower($label) }}</div>
        @endif
    </div>
</div>