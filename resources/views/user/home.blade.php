<x-user-layout>
    <x-slot name="title">Login</x-slot>

    <x-user-header-layout></x-user-header-layout>
    <x-user-bottom-menu-layout></x-user-bottom-menu-layout>

    <x-userLayout::profile-stat/>
    <x-userLayout::profile-bio/>


    <div class="section full">
        <div class="wide-block transparent p-0">
            <ul class="nav nav-tabs lined iconed" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#feed" role="tab">
                        <ion-icon name="alarm-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#friends" role="tab">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#bookmarks" role="tab">
                        <ion-icon name="analytics-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                        <ion-icon name="settings-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <!-- tab content -->
    <div class="section full mb-2">
        <div class="tab-content">

            <!-- feed -->
            <div class="tab-pane fade show active" id="feed" role="tabpanel">

                <div class="mt-2 pr-2 pl-2">
                    <h4>Absen yang sedang berlangsung</h4>
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
                                            @if (in_array($absensi->id, $has_take->toArray()))
                                                <a href="#" class="btn btn-success btn-sm btn-block">Telah diambil</a>
                                            @else
                                                <a href="javascript:CaraAbsensi({{ $absensi->id }});" class="btn btn-primary btn-sm btn-block">Ambil Absen</a>
                                            @endif
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
                                            <a href="#" class="btn btn-secondary btn-sm btn-block">Menunggu</a>
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

            </div>
            <!-- * feed -->

            <!-- * friends -->
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <x-userLayout::riwayat-absensi/>
            </div>
            <!-- * friends -->

            <!--  bookmarks -->
            <div class="tab-pane fade" id="bookmarks" role="tabpanel">

                <x-userLayout::activity/>
            </div>
            <!-- * bookmarks -->


            <!-- settings -->
            <div class="tab-pane fade" id="settings" role="tabpanel">
                <ul class="listview image-listview text flush transparent pt-1">
                    <li>
                        <a href="javascript:;" onclick="$('#actionSheetFormChangePassword').modal('show');" class="item">
                            <div class="in">
                                <div class="text-danger">Ubah Kata Sandi</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- * settings -->
        </div>
    </div>
    <!-- * tab content -->



            <!-- SCAN -->
            <div class="modal fade action-sheet" id="actionSheetContent" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Scan QR Absensi</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content " style="max-height: 100%;">
                                <div id="qr-reader" class=" align-items-center" style="height: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * SCAN -->


            <!-- TAMBAH AKTIFITAS -->
            <div class="modal fade action-sheet" id="actionSheetForm" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Aktifitas</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content" style="max-height: 100%;">
                                <form id="modalCreate_form">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="title">Tanggal Kegiatan</label>
                                            <input type="date" name="date" class="form-control" id="title"
                                                placeholder="Tanggal Kediatan">
                                            <i class="clear-input">
                                                <ion-icon name="calendar-number-outline"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukan Tanggal Legiatan</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group basic">
                                                <div class="input-wrapper">
                                                    <label class="label" for="waktu_mulai">Waktu Mulai</label>
                                                    <input type="time" name="time_in" class="form-control" id="waktu_mulai"
                                                        placeholder="Tanggal Kediatan">
                                                    <i class="clear-input">
                                                        <ion-icon name="calendar-number-outline"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group basic">
                                                <div class="input-wrapper">
                                                    <label class="label" for="waktu_selesai">Waktu Selesai</label>
                                                    <input type="time" name="time_out" class="form-control" id="waktu_selesai"
                                                        placeholder="Tanggal Kediatan">
                                                    <i class="clear-input">
                                                        <ion-icon name="calendar-number-outline"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="title">Kegiatan</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Nama Kegiatan">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukan Nama Legiatan</div>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="description">Keterangan</label>
                                            <textarea name="description" id="description" placeholder="Tuliskan keterangan kegiatan" class="form-control" cols="30" rows="4"></textarea>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm btn-lg"
                                            data-dismiss="modal">Tambahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * TAMBAH AKTIFITAS -->

            <!-- UBAH AKTIFITAS -->
            <div class="modal fade action-sheet" id="actionUbahAktifitas" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Aktifitas</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content" style="max-height: 100%;">
                                <form id="modalEdit_form">
                                    @method('PUT')
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="title">Tanggal Kegiatan</label>
                                            <input type="date" name="date" class="form-control" id="title"
                                                placeholder="Tanggal Kediatan">
                                            <i class="clear-input">
                                                <ion-icon name="calendar-number-outline"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukan Tanggal Legiatan</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group basic">
                                                <div class="input-wrapper">
                                                    <label class="label" for="waktu_mulai">Waktu Mulai</label>
                                                    <input type="time" name="time_in" class="form-control" id="waktu_mulai"
                                                        placeholder="Tanggal Kediatan">
                                                    <i class="clear-input">
                                                        <ion-icon name="calendar-number-outline"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group basic">
                                                <div class="input-wrapper">
                                                    <label class="label" for="waktu_selesai">Waktu Selesai</label>
                                                    <input type="time" name="time_out" class="form-control" id="waktu_selesai"
                                                        placeholder="Tanggal Kediatan">
                                                    <i class="clear-input">
                                                        <ion-icon name="calendar-number-outline"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="title">Kegiatan</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Nama Kegiatan">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                        <div class="input-info">Masukan Nama Legiatan</div>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="description">Keterangan</label>
                                            <textarea name="description" id="description" placeholder="Tuliskan keterangan kegiatan" class="form-control" cols="30" rows="4"></textarea>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm btn-lg"
                                            data-dismiss="modal">Tambahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * TAMBAH AKTIFITAS -->

            <!-- UBAH KATA SANDI -->
            <div class="modal fade action-sheet" id="actionSheetFormChangePassword" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Password</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content" style="max-height: 100%;">
                                <form id="modalUpdate_password">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="new">Kata Sandi Baru</label>
                                            <input type="password" name="new" class="form-control" id="new"
                                                placeholder="">
                                        </div>
                                        <div class="input-info">Masukan Kata Sandi Baru</div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="confirm">Kata Sandi Baru</label>
                                            <input type="password" name="confirm" class="form-control" id="confirm"
                                                placeholder="">
                                        </div>
                                        <div class="input-info">Ulangi Kata Sandi Baru</div>
                                    </div>
                                    <br>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="old">Kata Sandi Lama</label>
                                            <input type="password" name="old" class="form-control" id="old"
                                                placeholder="">
                                        </div>
                                        <div class="input-info">Masukan Kata Sandi Lama untuk verifikasi.</div>
                                    </div>

                                    <div class="form-group basic">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm btn-lg"
                                            data-dismiss="modal">Tambahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * UBAH KATA SANDI -->

            <!-- OPSI ABSENSI -->
            <div class="modal fade action-sheet" id="actionSheetIconed" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PILIH CARA PENGAMBILAN ABSENSI</h5>
                        </div>
                        <div class="modal-body">
                            <ul class="action-button-list">
                                <li>
                                    <a href="javascript:;" class="btn btn-list text-primary" data-dismiss="modal"  data-toggle="modal" data-target="#actionSheetContent">
                                        <span>
                                            <ion-icon name="qr-code-outline"></ion-icon>
                                            SCAN KODE QR
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="manual" class="btn btn-list" data-dismiss="modal">
                                        <span>
                                            <ion-icon name="document-outline"></ion-icon>
                                            MANUAL
                                        </span>
                                    </a>
                                </li>
                                <li class="action-divider"></li>
                                <li>
                                    <a href="#" class="btn btn-list text-danger" data-dismiss="modal">
                                        <span>
                                            <ion-icon name="close-outline"></ion-icon>
                                            TUTUP
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * OPSI ABSENSI -->


            <!-- ABSENSI MANUAL -->
            <div class="modal fade action-sheet" id="actionSheetFormAbsensiManual" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Absensi Manual</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content" style="max-height: 100%;">
                                <form id="modalabsensi_manual">
                                    <input type="hidden" name="absen_id" id="absen_id">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="status">Status Kehadiran</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Pilih Absen</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" placeholder="Tuliskan keterangan kegiatan" class="form-control" cols="30" rows="4"></textarea>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>

                                    <div class="form-group basic">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm btn-lg"
                                            data-dismiss="modal">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * ABSENSI MANUAL -->


            <!-- MENU AKTIFITAS DELETE/EDIT -->
            <div class="modal fade action-sheet" id="actionAktifitas" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">AKSI</h5>
                        </div>
                        <div class="modal-body">
                            <ul class="action-button-list">
                                <li>
                                    <a href="javascript:;" class="btn btn-list" onclick="edit_aktifitas()">
                                        <span>
                                            <ion-icon name="pencil"></ion-icon>
                                            UBAH
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="btn btn-list" onclick="$('#actionAktifitas').modal('hide');confirm_box('hapus_aktifitas', 'Apakah anda yakin ingin mengapus aktifitas ini?')">
                                        <span>
                                            <ion-icon name="trash"></ion-icon>
                                            HAPUS
                                        </span>
                                    </a>
                                </li>
                                <li class="action-divider"></li>
                                <li>
                                    <a href="#" class="btn btn-list text-danger" data-dismiss="modal">
                                        <span>
                                            <ion-icon name="close-outline"></ion-icon>
                                            TUTUP
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- * Iconed Action Sheet -->

    <x-slot name="js">
        @include('layouts.user.user-messages-modal')

        <script>
            const TEACHER_ID = {{ auth()->user()->userTeacher->id }}

            const actionSheetForm = $('#actionSheetForm');
            actionSheetForm.find('button').click(() => {

                DIALOG_SUCCESS.modal('hide');
                DIALOG_DANGER.modal('hide');
                DIALOG_INFO.modal('hide');
                var form = new FormData(document.getElementById('modalCreate_form'));
                fetch("{{ route('teacher.activity.store') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        $('input').val('')
                        $('select').val('')
                        $('textarea').val('')

                        DIALOG_SUCCESS.find('.modal-body').text(json.msg);
                        DIALOG_SUCCESS.modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);

                    } else {
                        DIALOG_DANGER.find('.modal-body').text(json.msg);
                        DIALOG_DANGER.modal('show');
                    }
                });

            });


            const actionSheetFormChangePassword = $('#actionSheetFormChangePassword');
            actionSheetFormChangePassword.find('button').click(() => {

                DIALOG_SUCCESS.modal('hide');
                DIALOG_DANGER.modal('hide');
                DIALOG_INFO.modal('hide');
                var form = new FormData(document.getElementById('modalUpdate_password'));
                fetch("{{ route('teacher.account.password') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        $('input').val('')
                        $('select').val('')
                        $('textarea').val('')

                        DIALOG_SUCCESS.find('.modal-body').text(json.msg);
                        DIALOG_SUCCESS.modal('show');

                        setTimeout(() => {
                            DIALOG_SUCCESS.modal('hode');
                        }, 1500);

                    } else {
                        DIALOG_DANGER.find('.modal-body').text(json.msg);
                        DIALOG_DANGER.modal('show');
                    }
                });

            });
            var absen_id = 0;
            const actionSheetIconed = $('#actionSheetIconed');
            const CaraAbsensi = (id) => {
                console.log(id)
                absen_id = id;
                actionSheetIconed.modal('show');
            }

            const manualOpsi = $('#manual');
            const actionSheetFormAbsensiManual = $('#actionSheetFormAbsensiManual');
            manualOpsi.click(() => {
                $('#absen_id').val(absen_id);
                actionSheetFormAbsensiManual.modal('show');
            });

            actionSheetFormAbsensiManual.find('button').click(() => {
                console.log('ada?');
                DIALOG_SUCCESS.modal('hide');
                DIALOG_DANGER.modal('hide');
                DIALOG_INFO.modal('hide');
                var form = new FormData(document.getElementById('modalabsensi_manual'));
                fetch("{{ route('teacher.manual.store') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        $('input').val('')
                        $('select').val('')
                        $('textarea').val('')

                        DIALOG_SUCCESS.find('.modal-body').text(json.msg);
                        DIALOG_SUCCESS.modal('show');

                        setTimeout(() => {
                            DIALOG_SUCCESS.modal('hide');
                        }, 1500);

                    } else {
                        DIALOG_DANGER.find('.modal-body').text(json.msg);
                        DIALOG_DANGER.modal('show');
                    }
                });
            })

            const actionUbahAktifitas = $('#actionUbahAktifitas');
            function edit_aktifitas() {
                let aktifitas_id = $('#actionAktifitas').attr('data-id');
                $('#actionAktifitas').modal('hide');

                $.get("{{ route('teacher.activity.index') }}/"+aktifitas_id, (result) => {
                    actionUbahAktifitas.find('input[name=date]').val(result.period);
                    actionUbahAktifitas.find('input[name=time_in]').val(result.start_at);
                    actionUbahAktifitas.find('input[name=time_out]').val(result.end_at);
                    actionUbahAktifitas.find('input[name=title]').val(result.title);
                    actionUbahAktifitas.find('textarea[name=description]').val(result.description);
                    actionUbahAktifitas.modal('show');
                });
            }

            actionUbahAktifitas.find('button').click(() => {
                let aktifitas_id = $('#actionAktifitas').attr('data-id');

                DIALOG_SUCCESS.modal('hide');
                DIALOG_DANGER.modal('hide');
                DIALOG_INFO.modal('hide');
                var form = new FormData(document.getElementById('modalEdit_form'));
                fetch("{{ route('teacher.activity.index') }}/"+aktifitas_id, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        $('input').val('')
                        $('select').val('')
                        $('textarea').val('')

                        DIALOG_SUCCESS.find('.modal-body').text(json.msg);
                        DIALOG_SUCCESS.modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);

                    } else {
                        DIALOG_DANGER.find('.modal-body').text(json.msg);
                        DIALOG_DANGER.modal('show');
                    }
                });

            })


            function callback_delete_activity() {
                console.log('ada kagka?');
                let aktifitas_id = $('#actionAktifitas').attr('data-id');
                $.post("{{ route('teacher.activity.index') }}/"+aktifitas_id, {_method:"DELETE"}, (result) => {
                    DIALOG_CONFIRM.modal('hide');

                    DIALOG_SUCCESS.find('.modal-body').text(result.msg);
                    DIALOG_SUCCESS.modal('show');

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
            }

            $(document).ready(function() {

                var act_i = 0, act_timeOut = 0;

                $('.activity-item').on('mousedown touchstart', function(e) {
                    act_timeOut = setInterval(function(){
                        act_i++
                        if(act_i == 5) {
                            $('#actionAktifitas').attr('data-id', $(e.currentTarget).attr('data-id'));
                            $('#actionAktifitas').modal('show');
                            clearInterval(act_timeOut);
                        }
                    }, 100);
                }).bind('mouseup mouseleave touchend', function() {
                    act_i=0;
                    clearInterval(act_timeOut);
                });

            });
        </script>
        <script src="/js/html5-qrcode.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.0/socket.io.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/app/teacher-scan.js"></script>
    </x-slot>

</x-user-layout>
