{{-- Nice Blade template for creating form fields easily and consistently --}}

@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif
<!-- https://laravel.com/docs/9.x/validation#the-at-error-directive -->
<{{ $fieldType ?? 'input'}} type="{{ $inputType ?? 'text' }}" class="form-control @error($id) is-invalid @enderror"
id="{{ $id }}" name="{{ $id }}"
{{-- Don't use the session for the 'next-page' input; should be excluded --}}
value="{{ old($id) ?? session($id) ?? $value ?? $placeholder ?? '' }}"
@if(in_array(strtolower($fieldType ?? 'input'), ['text', 'search', 'url', 'tel', 'email', 'password', 'number'], true))
placeholder="{{ $placeholder ?? '' }}"
@endif
{{ isset($required) && $required === true ? 'required' : '' }} {{ isset($pattern) ? 'pattern="' . $pattern . '"' : '' }} />

@error($id)
<!-- show invalid feedback for this field -->
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
