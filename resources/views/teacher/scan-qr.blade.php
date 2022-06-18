<x-base-layout withoutNav="1">
    <x-slot name="title">Admin Template</x-slot>

    <div id="qr-reader" style="left: 0%; top: 0%;height:80%"></div>

        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h4>Scan Kode QR</h4>
                </div>
            </div>
        </div>
    <x-slot name="js">
        <script>
            const TEACHER_ID = {{ auth()->user()->userTeacher->id }}
        </script>
        <script src="/js/html5-qrcode.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.0/socket.io.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/app/teacher-scan.js"></script>
    </x-slot>
</x-base-layout>
