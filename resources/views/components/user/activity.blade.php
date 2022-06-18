
<!-- timeline -->
    @if (count($aktifitas))
    <div class="mt-2"></div>
    @foreach ($aktifitas->groupBy('period') as $date => $activity)
        <button class="btn btn-secondary ml-3">{{ date('d F Y', strtotime($date)) }}</button>
        <div class="timeline timed">
                @foreach ($activity as $item)
                    <div class="item p-1 activity-item" data-id="{{ $item->id }}">
                        <span class="time">{{ $item->start_at }} <hr> {{ $item->end_at }}</span>
                        <div class="dot"></div>
                        <div class="content">
                            <h4 class="title">{{ $item->title }}</h4>
                            <div class="text">{{ $item->description }}</div>
                        </div>
                    </div>
                @endforeach
        </div>

    @endforeach
{!! $aktifitas->links() !!}
    @else
        <div class="mt-2 pr-2 pl-2">Tidak Ada Aktifitas</div>
    @endif
<!-- * timeline -->
