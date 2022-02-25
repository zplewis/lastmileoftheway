{{-- Nice Blade template for creating form fields easily and consistently --}}
@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif
<{{ $fieldType ?? 'input'}} type="{{ $inputType ?? 'text' }}" class="form-control"
id="{{ $id }}" name="{{ $id }}"
{{-- Don't use the session for the 'next-page' input; should be excluded --}}
value="{{ session($id) ?? old($id) ?? $value ?? $placeholder ?? '' }}"
placeholder="{{ $placeholder ?? '' }}" {{ isset($required) && $required === true ? 'required' : '' }} />
