
<div class="mt-2 pr-2 pl-2">
    <h4>Absen yang belum diambil</h4>
    <div class="row">
        @if (count($now))
            @foreach ($now as $absensi)
                <div class="col-12 mb-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $absensi->name }}</h5>
                            <p class="card-text">Batas waktu : Hari ini / {{ $absensi->waktu_selesai }} WIB</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary btn-sm btn-block">Ambil Absen</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 mb-2 text-center ">
                <span class="text-muted text-lg-center">Tidak Ada</span>
            </div>
        @endif
    </div>
</div>
<div class="mt-2 pr-2 pl-2">
    <h4>Absen yang akan datang</h4>
    <div class="row">

        @if (count($coming))
            @foreach ($coming as $absensi)
                <div class="col-12 mb-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $absensi->name }}</h5>
                            <p class="card-text">Batas waktu : {{ $absensi->tanggal }} / {{ $absensi->waktu_selesai }} WIB</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary btn-sm btn-block">Ambil Absen</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 mb-2 text-center ">
                <span class="text-muted text-lg-center">Tidak Ada</span>
            </div>
        @endif

    </div>
</div>
