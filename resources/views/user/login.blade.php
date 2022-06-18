<x-user-layout>
    <x-slot name="class">class="pt-0"</x-slot>
    <x-slot name="title">Login</x-slot>

    <div class="login-form mt-1">
        <div class="section">
            <img src="/images/smp1bsk.png" alt="image" class="form-image">
        </div>
        <div class="section mt-1">
            <h1>Masuk</h1>
            <h4>Silahkan masuk terlebih dahulu untuk mengisi daftar hadir</h4>
        </div>
        <div class="section mt-1 mb-5">
            <form action="app-pages.html">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" placeholder="Email address">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-button-group">
                    <button type="button" id="btn-login" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>

            </form>
        </div>
    </div>


    <x-slot name="js">
        @include('layouts.user.user-messages-modal')
        <script>
            var btnLogin = $('#btn-login');
            var InputEmail = $('#email');
            var InputPassword = $('#password');

            btnLogin.click(() => {
                $.post("{{ route('user.login') }}", { email : InputEmail.val(), password : InputPassword.val()}, (response) => {
                    console.log(response)
                    if(response.status) {
                        DIALOG_SUCCESS.find('.modal-body').text(response.msg);
                        DIALOG_SUCCESS.modal('show');
                        setTimeout(() => { window.location.href = "home" }, 2000);
                    } else {
                        DIALOG_DANGER.find('.modal-body').text(response.msg);
                        DIALOG_DANGER.modal('show');
                    }
                })
            });

        </script>
        @if (session('google_msg'))
            <script>
                $(document).ready(() => {
                    DIALOG_DANGER.find('.modal-body').text("{{ session('google_msg') }}");
                    DIALOG_DANGER.modal('show');
                })
            </script>
        @endif
    </x-slot>

</x-user-layout>
