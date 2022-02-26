{{-- Nice Blade template for creating form fields easily and consistently --}}
@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif

<select class="form-select" id="{{ $id }}" name="{{ $id }}" aria-label="{{ isset($labelText) ? $labelText : '' }}">
    <option value="" {{ !(session($id) ?? old($id) ?? $value ?? null) ? 'selected' : '' }}>Choose one</option>
    @if (isset($collection))
        @foreach ($collection as $option)
            <option value="{{ $option->id }}"
                {{ strcasecmp((session($id) ?? old($id) ?? $value ?? $placeholder ?? ''), $option->id) === 0 ? 'selected' : '' }}>
                {{ $option->$textProp }}
            </option>
        @endforeach
    @endif
</select>
