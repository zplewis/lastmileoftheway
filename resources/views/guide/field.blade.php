@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif
<{{ $fieldType ?? 'input'}} type="{{ $inputType ?? 'text' }}" class="form-control"
id="{{ $id }}" name="{{ $id }}" value="{{ $value ?? old($id) }}" />
