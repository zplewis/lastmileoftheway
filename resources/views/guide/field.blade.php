@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif
<{{ $fieldType ?? 'input'}} type="{{ $inputType ?? 'text' }}" class="form-control"
id="{{ $id }}" name="{{ $id }}" value="{{ session($id) ?? old($id) ?? $value ?? $placeholder ?? '' }}"
placeholder="{{ $placeholder ?? '' }}" {{ isset($required) && $required === true ? 'required' : '' }} />
