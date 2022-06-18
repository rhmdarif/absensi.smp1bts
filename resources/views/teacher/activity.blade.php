<x-base-layout>
    <x-content-wrapper>
        <x-slot name="title">Aktifitas Harian</x-slot>

        <x-card>
            <x-slot name="title">Aktifitas Harian</x-slot>
            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreate">+ Aktifitas Baru</button>
            </x-slot>

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <x-f-l-select label="Cari Tanggal" selectId="search_date" selectName="date">
                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $date = date('Y-m-d', strtotime('-'.$i.' days', strtotime(date("Y-m-d"))));
                                $date_2 = date('D | d-m-Y', strtotime('-'.$i.' days', strtotime(date("Y-m-d"))));
                            @endphp

                            @if ($i == 0)
                                <option value="{{ $date }}" selected="">{{ $date_2 }} (Hari Ini)</option>
                            @else
                                <option value="{{ $date }}">{{ $date_2 }}</option>
                            @endif
                        @endfor
                    </x-f-l-select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Dilakukan pada</th>
                            <th>Judul/Kegiatan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada absensi Hari ini</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal id="modalCreate" title="Tambah Aktifitas">
            <form id="modalCreate_form">
                <div class="row">
                    <div class="col-md-6">
                        <x-f-l-input label="Tanggal Kegiatan" placeholder="Tanggal Kegiatan" inputId="modalCreate_date" inputName="date" inputType="date"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Kegiatan" placeholder="Waktu Kegiatan" inputId="modalCreate_time" inputName="time" inputType="time"></x-f-l-input>
                    </div>
                </div>
                <x-f-l-input label="Nama Kegiatan" placeholder="Masukan nama aktifitas anda" inputId="modalCreate_title" inputName="title" inputType="text"></x-f-l-input>
                <x-f-l-textarea label="Keterangan/Catatan Kegiatan" placeholder="Keterangan/Catatan aktifitas anda" textareaId="modalCreate_description" textareaName="description" textareaType="text"></x-f-l-textarea>

                <div class="justify-content-between float-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" name="submit">Save changes</button>
                </div>
            </form>
        </x-modal>
        <x-modal id="modalEdit" title="Ubah Aktifitas">
            <form id="modalEdit_form">
                @method("PUT")
                <div class="row">
                    <div class="col-md-6">
                        <x-f-l-input label="Tanggal Kegiatan" placeholder="Tanggal Kegiatan" inputId="modalEdit_date" inputName="date" inputType="date"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Waktu Kegiatan" placeholder="Waktu Kegiatan" inputId="modalEdit_time" inputName="time" inputType="time"></x-f-l-input>
                    </div>
                </div>
                <x-f-l-input label="Nama Kegiatan" placeholder="Masukan nama aktifitas anda" inputId="modalEdit_title" inputName="title" inputType="text"></x-f-l-input>
                <x-f-l-textarea label="Keterangan/Catatan Kegiatan" placeholder="Keterangan/Catatan aktifitas anda" textareaId="modalEdit_description" textareaName="description" textareaType="text"></x-f-l-textarea>

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
        <script>
            const TableEl = $('table');
            const SelectDate = $('#search_date');
            const now = "{{ date('Y-m-d H:i:s') }}";
            const ModalCreate = $('#modalCreate');
            const ButtonCreate = ModalCreate.find('button[name=submit]');
            const ModalEdit = $('#modalEdit');
            const ButtonEdit = ModalEdit.find('button[name=submit]');
            var EditId;
            sendRequest(`${now}`)

            function tableStartLoading() {
                let tbody = TableEl.find('tbody');
                tbody.html(`<tr>
                                <td colspan="4" class="text-center">Sedang mengambil data....</td>
                            </tr>`);
            }

            function tableEmpty() {
                let tbody = TableEl.find('tbody');
                tbody.html(`<tr>
                                <td colspan="4" class="text-center">Data Kosong</td>
                            </tr>`);
            }

            function parseStatus(status) {
                switch (status) {
                    case 1:
                        return `<span class="badge badge-success">Hadir</span>`;
                        break;
                    case 2:
                        return `<span class="badge badge-warning">Terlambat</span>`;
                        break;
                    case 3:
                        return `<span class="badge badge-danger">Tidak Hadir</span>`;
                        break;

                    default:
                        return `<span class="badge badge-danger">Tidak Hadir</span>`;
                        break;
                }
            }

            SelectDate.change(async () => {
                await tableStartLoading()
                sendRequest(SelectDate.val())
            })

            async function sendRequest(value) {
                console.log(value)
                let tbody = TableEl.find('tbody');

                await fetch("{{ route('teacher.activity.get-data') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: JSON.stringify({
                        date: value
                    })
                })
                .then(res => res.json())
                .then(json => {
                    console.log(json)

                    if(json.datas.length == 0) {
                        tableEmpty()
                    } else {
                        let html = "";
                        json.datas.forEach(el => {
                            let d = new Date(el.created_at);
                            html += `<tr>
                                        <td>${el.period}</td>
                                        <td>${ el.title }</td>
                                        <td>${ el.description }</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" onclick="openModalEdit(${el.id})" class="btn btn-warning">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" onclick="hapus(${el.id})" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>`
                        });
                        tbody.html(html);
                    }
                })
            }

            ButtonCreate.click(() => {
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
                        Swal.fire("Berhasil", json.msg, "success").then(() => {
                            sendRequest(SelectDate.val())
                            ModalCreate.find('input').val('')
                            ModalCreate.find('select').val('')
                            ModalCreate.find('textarea').val('')
                            ModalCreate.modal('hide');
                        })
                    } else {
                        Swal.fire("Gagal!", json.msg, "error");
                    }
                });
            })

            function openModalEdit(id) {
                fetch("{{ route('teacher.activity.index') }}/"+id).then(res => res.json())
                .then(json => {
                    console.log(json)
                    EditId = id

                    let spl = json.period.split(' ');
                    ModalEdit.find('#modalEdit_date').val(spl[0])
                    ModalEdit.find('#modalEdit_time').val(spl[1])
                    ModalEdit.find('#modalEdit_title').val(json.title)
                    ModalEdit.find('#modalEdit_description').val(json.description)
                    ModalEdit.modal('show');
                })
                .catch(err => console.log("Error:", err));
            }

            ButtonEdit.click(() => {
                var form = new FormData(document.getElementById('modalEdit_form'));
                fetch("{{ route('teacher.activity.index') }}/"+EditId, {
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
                            sendRequest(SelectDate.val())
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
                        await fetch("{{ route('teacher.activity.index') }}/"+id, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                            },
                        }).then(res => res.json())
                        .then(json => {
                            if(json.status) {
                                Swal.fire("Berhasil", "Aktifitas telah dihapus", 'success').then(() => {
                                    sendRequest(SelectDate.val())
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
