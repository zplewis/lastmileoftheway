{{-- Nice Blade template for creating form fields easily and consistently --}}
@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif

<select class="form-select" id="{{ $id }}" name="{{ $id }}" aria-label="{{ isset($labelText) ? $labelText : '' }}">
    <option {{ !(session($id) ?? old($id) ?? $value ) ? 'selected' : '' }}>Choose one</option>
    @if (isset($collection))
        @foreach ($collection as $option)
            <option value="{{ $option->id }}"
                {{ strcasecmp((session($id) ?? old($id) ?? $value ?? $placeholder ?? ''), $option->id) === 0 ? 'selected' : '' }}>
            </option>
        @endforeach
    @endif
</select>


<{{ $fieldType ?? 'input'}} type="{{ $inputType ?? 'text' }}" class="form-control"
id="{{ $id }}" name="{{ $id }}"
{{-- Don't use the session for the 'next-page' input; should be excluded --}}
value="{{ session($id) ?? old($id) ?? $value ?? $placeholder ?? '' }}"
placeholder="{{ $placeholder ?? '' }}" {{ isset($required) && $required === true ? 'required' : '' }} />
