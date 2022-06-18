<x-base-layout>
    <x-slot name="title">Laporan Absensi</x-slot>

    <x-content-wrapper>
        <x-slot name="title">Laporan Absensi</x-slot>

        <x-card>
            <x-slot name="title">Laporan Absensi</x-slot>

            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" id="btnExport">Download xls</button>
            </x-slot>


            <form class="row mb-3" method="GET">
                <div class="col-md-6">
                    <x-f-l-input label="Start" placeholder="" inputId="start" inputName="start" inputType="date"></x-f-l-input>
                </div>
                <div class="col-md-6">
                    <x-f-l-input label="End" placeholder="" inputId="end" inputName="end" inputType="date"></x-f-l-input>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="white-space: nowrap;" id="tableReport">
                    <thead>

                        <tr class="text-center">
                            <th rowspan="2" width="30%">Nama</th>

                            @foreach ($masterAbsen as $item)
                                <th colspan="4" style="background-color: rgb(242, 242, 242)">{{ $item->name }}</th>
                            @endforeach
                            <th colspan="4">Summary</th>
                        </tr>
                        <tr class="text-center">
                            @foreach ($masterAbsen as $item)
                                <th style="background-color: rgb(242, 242, 242)">H</th>
                                <th style="background-color: rgb(242, 242, 242)">T</th>
                                <th style="background-color: rgb(242, 242, 242)">S/I</th>
                                <th style="background-color: rgb(242, 242, 242)">A</th>
                            @endforeach
                            <th>H</th>
                            <th>T</th>
                            <th>S/I</th>
                            <th>A</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            @php
                                $absen_val = [
                                    0,0,0,0
                                ];
                            @endphp
                            <tr>
                                <td>{{ $teacher->user->name ?? "" }}</td>

                                @foreach ($masterAbsen as $absen)
                                    @php
                                        $teacherAbsen = $absen->teacherAttends->where('teacher_id', $teacher->id)->first();

                                    @endphp
                                    @if ($teacherAbsen == null)
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        @php
                                            $absen_val[($teacherAbsen->status - 1)]++;
                                            $simbol = "√";
                                        @endphp

                                        <td>
                                            {!! ($teacherAbsen->status == 1)? $simbol : '' !!}
                                        </td>
                                        <td>
                                            {!! ($teacherAbsen->status == 2)? $simbol : '' !!}
                                        </td>
                                        <td>
                                            {!! ($teacherAbsen->status == 3)? $simbol : '' !!}
                                        </td>
                                        <td>
                                            {!! ($teacherAbsen->status == 4)? $simbol : '' !!}
                                        </td>
                                    @endif

                                @endforeach

                                        <td>{{ $absen_val[0] }}</td>
                                        <td>{{ $absen_val[1] }}</td>
                                        <td>{{ $absen_val[2] }}</td>
                                        <td>{{ $absen_val[3] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </x-card>
    </x-content-wrapper>

    <x-slot name="js">
        <script type="text/javascript" src="//unpkg.com/xlsx/dist/shim.min.js"></script>
        <script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

        <script type="text/javascript" src="//unpkg.com/blob.js@1.0.1/Blob.js"></script>
        <script type="text/javascript" src="//unpkg.com/file-saver@1.3.3/FileSaver.js"></script>
        <script type="text/javascript" src="/js/app/lib-sheetjs.js"></script>

        <script>

            $('#btnExport').click(() => {
                // $("#tableReport").table2excel({
                //     name: "Data",
                //     filename: "Report Absensi",
                // });
                let d = new Date;
                doit('tableReport', 'xlsx', 'Report Absensi {{ (!empty(request()->get("start")))? "(". request()->get("start") : "" }}{{ (!empty(request()->get("end")))? " - ".request()->get("end").")" : "" }}.xls')
            });
        </script>
    </x-slot>
</x-base-layout>
