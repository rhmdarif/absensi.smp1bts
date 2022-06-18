<x-base-layout>
    <x-slot name="title">Absensi Manual</x-slot>
    <x-content-wrapper>
        <x-slot name="title">Absensi Manual</x-slot>

        <x-card>
            <form id="absensiManual">
                <x-slot name="title">Absensi Manual</x-slot>

                <x-f-l-select label="Absensi" selectId="absen_id" selectName="absen_id">
                        <option value="">Pilih Absen</option>
                        @foreach ($absensi as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                </x-f-l-select>

                <x-f-l-select label="Status" selectId="status" selectName="status">
                        <option value="">Pilih Absen</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                </x-f-l-select>

                <x-f-l-textarea label="Keterangan" placeholder="Keterangan/Catatan aktifitas anda" textareaId="keterangan" textareaName="keterangan"></x-f-l-textarea>

                <div class="justify-content-between float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name="submit">Save changes</button>
                </div>
            </form>
        </x-card>
    </x-content-wrapper>

    <x-slot name="js">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/app/lib.js"></script>
        <script>
            const now = "{{ date('Y-m-d H:i:s') }}";
            const ButtonSubmit = $('button[name=submit]');

            ButtonSubmit.click(() => {
                var form = new FormData(document.getElementById('absensiManual'));
                fetch("{{ route('teacher.manual.store') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    body: form
                }).then(res => res.json())
                .then(json => {
                    if(json.status) {
                        Swal.fire("Berhasil", json.msg, "success").then(() => {
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
        </script>
    </x-slot>
</x-base-layout>
