<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        @auth
            @if (auth()->user()->is_admin)
                <li class="nav-item">
                    <a href="/server/show-qr" target="framename" class="btn btn-primary">Buka Kode QR Absen</a>
                </li>
            @endif
        @endauth
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <li class="nav-item d-none d-sm-inline-block mr-2">
            <i class="fa fa-calendar"></i> {{ date('d F Y') }}
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <i class="fa fa-clock"></i> <span id="jam_widget">-</span>
        </li>
    </ul>
</nav>
