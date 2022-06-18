<div {{ $attributes->merge(['class' => 'card card-default']) }}>
    @if ($title != '')
        <div class="card-header">
            <h3 class="card-title">
                {{ $title ?? "" }}
            </h3>
            {{ $title_right ?? "" }}
        </div>
    @endif
    <!-- /.card-header -->
    <div class="card-body">
        {{ $slot }}
    </div>
    <!-- /.card-body -->
</div>
