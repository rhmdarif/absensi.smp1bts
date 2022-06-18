<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#185ecc">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($title ?? "")." - SMP N 1 BATUSANGKAR" }}</title>

    <meta name="description" content="{{ ($title ?? "")." - SMP N 1 BATUSANGKAR" }}">
    <meta name="keywords" content="smp n 1 batusangkar, upiyptk, padang, absensi" />
    <link rel="icon" type="image/png" href="/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="manifest" href="/__manifest.json">
    {{ $css ?? "" }}
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" {{ $class ?? "" }}>
        {{ $slot }}
    </div>
    <!-- * App Capsule -->
    <form method="POST" id="formLogout" action="{{ route('user.logout') }}">
        @csrf
    </form>




    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="/assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="/assets/js/lib/popper.min.js"></script>
    <script src="/assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="/assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="/assets/js/base.js"></script>
    <script>
        console.log($('meta[name="csrf-token"]').attr('content'))
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{ $js ?? "" }}


</body>

</html>
