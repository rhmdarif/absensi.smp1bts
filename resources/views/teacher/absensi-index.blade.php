<x-base-layout>
    <x-content-wrapper>
        <x-slot name="title">Daftar Absen</x-slot>

        <x-card>
            <x-slot name="title">Daftar Absen</x-slot>

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <x-f-l-input inputType="date" inputName="date" inputId="search_date"></x-f-l-input>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Absen</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Diambil pada.</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada absensi Hari ini</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>
    </x-content-wrapper>

    <x-slot name="js">
        <script src="/js/app/lib.js"></script>
        <script>
            const TableEl = $('table');
            const SelectDate = $('#search_date');
            const now = new Date().toLocaleString("en-US", {timeZone: "Asia/Jakarta"});
            sendRequest()

            function tableStartLoading() {
                let tbody = TableEl.find('tbody');
                tbody.html(`<tr>
                                <td colspan="5" class="text-center">Sedang mengambil data....</td>
                            </tr>`);
            }
            function tableEmpty() {
                let tbody = TableEl.find('tbody');
                tbody.html(`<tr>
                                <td colspan="5" class="text-center">Data Kosong</td>
                            </tr>`);
            }

            function parseStatus(status) {
                switch (status) {
                    case 1:
                        return badgeStatus("Hadir", 'success');
                        break;
                    case 2:
                        return badgeStatus("Terlambat", 'warning');
                        break;
                    case 3:
                        return badgeStatus("Tidak Hadir", 'danger');
                        break;

                    default:
                        return badgeStatus("Tidak Hadir", 'danger');
                        break;
                }
            }

            SelectDate.change(async () => {
                await tableStartLoading()
                sendRequest(SelectDate.val())
            })

            async function sendRequest(value='') {
                let tbody = TableEl.find('tbody');

                await fetch("{{ route('teacher.absensi.search') }}", {
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
                                        <td>${el.master_teacher_attend.name}</td>
                                        <td>${ getDayName(d.getDay()) }</td>
                                        <td>${d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()}</td>
                                        <td>${d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()}</td>
                                        <td>${parseStatus(el.status)}</td>
                                    </tr>`
                        });
                        tbody.html(html);
                    }
                })
            }
        </script>
    </x-slot>
</x-base-layout>
