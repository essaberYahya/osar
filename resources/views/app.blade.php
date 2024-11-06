<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <link rel="icon" type="image/x-icon" href="{{ asset('images/solovanotic.ico') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&family=Khula:wght@700&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.cs')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/odometer-theme-default.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/sass/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css') }}">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- Scripts -->
    
</head>

<body class="font-sans antialiased">
    @inertia

    @env('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv
    <script src="{{ asset('assets/js/jquery.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}} defer"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('assets/js/modernizr.custom.js')}}" defer></script>
    <script src="{{ asset('assets/js/jquery.dlmenu.js')}}" defer></script>
    <script src="{{ asset('assets/js/jquery-plugin-collection.js')}}" defer></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('assets/js/script.js')}}" defer></script>
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</body>

</html>
