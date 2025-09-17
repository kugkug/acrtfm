
    @php
        $attrib = $attrib ?? [];
        $name = $attrib['name'] ?? '';
        $label = $attrib['label'] ?? '';
        $dataReq = $attrib['dataReq'] ?? '';
        $attrib_string = '';
        foreach($attrib as $key => $value) {
            $attrib_string .= $key . '="' . $value . '"';
        }
    @endphp
    <div class="form-group">
        @if($label)
            <label for="{{ $name }}">{{ $label }}</label> {!! $dataReq ? '<span class="text-danger">*</span>' : '' !!}
        @endif

        <input {!! $attrib_string !!} />
        
        @if($dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ $label ?? $name }}</div>
        @endif
    </div>
