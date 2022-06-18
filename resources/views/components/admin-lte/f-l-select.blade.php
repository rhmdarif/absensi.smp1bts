@props(['label', 'selectId', 'selectName'])

<div class="form-group">
    @if (isset($label))
        <label for="{{ $selectId ?? ("select".((isset($selectName))? '-' : '').($selectName ?? "")) }}">{{ $label ?? "" }}</label>
    @endif
    <select class="form-control" id="{{ $selectId ?? "select".((isset($selectName))? '-' : '').($selectName ?? "") }}" name="{{ $selectName ?? "" }}" {!! $attributes !!}>
        {{ $slot }}
    </select>
</div>
