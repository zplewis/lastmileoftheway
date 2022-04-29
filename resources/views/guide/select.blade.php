{{-- Nice Blade template for creating form fields easily and consistently --}}
@if (isset($labelText))
<label for="{{ $id }}" class="form-label">{!! $labelText !!}</label>
@endif

<select class="form-select @error($id) is-invalid @enderror" id="{{ $id }}" name="{{ $id }}"
aria-label="{{ isset($labelText) ? $labelText : '' }}" {{ isset($required) && $required === true ? 'required' : '' }}>
    <option value="" {{ !(old($id) ?? session($id) ?? $value ?? null) ? 'selected' : '' }}>Choose one</option>
    @if (isset($collection))
        @foreach ($collection as $option)
            <option value="{{ $option->id }}"
                @foreach (($dataAttributes ?? []) as $attribute => $value)
                    {{ $attribute }}="{{ $option->$value }}"
                @endforeach
                {{ strcasecmp((old($id) ?? session($id) ?? $value ?? $placeholder ?? ''), $option->id) === 0 ? 'selected' : '' }}>
                {{ $option->$textProp }}{{ isset($textProp2) && $option->$textProp2 ? ' - ' . $option->$textProp2 : '' }}
                {{ isset($textProp3) && $option->$textProp3 ? ' - ' . $option->$textProp3 : '' }}
            </option>
        @endforeach
    @endif
</select>

@error($id)
<!-- show invalid feedback for this field -->
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
