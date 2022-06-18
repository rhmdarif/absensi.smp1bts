<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/home" class="brand-link">
                <span class="brand-text font-weight-light">{{ env('NAMA_SEKOLAH') ?? "" }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/') }}{{ auth()->user()->userTeacher->foto ?? 'images/_default.jpg' }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('teacher.home') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Beranda
                                </p>
                            </a>
                        </li>

                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a href="{{ route('admin.absensi.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>
                                        Kelola Absensi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.teacher.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Kelola Guru
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.serverCom.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>
                                        Kelola Komputer Server
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.absensi.report') }}" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Laporan Absensi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item"><hr style="color:#fff"></li>
                        @endif
                        {{-- @dd(auth()->user()->userTeacher)
                        @if (isset(auth()->user()->userTeacher))
                            <li class="nav-item">
                                <a href="{{ route('teacher.home') }}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Absensi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('teacher.absensi.scan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Scan QR Absen</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('teacher.manual.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Manual Absen</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('teacher.absensi.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Riwayat Absen</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('teacher.activity.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>
                                        Aktifitas
                                    </p>
                                </a>
                            </li>
                        @endif
                        --}}
                        <li class="nav-item">
                            <a href="{{ route('teacher.account.password') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Pengaturan Akun
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('guide') }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Panduan Aplikasi
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();$('#formLogout').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

            </div>
            <!-- /.sidebar -->
        </aside>
        <form method="POST" id="formLogout" action="{{ route('logout') }}">
            @csrf
        </form>
