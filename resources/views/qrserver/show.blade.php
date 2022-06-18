<x-server-qr-layout>
    <x-slot name="title">Scan QR Code Absen</x-slot>
    <x-content-wrapper title="Okee">
        <x-slot name="title">Scan QR Code Absen</x-slot>
        <div class="row">
            <div class="col-12 align-center">
                <x-card>
                    <div id="QrBox" class="d-flex justify-content-center">
                        <div id="qr_code" style="display: none;"></div>

                        <video id="video" style="display: none;">Video stream not available.</video>
                        <canvas id="canvas" style="display: none;"></canvas>
                    </div>
                </x-card>
                {{-- <x-card>
                    <x-slot name="title">1. Pilih Absen</x-slot>
                    <div class="row">
                        <div class="col-md-9">
                            <x-f-l-select placeholder="Pilih Absen" selectId="absensi" selectName="absensi" style="margin-top:-10px;">
                                <option value="">Pilih Absen</option>
                            </x-f-l-select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-lg btn-primary btn-block mb-2" id="btn_restart" style="display: none;">Restart</button>
                            <button type="button" class="btn btn-lg btn-danger btn-block mb-2" id="btn_off" style="display: none;">Power OFF</button>
                            <button type="button" class="btn btn-lg btn-primary btn-block mb-2" id="btn_on">Power ON</button>
                        </div>
                    </div>
                    Masih bingung dengan cara pakai-nya?? Baca petunjuknya <a href="/petunjuk">disini!</a>
                </x-card> --}}
            </div>
        </div>
    </x-content-wrapper>

    <x-slot name="js">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/qrcode.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.0/socket.io.min.js"></script>
        <script src="/js/app/server-camera.js"></script>
        <script src="/js/app/lib-server.js"></script>
        <script async src="//cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
        <script src="/js/app/server-show-qr.js"></script>
    </x-slot>
</x-server-qr-layout>
