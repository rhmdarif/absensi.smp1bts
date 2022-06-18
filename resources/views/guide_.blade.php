<x-server-qr-layout>
    <x-slot name="title">Panduan Penggunaan</x-slot>

    <x-content-wrapper>
        <x-slot name="title">Panduan Penggunaan</x-slot>

        <x-card>
            <h3 class="text-center">Panduan Penggunaan Aplikasi<br> Absensi QR CODE SMP N 1 BATUSANGKAR</h3>


            <div id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Login / Masuk Aplikasi
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Bapak/Ibu guru mengunjungi halaman <a href="{{ route('login') }}">Login</a> aplikasi.</li>
                                <li>Masukan Email dan Password bapak/ibu guru.</li>
                                <li>Klik Tombol <b>Masuk</b></li>
                                <li>Jika informasi yang diberikan valid, bapak/ibu akan dialihkan ke halaman utama.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Scan QR Code
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Pada halaman beranda klik tombol <b>Scan QR</b></li>
                                <li>Izinkan aplikasi mengakses kamera perangkat apabila diperlukan.</li>
                                <li>Arahkan HP ke Kode QR yang ada di komputer server.</li>
                                <li>Jika berhasil, bapak/ibu akan dialihkan ke halaman utama.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Buat Jurnal Aktifitas Harian
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Pada halaman beranda klik tombol <b>Aktifitas</b></li>
                                <li>Klik tombol <b>+ Aktifitas Baru</b></li>
                                <li>Isikan Tanggal Kegiatan, Waktu Kegiatan, Nama Kegiatan, dan Keterangan aktifitas yang bapak/ibu lakukan.</li>
                                <li>Jika berhasil, pesan sukses muncul pada layar. Dan Klik <b>Oke</b></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Pengaktifan Komputer Server Kode QR
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Pada halaman beranda *Hanya akun admin</li>
                                <li>Klik tombol <b>Buka Kode QR Absen</b></li>
                                <li>Apabila aplikasi selalu menampilkan peringatan bahwa komputer belum terdaftar, maka bapak/ibu perlu mendaftarkan komputer server terlebih dahulu.</li>
                                <li>Pilih Absensi yang akan diambil</li>
                                <li>Klik tombol <b>Power ON</b></li>
                                <li>Apabila bapak/ibu ingin mengambil absen lainnya pada hari yang sama, silahkan klik nama absen yang terpilih lalu bapak/ibu klik nama absen yang ingin diambil.</li>
                            </ol>

                            <small>Note:<br>
                                Apabila Kode QR tiba-tiba hilang, silahkan bapak/ibu klik kembali tombol <b>Power ON</b>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Pendaftaran Komputer Server Kode QR
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Masuk ke halaman admin server melalui menu di sebelah kiri, atau jika menggunakan handphone klik tombol bar (strip 3) dikiri atas.</li>
                                <li>Klik Admin</li>
                                <li>Klik Server</li>
                                <li>Klik tombol <b>+ Komputer Server</b></li>
                                <li>Isikan seluruh form &amp; pilih status server (aktif/tidak aktif)</li>
                                <li>Klik tombol <b>Tambah</b></li>
                                <li>Jika berhasil, pesan sukses muncul pada layar. Dan Klik <b>Oke</b></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    </x-content-wrapper>
</x-server-qr-layout>
