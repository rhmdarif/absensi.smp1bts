<x-base-layout>
    <x-slot name="title">Absensi Guru</x-slot>
    <x-lte-content>
        <x-slot name="title">
            @if (isset(auth()->user()->userTeacher))
                Beranda
            @else
                Beranda Admin
            @endif
        </x-slot>

        <div class="row">
            <div class="col-md-12">

                @if (isset(auth()->user()->userTeacher))

                    <x-card class="bg-primary">
                        <marquee><span>Selamat datang bapak/ibu, ini adalah aplikasi pengembangan program PKL ya. Jadi.. kalau ada kekuranganya mohon dimaklumi ya pak/ibu. Terimakasih</span></marquee>
                    </x-card>

                    <x-widget-user style="background: url('{{ asset('bower_components/admin-lte') }}/dist/img/card.jpg')"
                                    class="text-white text-bold"
                                    imgSrc="{{ asset('/') }}{{ auth()->user()->userTeacher->foto ?? 'images/_default.jpg' }}"
                                    userName="{{ auth()->user()->name ?? '' }}"
                                    userDesc="{{ auth()->user()->userTeacher->pekerjaan ?? '' }}">
                    </x-widget-user>
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <a href="{{ route('teacher.absensi.scan') }}" class="btn btn-primary btn-block btn-lg p-4 mt-2">
                                <h5 class="mt-2"><i class="fa fa-qrcode"></i>&nbsp;&nbsp; SCAN QR</h5>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a href="{{ route('teacher.absensi.index') }}" class="btn btn-info btn-block btn-lg p-4 mt-2">
                                <h5 class="mt-2"><i class="fa fa-calendar-check"></i>&nbsp;&nbsp; DAFTAR HADIR</h5>
                            </a>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <a href="{{  route('teacher.activity.index') }}" class="btn btn-success btn-block btn-lg p-4 mt-2">
                                <h5 class="mt-2"><i class="fa fa-chalkboard-teacher"></i>&nbsp;&nbsp; AKTIFITAS</h5>
                            </a>
                        </div>
                        {{-- <div class="col-12">
                            ID TOKEN : <span id="token"></span><br>
                            ID PERMISSION : <span id="permission"></span><br>
                        </div> --}}
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-4">
                            <x-widget-info icon="fa fa-users" teks="Jumlah Guru" nilai="{{ $jumlah_guru ?? 0 }}" warna="info"></x-widget-info>
                        </div>
                        <div class="col-md-4">
                            <x-widget-info icon="fa fa-book" teks="Absen Berlangsung" nilai="{{ $jumlah_absen_berlangsung ?? 0 }}" warna="primary"></x-widget-info>
                        </div>
                        <div class="col-md-4">
                            <x-widget-info icon="fa fa-desktop" teks="Jumlah Komputer" nilai="{{ $jumlah_komputer ?? 0 }}" warna="success"></x-widget-info>
                        </div>
                    </div>
                    <x-card>
                        {{-- <x-slot name="title">Profil Sekolah</x-slot> --}}
                        <h3 class="text-center text-bold mb-3">Profil SMP N 1 BATUSANGKAR</h3>
                        <style>
                            table th {
                                text-align: center;
                            }
                        </style>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th rowspan="5" >Alamat Sekolah</th>
                                        <td colspan="2">Jl Sutan Alam Bagagarsyah No 10 Batusangkar</td>
                                    </tr>
                                    <tr>
                                        <th>Kode POS</th>
                                        <td>27211</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td>Kab. Tanah Datar</td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>Prov. Sumatera Barat</td>
                                    </tr>
                                    <tr>
                                        <th>Negara</th>
                                        <td>Indonesia</td>
                                    </tr>

                                    <tr>
                                        <th rowspan="3">Kontak Sekolah</th>
                                        <th>Telp.</th>
                                        <td>(0752)71034 – 72459</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>info@smpn1bsk.sch.id</td>
                                    </tr>

                                    <tr>
                                        <th>Website</th>
                                        <td>https://smpn1bsk.sch.id</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </x-card>
                @endif
            </div>
        </div>
    </x-lte-content>
</x-base-layout>
