@props(['label', 'placeholder', 'inputId', 'inputName', 'inputType'])

<div class="form-group">
    @if (isset($label))
        <label for="{{ $inputId ?? "input".(($inputName)? '-' : '').($inputName ?? "") }}">{{ $label ?? "" }}</label>
    @endif
    <input type="{{ $inputType ?? "text" }}" class="form-control" id="{{ $inputId ?? "input".(($inputName)? '-' : '').($inputName ?? "") }}" name="{{ $inputName ?? "" }}" placeholder="{{ ($placeholder ?? $label) ?? "" }}" {!! $attributes !!}>
</div>
