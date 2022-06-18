@php
    switch ($type) {
        case 'success':
            $icon = 'fa-check';
            break;
        case 'info':
            $icon = 'fa-info';
            break;
        case 'danger':
            $icon = 'fa-ban';
            break;
        case 'warning':
            $icon = 'fa-exclamation-triangle';
            break;

        default:
            $icon = 'fa-info';
            break;
    }
@endphp
<div class="alert alert-{{ $type ?? "info" }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas {{ $icon }}"></i> {{ $title ?? "" }}</h5>
    {{ $slot }}
</div>
