@props(['label', 'placeholder', 'textareaId', 'textareaName', 'textareaType'])

<div class="form-group">
    <label for="{{ $textareaId ?? "textarea".(($textareaName)? '-' : '').($textareaName ?? "") }}">{{ $label ?? "" }}</label>
    <textarea  class="form-control" id="{{ $textareaId ?? "textarea".(($textareaName)? '-' : '').($textareaName ?? "") }}" name="{{ $textareaName ?? "" }}" placeholder="{{ ($placeholder ?? $label) ?? "" }}" rows="5"></textarea>
</div>
