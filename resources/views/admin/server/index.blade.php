<x-base-layout>
    <x-slot name="title">Kelola Komputer Server</x-slot>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/r-2.2.7/datatables.min.css"/>
    </x-slot>

    <x-content-wrapper>
        <x-slot name="title">Kelola Komputer Server</x-slot>

        <x-card>
            <x-slot name="title"> Daftar Komputer Server</x-slot>
            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreate">+ Komputer Server</button>
            </x-slot>


            <table class="table table-bordered" id="tableServer">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-card>


        <x-modal id="modalCreate" title="Tambah Komputer Server">
            <form id="modalCreate_form">
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Nama" placeholder="Nama" inputId="modalCreate_name" inputName="name" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Lokasi" placeholder="Lokasi" inputId="modalCreate_loc" inputName="location" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Fingerprint" placeholder="Fingerprint" inputId="modalCreate_fingerprint" inputName="fingerprint" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Active" placeholder="Active" inputId="modalCreate_status_active" inputName="status" inputType="radio" value="1"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="In-Active" placeholder="In-Active" inputId="modalCreate_status_inactive" inputName="status" inputType="radio" value="2"></x-f-l-input>
                    </div>
                </div>

                <div class="justify-content-between float-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" name="submit">Tambah</button>
                </div>
            </form>
        </x-modal>
        <x-modal id="modalEdit" title="Ubah Komputer Server">
            <form id="modalEdit_form">
                @method("PUT")
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Nama" placeholder="Nama" inputId="modalEdit_name" inputName="name" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Lokasi" placeholder="Lokasi" inputId="modalEdit_loc" inputName="location" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Fingerprint" placeholder="Fingerprint" inputId="modalEdit_fingerprint" inputName="fingerprint" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Active" placeholder="Active" inputId="modalEdit_status_active" input inputName="status" inputType="radio" value="1"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="In-Active" placeholder="In-Active" inputId="modalEdit_status_inactive" inputName="status" inputType="radio" value="2"></x-f-l-input>
                    </div>
                </div>

                <div class="justify-content-between float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" name="submit">Simpan</button>
                </div>
            </form>
        </x-modal>
    </x-content-wrapper>

    <x-slot name="js">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script type="text/javascript" src="https://cdnjs.cloudfla+re.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/r-2.2.7/datatables.min.js"></script>

        <script>
            const ModalCreate = $('#modalCreate');
            const ButtonCreate = ModalCreate.find('button[name=submit]');
            const ModalEdit = $('#modalEdit');
            const ButtonEdit = ModalEdit.find('button[name=submit]');
            var EditId,dataTable;

            $(document).ready(() => {

                dataTable = $('#tableServer').DataTable( {
                    processing: true,
                    serverSide: true,
                    columnDefs: [
                        {
                            "targets": 1,
                            "orderable": false
                        }
                    ],
                    ajax: {
                        url: '{{ route("admin.serverCom.datatable") }}',
                        // dataSrc: ''
                    },
                    columns: [
                        { data: "name", name: "name" },
                        { data: "location", name: "lokasi" },
                        { data: "is_active", name: "status", render: function (data, val, row) {
                                if(data) {
                                    return `<span class="badge badge-success">Aktif</span>`
                                } else {
                                    return `<span class="badge badge-danger">Tidak Aktif</span>`
                                }
                            }
                        },
                        { render: function(value, n, row) {
                            return `<div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" onclick="showServer(${row.id})"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="btn btn-warning" onclick="openModalEdit(${row.id})"><i class="fa fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="hapus(${row.id})"><i class="fa fa-trash-alt"></i></button>
                                    </div>`
                        }, name: "aksi" },
                    ]
                });

                ButtonCreate.click(() => {
                    let form = new FormData(document.getElementById('modalCreate_form'));
                    fetch("{{ route('admin.serverCom.store') }}", {
                        method: 'POST',
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                        },
                        body: form
                    }).then(res => res.json())
                    .then(json => {
                        if(json.status) {
                            Swal.fire("Berhasil", json.msg, "success").then(() => {
                                dataTable.ajax.reload();
                                ModalCreate.find('input[type=text]').val('')
                                ModalCreate.find('input[type=radio]').prop('checked', false)
                                ModalCreate.modal('hide');
                            })
                        } else {
                            Swal.fire("Gagal!", json.msg, "error");
                        }
                    });
                })

                ButtonEdit.click(() => {
                    var form = new FormData(document.getElementById('modalEdit_form'));
                    fetch("{{ route('admin.serverCom.index') }}/"+EditId, {
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
                                dataTable.ajax.reload();
                                ModalEdit.modal('hide');
                            })
                        } else {
                            Swal.fire("Gagal!", json.msg, "error");
                        }
                    });
                })
            })

            function loadData(id) {
                fetch("{{ route('admin.serverCom.index') }}/"+id).then(res => res.json())
                .then(json => {
                    console.log(json)
                    EditId = id
                    let status = json.is_active;
                    ModalEdit.find('#modalEdit_name').val(json.name)
                    ModalEdit.find('#modalEdit_loc').val(json.location)
                    ModalEdit.find('#modalEdit_fingerprint').val(json.fingerprint)

                    if(status) {
                        ModalEdit.find('#modalEdit_status_active').prop('checked', true)
                    } else {
                        ModalEdit.find('#modalEdit_status_inactive').prop('checked', true)
                    }

                    ModalEdit.modal('show');
                })
                .catch(err => console.log("Error:", err));
            }

            async function showServer(id) {
                await loadData(id);

                ModalEdit.find('.modal-title').text("Detail Komputer Server");
                ModalEdit.find('input').attr('disabled', true);
                ModalEdit.find('button').hide();
            }

            async function openModalEdit(id) {
                await loadData(id);

                ModalEdit.find('.modal-title').text("Ubah Komputer Server");
                ModalEdit.find('input').attr('disabled', false);
                ModalEdit.find('button').show();
            }


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
                        await fetch("{{ route('admin.serverCom.index') }}/"+id, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                            },
                        }).then(res => res.json())
                        .then(json => {
                            if(json.status) {
                                Swal.fire("Berhasil", "Aktifitas telah dihapus", 'success').then(() => {
                                    dataTable.ajax.reload();
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
