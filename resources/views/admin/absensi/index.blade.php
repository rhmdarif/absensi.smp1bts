<x-base-layout>
    <x-slot name="title">Daftar Absen</x-slot>
    <x-slot name="css">

        <!-- Select2 -->
        <link rel="stylesheet" href="/bower_components/admin-lte/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    </x-slot>

    <x-content-wrapper>
        <x-slot name="title">Daftar Absen</x-slot>

        <x-card>
            <x-slot name="title">Daftar Absen</x-slot>

            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreate">+ Absen Baru</button>
            </x-slot>

            <form id="formFilter" lang="id">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Cari Periode" inputId="period" inputName="period" inputType="week"></x-f-l-input>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-primary float-right mb-3" id="btn_filter">Cari</button>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Absen</th>
                            <th>Hari / Tanggal</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>Hadir</th>
                            <th>Terlambat</th>
                            <th>Izin/Sakit</th>
                            <th>Tanpa Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada absensi Hari ini</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal id="modalCreate" title="Tambah Absen">
            <form id="modalCreate_form">
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Tanggal Absen" placeholder="Tanggal Absen" inputId="modalCreate_date" inputName="date" inputType="date"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Mulai" placeholder="Waktu Mulai Absen" inputId="modalCreate_time_start" inputName="t_start" inputType="time"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Selesai" placeholder="Waktu Selesai Absen" inputId="modalCreate_time_end" inputName="t_end" inputType="time"></x-f-l-input>
                    </div>
                </div>
                <x-f-l-input label="Nama Absen" placeholder="Masukan nama Absen" inputId="modalCreate_title" inputName="name" inputType="text"></x-f-l-input>

                <div class="form-group">
                    <label>Komputer Pengambilan Absensi</label>
                    <select class="select2bs4" multiple="multiple" name="server_coms[]" data-placeholder="Pilih komputer" style="width: 100%;">
                        @foreach ($server_coms as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="justify-content-between float-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" name="submit">Save changes</button>
                </div>
            </form>
        </x-modal>
        <x-modal id="modalEdit" title="Ubah Absen">
            <form id="modalEdit_form">
                @method("PUT")
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Tanggal Absen" placeholder="Tanggal Absen" inputId="modalEdit_date" inputName="date" inputType="date"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Mulai" placeholder="Waktu Mulai Absen" inputId="modalEdit_time_start" inputName="t_start" inputType="time"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Selesai" placeholder="Waktu Selesai Absen" inputId="modalEdit_time_end" inputName="t_end" inputType="time"></x-f-l-input>
                    </div>
                </div>
                <x-f-l-input label="Nama Absen" placeholder="Masukan nama Absen" inputId="modalEdit_name" inputName="name" inputType="text"></x-f-l-input>
                <x-f-l-select label="Status" selectId="modalEdit_status" selectName="status">
                    <option value="">Pilih Status Absen</option>
                    @foreach ([0,1,2] as $item)
                        <option value="{{ $item ?? "" }}">{{ ($item == 2)? "Selesai" : (($item == 1)? "Masih berlangsung" : "Menunggu") }}</option>
                    @endforeach
                </x-f-l-select>

                <div class="form-group">
                    <label>Komputer Pengambilan Absensi</label>
                    <select class="select2bs4" multiple="multiple" name="server_coms[]" id="server_com_edit" data-placeholder="Pilih komputer" style="width: 100%;">
                        @foreach ($server_coms as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="justify-content-between float-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" name="submit">Save changes</button>
                </div>
            </form>
        </x-modal>
    </x-content-wrapper>

    <x-slot name="js">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/app/lib.js"></script>
        <!-- Select2 -->
        <script src="/bower_components/admin-lte/plugins/select2/js/select2.full.min.js"></script>
        <script>
            const Table = $('table');
            const ModalCreate = $('#modalCreate');
            const ButtonCreate = ModalCreate.find('button[name=submit]');
            const ModalEdit = $('#modalEdit');
            const ButtonEdit = ModalEdit.find('button[name=submit]');
            var EditId;

            $(document).ready(() => {
                loadData();
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            })

            function insertTable(data) {
                let d = new Date(data.created_at);

                if(data.status == 2) {
                    bs_text = "Telah Selesai";
                    bs_type = "danger";
                } else if(data.status == 1) {
                    bs_text = "Sdg. Berlangsung";
                    bs_type = "success";
                } else {
                    bs_text = "Menunggu";
                    bs_type = "warning";
                }
                return `<tr>
                            <td>${data.name}</td>
                            <td>${getDayName(d.getDay())} / ${d.getDate()}-${d.getMonth()}-${d.getUTCFullYear()}</td>
                            <td>${data.waktu_mulai}</td>
                            <td>${data.waktu_selesai}</td>
                            <td>${data.total_hadir}</td>
                            <td>${data.total_terlambat}</td>
                            <td>${data.total_izin}</td>
                            <td>${data.total_tdk_hadir}</td>

                            <td>${badgeStatus(bs_text, bs_type)}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" onclick="window.location.href='/admin/absensi/detail/${data.id}'" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" onclick="openModalEdit(${data.id})" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" onclick="hapus(${data.id})" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>`;
            }

            async function loadData() {
                await fetch('{{ route("admin.absensi.load.data") }}')
                .then(res => res.json())
                .then(json => {
                    console.log(json)
                    if(json.status) {
                        let html = "";
                        json.datas.forEach(el => {
                            html += insertTable(el)
                        });

                        Table.find('tbody').html(html)
                    } else {
                        Swal.fire("Ohh!", json.msg, 'warning');
                    }
                })
            }

            $('#btn_filter').click(async () => {

                let form = new FormData(document.getElementById('formFilter'));
                await fetch('{{ route("admin.absensi.load.data") }}', {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                })
                .then(res => res.json())
                .then(json => {
                    let tbody = Table.find('tbody');
                    tbody.html('');

                    if(json.status) {
                        let html = "";
                        if(json.datas.length > 0) {
                            json.datas.forEach(el => {
                                html += insertTable(el)
                            });
                        } else {
                            html += `<tr>
                                        <td colspan="8" class="text-center">${json.msg}</td>
                                    </tr>`;
                        }

                        Table.find('tbody').html(html)
                    } else {
                        Swal.fire("Ohh!", json.msg, 'warning');
                    }
                })
            });

            ButtonCreate.click(() => {
                let form = new FormData(document.getElementById('modalCreate_form'));
                fetch("{{ route('admin.absensi.store') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {

                    console.log(json)
                    if(json.status) {
                        Swal.fire("Berhasil", json.msg, "success").then(() => {
                            $('#btn_filter').click();
                            ModalCreate.find('input').val('')
                            ModalCreate.find('select').val('')
                            ModalCreate.modal('hide');
                        })
                    } else {
                        Swal.fire("Gagal!", json.msg, "error");
                    }
                });
            })


            function openModalEdit(id) {
                fetch("{{ route('admin.absensi.index') }}/"+id).then(res => res.json())
                .then(json => {
                    console.log(json.server_computer_attends);
                    EditId = id;
                    let w_mulai = json.waktu_mulai.split(":");
                    let w_selesai = json.waktu_selesai.split(":");
                    ModalEdit.find('#modalEdit_date').val(json.tanggal);
                    ModalEdit.find('#modalEdit_time_start').val(w_mulai[0]+":"+w_mulai[1]);
                    ModalEdit.find('#modalEdit_time_end').val(w_selesai[0]+":"+w_selesai[1]);
                    ModalEdit.find('#modalEdit_name').val(json.name);
                    ModalEdit.find('#modalEdit_type').val(json.type_id);
                    ModalEdit.find('#modalEdit_status').val(json.status);

                    let server_coms = new Array();
                    json.server_computer_attends.forEach(e => {
                        console.log(e)
                        server_coms.push(e.server_com_id);
                    })
                    ModalEdit.find('#server_com_edit').val(server_coms).trigger('change');
                    console.log(server_coms)
                    ModalEdit.modal('show');
                })
                .catch(err => console.log("Error:", err));
            }

            ButtonEdit.click(() => {
                var form = new FormData(document.getElementById('modalEdit_form'));
                fetch("{{ route('admin.absensi.index') }}/"+EditId, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    console.log(json)
                    if(json.status) {
                        Swal.fire("Berhasil", json.msg, "success").then(() => {
                            $('#btn_filter').click();
                            ModalCreate.modal('hide');
                        })
                    } else {
                        Swal.fire("Gagal!", json.msg, "error");
                    }
                });
            })

            function hapus(id) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Kamu tidak dapat mengembalikannya setelah terhapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus ini!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await fetch("{{ route('admin.absensi.index') }}/"+id, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                            },
                        }).then(res => res.json())
                        .then(json => {
                            if(json.status) {
                                Swal.fire("Berhasil", "Aktifitas telah dihapus", 'success').then(() => {
                                    $('#btn_filter').click();
                                })
                            } else {
                                Swal.fire("Berhasil", "Aktifitas telah dihapus", 'error')
                            }
                        })
                    }
                })
            }
        </script>
    </x-slot>
</x-base-layout>
