<x-base-layout>
    <x-slot name="title">Aktifitas Guru</x-slot>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/r-2.2.7/datatables.min.css"/>
    </x-slot>

    <x-content-wrapper>
        <x-slot name="title">Aktifitas - {{ $teacher->user->name ?? "" }}</x-slot>

            <!-- The time line -->
            <div class="timeline">
                @foreach ($activity as $key => $item)

                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red">{{ date('d F Y', strtotime($key)) }}</span>
                    </div>
                    <!-- /.timeline-label -->

                    @foreach ($item as $itm)
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-clock bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{ date('H:i', strtotime($itm->period)) }}</span>
                                <h3 class="timeline-header">{{ $itm->title ?? "" }}</h3>

                                <div class="timeline-body">
                                    {{ $itm->description ?? "" }}
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                    @endforeach
                @endforeach
            </div>

    </x-content-wrapper>

</x-base-layout>
