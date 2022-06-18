<x-auth-layout>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('teacher.home') }}">{{ env('NAMA_SEKOLAH') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign up</p>


                @if ($errors->any())
                <x-alert type="danger" title="Login gagal!">
                    {{ $errors->first() }}
                </x-alert>
                @endif
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="form-control" placeholder="Nama" type="text" name="name" :value="old('name')" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" class="block mt-1 w-full" name="password_confirmation" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block float-right">Sign In</button>
                </form>

                <p class="mb-0">
                    <a href="{{ route('login') }}" class="text-center">Have a account?</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</x-auth-layout>
