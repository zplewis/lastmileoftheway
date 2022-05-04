{{-- Nice Blade template for creating form fields easily and consistently --}}

@php
    if (!isset($fieldType)) {
        $fieldType = 'input';
    }

    if (!isset($inputType)) {
        $inputType = 'text';
    }
@endphp

@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif
<!-- https://laravel.com/docs/9.x/validation#the-at-error-directive -->
<{{ $fieldType }} type="{{ $inputType ?? 'text' }}" class="form-control @if(strcasecmp($inputType, 'hidden') !== 0) @error($id) is-invalid @enderror @endif"
id="{{ $id }}" name="{{ $id }}"
{{-- Don't use the session for the 'next-page' input; should be excluded --}}
value="{{ old($id) ?? session($id) ?? $value ?? $placeholder ?? '' }}"
@if(in_array(strtolower($inputType), ['text', 'search', 'url', 'tel', 'email', 'password', 'number'], true))
placeholder="{{ $placeholder ?? '' }}"
@endif
{{ isset($required) && $required === true ? 'required' : '' }} {{ isset($pattern) ? 'pattern="' . $pattern . '"' : '' }} />

@error($id)
    <!-- show invalid feedback for this field -->
    @if(strcasecmp($inputType, 'hidden') !== 0)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @endif
@enderror
