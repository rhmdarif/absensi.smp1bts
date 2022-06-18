<div class="card card-widget widget-user-2 shadow-sm">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div {{ $attributes->merge(['class' => 'widget-user-header']) }}>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ $imgSrc }}" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{ $userName }}</h3>
        <h5 class="widget-user-desc">{{ $userDesc }}</h5>
    </div>

    {{ $slot }}
</div>
