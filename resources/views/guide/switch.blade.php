<div class="col-12">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="{{ $id }}" name="{{ $id }}" value="yes" {{ strcasecmp(session($id), 'yes') === 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="{{ $id }}">{{ isset($labelText) ? $labelText : '' }}</label>
    </div>
</div>
