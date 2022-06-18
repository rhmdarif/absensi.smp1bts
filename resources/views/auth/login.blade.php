<x-auth-layout>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('teacher.home') }}">{{ env('NAMA_SEKOLAH') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk melakukan pengambilan Absen/Entry Aktifitas</p>


                @if ($errors->any())
                <x-alert type="danger" title="Login gagal!">
                    {{ $errors->first() }}
                </x-alert>
                @endif

                @if (session('google_msg'))
                    <x-alert type="danger" title="Login gagal!">
                        {{ session('google_msg') }}
                    </x-alert>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email"name="email" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('google') }}" class="mt-3 btn btn-primary btn-block">Login dengan akun Google</a>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</x-auth-layout>
