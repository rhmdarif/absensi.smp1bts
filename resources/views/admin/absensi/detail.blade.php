<x-base-layout>
    <x-slot name="title">Detail Absen {{ $absensi->name ?? "" }}</x-slot>
    <x-content-wrapper>
        <x-slot name="title">Detail Absen {{ $absensi->name ?? "" }}</x-slot>

        <x-card>
            <x-slot name="title">Absen - {{ $absensi->name ?? "" }}</x-slot>

            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" id="btnExport">Download xls</button>
            </x-slot>


            <div class="table-responsive">
                <table class="table table-bordered" id="tableReport">
                    <thead class="text-center">
                        <tr>
                            <th>Nama</th>
                            <th width="10%">Status</th>
                            <th width="10%">Via</th>
                            <th width="200px">Hari / Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($absensi->teacherAttends->count() > 0)
                            @foreach ($absensi->teacherAttends as $absen)
                                <tr>
                                    <td>{{ $absen->teacher->user->name ?? "-" }}</td>
                                    <td class="text-center">{!! ($absen->status == 1)? '<span class="badge badge-success">Hadir</span>' : (($absen->status == "2")? '<span class="badge badge-warning">Terlambat</span>' : '<span class="badge badge-danger">Alfa</span>') !!}</td>
                                    <td>{{ ($absen->is_manual)? 'Manual' : "Scan QR" }}</td>
                                    <td>{{ $absen->created_at ?? "" }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada absensi Hari ini</td>
                            </tr>
                        @endif
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
                doit('tableReport', 'xlsx', 'Detail Absen - {{ $absensi->name ?? "" }} ({{ $absensi->created_at ?? "" }}).xls')
            });
        </script>
    </x-slot>
</x-base-layout>
