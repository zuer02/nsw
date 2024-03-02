<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loginscreen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/js/jquery.mask.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

@yield('content')


</body>
<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "extendedTimeOut ": 1000,
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "extendedTimeOut ": 1000,
        }
        toastr.error("{{ session('error') }}");
    @endif
</script>
<!-- Tabler Core -->
<script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/tabler.min.js?1684106062" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/demo.min.js?1684106062" defer></script>

{{-- <script>
    @yield('js')
</script> --}}

</html>
