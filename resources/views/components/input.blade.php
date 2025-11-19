
    @php
        $attrib = $attrib ?? [];
        $name = $attrib['name'] ?? '';
        $label = $attrib['label'] ?? '';
        $dataReq = $attrib['data'] ?? '';
        $type = $attrib['type'] ?? 'text';
        $isPassword = $type === 'password';
        $attrib_string = '';
        foreach($attrib as $key => $value) {
            $attrib_string .= $key . '="' . $value . '"';
        }
        if ($isPassword) {
            $attrib_string .= ' style="padding-right: 40px;"';
        }
    @endphp
    <div class="form-group">
        @if($label)
            <label for="{{ $name }}">{{ $label }}</label> {!! $dataReq ? '<span class="text-danger">*</span>' : '' !!}
        @endif

        @if($isPassword)
            <div class="password-input-wrapper" style="position: relative;">
                <input {!! $attrib_string !!} />
                <button type="button" class="password-toggle-btn" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; color: #6c757d;">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
            </div>
        @else
            <input {!! $attrib_string !!} />
        @endif
        
        @if($dataReq)
            <div id="val-{{ $name }}-error" class="invalid-feedback animated fadeInDown">Please provide a {{ $label ?? $name }}</div>
        @endif
    </div>
