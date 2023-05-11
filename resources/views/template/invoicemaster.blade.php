<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice</title>

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    @vite('resources/sass/app.scss')
    @yield('head')
</head>

<body>
    <main class="my-3">
        @yield('content')

    </main>

    @yield('footer')
    @vite('resources/js/app.js')
</body>

</html>
