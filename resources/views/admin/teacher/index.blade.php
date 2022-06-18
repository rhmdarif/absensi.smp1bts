<x-base-layout>
    <x-slot name="title">Kelola Guru</x-slot>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/r-2.2.7/datatables.min.css"/>
    </x-slot>

    <x-content-wrapper>
        <x-slot name="title">Majelis Guru</x-slot>

        <x-card>
            <x-slot name="title"> Daftar Guru</x-slot>
            <x-slot name="title_right">
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreate">+ Guru Baru</button>
            </x-slot>


            <table class="table table-bordered" id="tableGuru">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Pangkat/Gol</th>
                        <th>Pekerjaan/Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-card>


        <x-modal id="modalCreate" title="Tambah Guru">
            <form id="modalCreate_form">
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Nama" placeholder="Nama" inputId="modalCreate_name" inputName="name" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Email" placeholder="Email" inputId="modalCreate_email" inputName="email" inputType="email"></x-f-l-input>

                        <x-f-l-input label="NIP" placeholder="NIP" inputId="modalCreate_nip" inputName="nip" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Pangkat" placeholder="Pangkat" inputId="modalCreate_pangkat" inputName="pangkat" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Golongan" placeholder="Golongan" inputId="modalCreate_gol" inputName="gol" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Pekerjaan" placeholder="Pekerjaan" inputId="modalCreate_pekerjaan" inputName="pekerjaan" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Jabatan" placeholder="Jabatan" inputId="modalCreate_jabatan" inputName="jabatan" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-12">
                        <x-f-l-input label="No HP" placeholder="No HP" inputId="modalCreate_nohp" inputName="nohp" inputType="tel"></x-f-l-input>
                        <x-f-l-textarea label="Alamat" textareaName="alamat" textareaId="modalCreate_alamat"></x-f-l-textarea>
                    </div>
                </div>

                <div class="justify-content-between float-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" name="submit">Save changes</button>
                </div>
            </form>
        </x-modal>
        <x-modal id="modalEdit" title="Ubah Guru">
            <form id="modalEdit_form">
                @method("PUT")
                <div class="row">
                    <div class="col-md-12">
                        <x-f-l-input label="Nama" placeholder="Nama" inputId="modalEdit_name" inputName="name" inputType="text"></x-f-l-input>
                        <x-f-l-input label="Email" placeholder="Email" inputId="modalEdit_email" inputName="email" inputType="email"></x-f-l-input>

                        <x-f-l-input label="NIP" placeholder="NIP" inputId="modalEdit_nip" inputName="nip" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Pangkat" placeholder="Pangkat" inputId="modalEdit_pangkat" inputName="pangkat" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Golongan" placeholder="Golongan" inputId="modalEdit_gol" inputName="gol" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Pekerjaan" placeholder="Pekerjaan" inputId="modalEdit_pekerjaan" inputName="pekerjaan" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-6">
                        <x-f-l-input label="Jabatan" placeholder="Jabatan" inputId="modalEdit_jabatan" inputName="jabatan" inputType="text"></x-f-l-input>
                    </div>
                    <div class="col-md-12">
                        <x-f-l-input label="No HP" placeholder="No HP" inputId="modalEdit_nohp" inputName="nohp" inputType="tel"></x-f-l-input>
                        <x-f-l-textarea label="Alamat" textareaName="alamat" textareaId="modalEdit_alamat"></x-f-l-textarea>
                    </div>
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

                dataTable = $('#tableGuru').DataTable( {
                    processing: true,
                    serverSide: true,
                    columnDefs: [
                        {
                            "targets": 1,
                            "orderable": false
                        }
                    ],
                    ajax: {
                        url: '{{ route("admin.teacher.datatable") }}',
                        // dataSrc: ''
                    },
                    columns: [
                        { name: "photo", render: function (data, val, row) {
                                return `<div class="widget-user-image text-center">
                                            <img class="img-circle elevation-2" width="50px" src="/${row.foto}" alt="User Avatar">
                                        </div>`
                            }
                        },
                        { data: "user.name", name: "nama" },
                        { data: "nip", name: "teacher" },
                        { data: "pangkat", name: "pangkat", render: function (data, val, row) {
                                return data+" / "+row.golongan
                            }
                        },
                        { data: "pekerjaan", name: "pekerjaan", render: function (data, val, row) {
                                return data+" / "+row.jabatan
                            }
                        },
                        { render: function(value, n, row) {
                            return `<div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='/admin/teacher/activity/${row.id}'"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="btn btn-warning" onclick="openModalEdit(${row.id})"><i class="fa fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="hapus(${row.id})"><i class="fa fa-trash-alt"></i></button>
                                    </div>`
                        }, name: "aksi" },
                    ]
                });

                ButtonCreate.click(() => {
                    let form = new FormData(document.getElementById('modalCreate_form'));
                    fetch("{{ route('admin.teacher.store') }}", {
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
                                ModalCreate.find('input').val('')
                                ModalCreate.find('textarea').val('')
                                ModalCreate.modal('hide');
                            })
                        } else {
                            Swal.fire("Gagal!", json.msg, "error");
                        }
                    });
                })

                ButtonEdit.click(() => {
                    var form = new FormData(document.getElementById('modalEdit_form'));
                    fetch("{{ route('admin.teacher.index') }}/"+EditId, {
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
                fetch("{{ route('admin.teacher.index') }}/"+id).then(res => res.json())
                .then(json => {
                    console.log(json)
                    EditId = id
                    ModalEdit.find('#modalEdit_name').val(json.user.name)
                    ModalEdit.find('#modalEdit_nip').val(json.nip)
                    ModalEdit.find('#modalEdit_nohp').val(json.nohp)
                    ModalEdit.find('#modalEdit_alamat').val(json.alamat)
                    ModalEdit.find('#modalEdit_pekerjaan').val(json.pekerjaan)
                    ModalEdit.find('#modalEdit_gol').val(json.golongan)
                    ModalEdit.find('#modalEdit_pangkat').val(json.pangkat)
                    ModalEdit.find('#modalEdit_jabatan').val(json.jabatan)
                    ModalEdit.find('#modalEdit_email').val(json.user.email)
                    ModalEdit.modal('show');
                })
                .catch(err => console.log("Error:", err));
            }

            async function showGuru(id) {
                await loadData(id);

                ModalEdit.find('.modal-title').text("Detail Guru");
                ModalEdit.find('input').attr('disabled', true);
                ModalEdit.find('textarea').attr('disabled', true);
                ModalEdit.find('button').hide();
            }

            async function openModalEdit(id) {
                await loadData(id);

                ModalEdit.find('.modal-title').text("Ubah Guru");
                ModalEdit.find('input').attr('disabled', false);
                ModalEdit.find('textarea').attr('disabled', false);
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
                        await fetch("{{ route('admin.teacher.index') }}/"+id, {
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
