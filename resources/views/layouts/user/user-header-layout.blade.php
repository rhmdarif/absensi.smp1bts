
    <!-- App Header -->
    <div class="appHeader bg-primary scrolled">
        <div class="left">
            <h3>SMP N 1 BATUSANGKAR</h3>
        </div>
        <div class="pageTitle">
            {{ $slot }}
        </div>
        <div class="right">
            <a  href="{{ route('user.logout') }}" onclick="event.preventDefault();$('#formLogout').submit();" class="headerButton toggle-searchbox">
                <ion-icon name="log-out-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->
