<x-base-layout>
    <x-slot name="title">Ubah Password</x-slot>

    <x-lte-content>
        <x-slot name="title">Ubah Password</x-slot>

        <div class="row">
            <div class="col-md-12">
                <x-card>
                    <form id="change_password">
                        <x-f-l-input label="Password Baru" placeholder="Masukan Password Baru" inputId="modalCreate_npass" inputName="new" inputType="password"></x-f-l-input>
                        <x-f-l-input label="Konfirmasi Password Baru" placeholder="Ulangi Password Baru" inputId="modalCreate_cpass" inputName="confirm" inputType="password"></x-f-l-input>
                        <hr>
                        <x-f-l-input label="Password Lama" placeholder="Masukan Password Lama" inputId="modalCreate_opass" inputName="old" inputType="password"></x-f-l-input>

                        <div class="float-right">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button class="btn btn-success" type="button" id="btn_submit">Ganti</button>
                        </div>
                    </form>

                </x-card>
            </div>
        </div>
    </x-lte-content>
    <x-slot name="js">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>

            $('#btn_submit').click(() => {
                var form = new FormData(document.getElementById('change_password'));
                fetch("{{ route('teacher.account.password') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        Swal.fire("Berhasil", json.msg, "success").then(() => {
                            $('input').val('')
                        });
                    } else {
                        Swal.fire("Gagal!", json.msg, "error");
                    }
                });
            })
        </script>
    </x-slot>
</x-base-layout>
